#!/usr/bin/env python3
"""Find safe YouTube content ideas for TOM Gaming TH using YouTube Data API v3.

This script reads only public metadata. It does not scrape or download videos.
"""

from __future__ import annotations

import argparse
import csv
import html
import json
import os
import re
import sys
import time
from collections import Counter, OrderedDict
from datetime import datetime, timedelta, timezone
from typing import Any
from urllib.error import HTTPError, URLError
from urllib.parse import urlencode
from urllib.request import Request, urlopen

try:
    import pandas as pd  # type: ignore
except Exception:  # pragma: no cover - pandas is optional
    pd = None


API_BASE_URL = "https://www.googleapis.com/youtube/v3"
DEFAULT_KEYWORDS = [
    "Roblox ไทย",
    "Dandy's World ไทย",
    "Roblox Dandy's World",
    "เกม Roblox ไทย",
    "Roblox Shorts ไทย",
]
CSV_FIELDS = [
    "video_id",
    "title",
    "channel_title",
    "published_at",
    "age_days",
    "duration",
    "duration_seconds",
    "views",
    "likes",
    "comments",
    "engagement_rate_pct",
    "views_per_day",
    "opportunity_score",
    "license",
    "title_signals",
    "matched_keywords",
    "tags",
    "url",
    "description_sample",
]
TITLE_SIGNAL_PATTERNS = {
    "update/news": [r"update", r"new", r"patch", r"อัปเดต", r"อัพเดต", r"ใหม่"],
    "how-to/tutorial": [r"how to", r"guide", r"tips?", r"สอน", r"วิธี", r"ทริค", r"เทคนิค"],
    "challenge": [r"challenge", r"noob", r"pro", r"ท้าทาย", r"24\s*ชั่วโมง"],
    "secret/discovery": [r"secret", r"hidden", r"ลับ", r"ความลับ", r"เจอ", r"หา"],
    "ranking/comparison": [r"\btop\b", r"tier", r"\bvs\b", r"อันดับ", r"ดีที่สุด"],
    "funny/highlight": [r"funny", r"meme", r"ฮา", r"ตลก", r"พีค"],
}
TOKEN_RE = re.compile(r"[a-z0-9][a-z0-9_'-]*|[\u0e00-\u0e7f]{2,}", re.IGNORECASE)
STOPWORDS = {
    "roblox",
    "shorts",
    "short",
    "gaming",
    "game",
    "games",
    "ไทย",
    "เกม",
    "เกมส์",
    "คลิป",
    "ep",
}


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser(
        description=(
            "Research Roblox/Gaming video ideas for TOM Gaming TH via the official "
            "YouTube Data API v3. Metadata only; no scraping or video downloads."
        )
    )
    parser.add_argument(
        "--keywords",
        nargs="*",
        default=None,
        help="Search keywords. Defaults to a TOM Gaming TH starter set.",
    )
    parser.add_argument(
        "--keywords-file",
        help="Optional text file with one keyword per line. Blank lines and # comments are ignored.",
    )
    parser.add_argument(
        "--output",
        default="tom-gaming-output/tom_gaming_youtube_ideas.csv",
        help="CSV output path.",
    )
    parser.add_argument("--json-output", help="Optional JSON output path.")
    parser.add_argument(
        "--api-key-env",
        default="YOUTUBE_API_KEY",
        help="Environment variable that stores the YouTube Data API key.",
    )
    parser.add_argument("--region", default="TH", help="YouTube regionCode. Default: TH.")
    parser.add_argument("--language", default="th", help="YouTube relevanceLanguage. Default: th.")
    parser.add_argument(
        "--order",
        default="viewCount",
        choices=["date", "rating", "relevance", "title", "videoCount", "viewCount"],
        help="search.list ordering. Default: viewCount.",
    )
    parser.add_argument(
        "--sort",
        default="views_per_day",
        choices=["views", "views_per_day", "engagement_rate_pct", "opportunity_score", "published_at"],
        help="Final CSV sort. Default: views_per_day.",
    )
    parser.add_argument(
        "--max-results",
        type=int,
        default=25,
        help="Maximum search results per keyword. Uses pagination when above 50.",
    )
    parser.add_argument(
        "--days",
        type=int,
        default=30,
        help="Look back this many days. Use 0 with --published-after omitted for no date filter.",
    )
    parser.add_argument(
        "--published-after",
        help="RFC3339 timestamp or YYYY-MM-DD date. Overrides --days.",
    )
    parser.add_argument(
        "--creative-commons",
        action="store_true",
        help="Only return videos marked Creative Commons by YouTube.",
    )
    parser.add_argument("--min-views", type=int, default=0, help="Drop rows below this view count.")
    parser.add_argument(
        "--duration",
        default="any",
        choices=["any", "short", "medium", "long"],
        help="YouTube videoDuration filter. short means under 4 minutes.",
    )
    parser.add_argument(
        "--safe-search",
        default="moderate",
        choices=["none", "moderate", "strict"],
        help="YouTube safeSearch filter. Default: moderate.",
    )
    parser.add_argument(
        "--show-top",
        type=int,
        default=12,
        help="Number of top rows to print in the console summary.",
    )
    parser.add_argument(
        "--sleep",
        type=float,
        default=0.05,
        help="Small pause between paginated API calls.",
    )
    parser.add_argument(
        "--no-pandas",
        action="store_true",
        help="Use the built-in CSV writer even if pandas is installed.",
    )
    parser.add_argument("--quiet", action="store_true", help="Only print errors.")
    args = parser.parse_args()

    if args.max_results < 1:
        parser.error("--max-results must be at least 1")
    if args.days < 0:
        parser.error("--days cannot be negative")
    if args.min_views < 0:
        parser.error("--min-views cannot be negative")
    return args


def load_keywords(args: argparse.Namespace) -> list[str]:
    keywords: list[str] = []
    if args.keywords:
        keywords.extend(args.keywords)

    if args.keywords_file:
        with open(args.keywords_file, "r", encoding="utf-8") as keyword_file:
            for line in keyword_file:
                cleaned = line.strip()
                if cleaned and not cleaned.startswith("#"):
                    keywords.append(cleaned)

    if not keywords:
        keywords = DEFAULT_KEYWORDS[:]

    deduped = list(OrderedDict.fromkeys(keyword.strip() for keyword in keywords if keyword.strip()))
    return deduped


def build_published_after(args: argparse.Namespace) -> str | None:
    if args.published_after:
        raw_value = args.published_after.strip()
        if re.fullmatch(r"\d{4}-\d{2}-\d{2}", raw_value):
            return f"{raw_value}T00:00:00Z"
        return raw_value

    if args.days == 0:
        return None

    cutoff = datetime.now(timezone.utc) - timedelta(days=args.days)
    return cutoff.replace(microsecond=0).isoformat().replace("+00:00", "Z")


def call_youtube(endpoint: str, params: dict[str, Any], api_key: str) -> dict[str, Any]:
    query = urlencode({**params, "key": api_key})
    url = f"{API_BASE_URL}/{endpoint}?{query}"
    request = Request(url, headers={"User-Agent": "tom-gaming-idea-finder/1.0"})

    try:
        with urlopen(request, timeout=30) as response:
            return json.loads(response.read().decode("utf-8"))
    except HTTPError as exc:
        body = exc.read().decode("utf-8", errors="replace")
        message = extract_youtube_error(body) or body[:500]
        raise RuntimeError(f"YouTube API error {exc.code}: {message}") from exc
    except URLError as exc:
        raise RuntimeError(f"Network error while calling YouTube API: {exc.reason}") from exc
    except json.JSONDecodeError as exc:
        raise RuntimeError("YouTube API returned invalid JSON.") from exc


def extract_youtube_error(body: str) -> str | None:
    try:
        payload = json.loads(body)
    except json.JSONDecodeError:
        return None

    error = payload.get("error")
    if not isinstance(error, dict):
        return None

    message = error.get("message")
    errors = error.get("errors") or []
    reason = None
    if errors and isinstance(errors[0], dict):
        reason = errors[0].get("reason")

    if reason and message:
        return f"{message} ({reason})"
    return message


def search_videos(
    api_key: str,
    keyword: str,
    args: argparse.Namespace,
    published_after: str | None,
) -> list[dict[str, Any]]:
    hits: list[dict[str, Any]] = []
    next_page_token: str | None = None

    while len(hits) < args.max_results:
        page_size = min(50, args.max_results - len(hits))
        params: dict[str, Any] = {
            "part": "snippet",
            "type": "video",
            "q": keyword,
            "regionCode": args.region,
            "relevanceLanguage": args.language,
            "order": args.order,
            "maxResults": page_size,
            "safeSearch": args.safe_search,
        }
        if published_after:
            params["publishedAfter"] = published_after
        if args.creative_commons:
            params["videoLicense"] = "creativeCommon"
        if args.duration != "any":
            params["videoDuration"] = args.duration
        if next_page_token:
            params["pageToken"] = next_page_token

        payload = call_youtube("search", params, api_key)
        for item in payload.get("items", []):
            video_id = item.get("id", {}).get("videoId")
            if not video_id:
                continue
            snippet = item.get("snippet", {})
            hits.append(
                {
                    "video_id": video_id,
                    "keyword": keyword,
                    "search_title": snippet.get("title", ""),
                    "search_published_at": snippet.get("publishedAt", ""),
                }
            )

        next_page_token = payload.get("nextPageToken")
        if not next_page_token:
            break
        time.sleep(args.sleep)

    return hits


def fetch_video_details(api_key: str, video_ids: list[str], sleep_seconds: float) -> dict[str, dict[str, Any]]:
    details: dict[str, dict[str, Any]] = {}
    unique_ids = list(OrderedDict.fromkeys(video_ids))

    for index in range(0, len(unique_ids), 50):
        chunk = unique_ids[index : index + 50]
        payload = call_youtube(
            "videos",
            {
                "part": "snippet,statistics,contentDetails,status",
                "id": ",".join(chunk),
            },
            api_key,
        )
        for item in payload.get("items", []):
            video_id = item.get("id")
            if video_id:
                details[video_id] = item
        time.sleep(sleep_seconds)

    return details


def build_rows(
    search_hits: list[dict[str, Any]],
    video_details: dict[str, dict[str, Any]],
) -> list[dict[str, Any]]:
    grouped_hits: OrderedDict[str, dict[str, Any]] = OrderedDict()
    for hit in search_hits:
        video_id = hit["video_id"]
        grouped = grouped_hits.setdefault(
            video_id,
            {
                "keywords": [],
                "search_title": hit.get("search_title", ""),
                "search_published_at": hit.get("search_published_at", ""),
            },
        )
        grouped["keywords"].append(hit["keyword"])

    now = datetime.now(timezone.utc)
    rows: list[dict[str, Any]] = []
    for video_id, hit_info in grouped_hits.items():
        detail = video_details.get(video_id)
        if not detail:
            continue

        snippet = detail.get("snippet", {})
        statistics = detail.get("statistics", {})
        content_details = detail.get("contentDetails", {})
        status = detail.get("status", {})

        title = clean_text(snippet.get("title") or hit_info.get("search_title") or "")
        description = clean_text(snippet.get("description") or "")
        channel_title = clean_text(snippet.get("channelTitle") or "")
        published_at = snippet.get("publishedAt") or hit_info.get("search_published_at") or ""
        tags = [clean_text(tag) for tag in snippet.get("tags", []) if clean_text(tag)]
        duration_seconds = parse_duration_seconds(content_details.get("duration", ""))

        views = parse_int(statistics.get("viewCount"))
        likes = parse_int(statistics.get("likeCount"))
        comments = parse_int(statistics.get("commentCount"))
        engagement_rate_pct = round(((likes + comments) / views) * 100, 3) if views else 0.0

        published_dt = parse_rfc3339(published_at)
        if published_dt:
            age_days = max((now - published_dt).total_seconds() / 86400, 0.1)
        else:
            age_days = 0.0
        views_per_day = round(views / age_days, 2) if age_days else 0.0
        opportunity_score = round(views_per_day * (1 + min(engagement_rate_pct, 20) / 100), 2)

        rows.append(
            {
                "video_id": video_id,
                "title": title,
                "channel_title": channel_title,
                "published_at": published_at,
                "age_days": round(age_days, 2),
                "duration": format_duration(duration_seconds),
                "duration_seconds": duration_seconds,
                "views": views,
                "likes": likes,
                "comments": comments,
                "engagement_rate_pct": engagement_rate_pct,
                "views_per_day": views_per_day,
                "opportunity_score": opportunity_score,
                "license": status.get("license", ""),
                "title_signals": "; ".join(detect_title_signals(title, duration_seconds, tags)),
                "matched_keywords": "; ".join(OrderedDict.fromkeys(hit_info["keywords"])),
                "tags": "; ".join(tags),
                "url": f"https://www.youtube.com/watch?v={video_id}",
                "description_sample": description[:220],
            }
        )

    return rows


def clean_text(value: Any) -> str:
    return " ".join(html.unescape(str(value or "")).split())


def parse_int(value: Any) -> int:
    try:
        return int(value)
    except (TypeError, ValueError):
        return 0


def parse_rfc3339(value: str) -> datetime | None:
    if not value:
        return None
    try:
        normalized = value.replace("Z", "+00:00")
        parsed = datetime.fromisoformat(normalized)
        if parsed.tzinfo is None:
            return parsed.replace(tzinfo=timezone.utc)
        return parsed.astimezone(timezone.utc)
    except ValueError:
        return None


def parse_duration_seconds(duration: str) -> int:
    match = re.fullmatch(
        r"P(?:(?P<days>\d+)D)?(?:T(?:(?P<hours>\d+)H)?(?:(?P<minutes>\d+)M)?(?:(?P<seconds>\d+)S)?)?",
        duration or "",
    )
    if not match:
        return 0

    parts = {key: int(value or 0) for key, value in match.groupdict().items()}
    return (
        parts["days"] * 86400
        + parts["hours"] * 3600
        + parts["minutes"] * 60
        + parts["seconds"]
    )


def format_duration(total_seconds: int) -> str:
    if total_seconds <= 0:
        return ""
    hours, remainder = divmod(total_seconds, 3600)
    minutes, seconds = divmod(remainder, 60)
    if hours:
        return f"{hours}:{minutes:02d}:{seconds:02d}"
    return f"{minutes}:{seconds:02d}"


def detect_title_signals(title: str, duration_seconds: int, tags: list[str]) -> list[str]:
    signals: list[str] = []
    lowered_title = title.casefold()
    lowered_tags = " ".join(tags).casefold()

    for label, patterns in TITLE_SIGNAL_PATTERNS.items():
        if any(re.search(pattern, lowered_title, flags=re.IGNORECASE) for pattern in patterns):
            signals.append(label)

    if duration_seconds and duration_seconds <= 60:
        signals.append("shorts-length")
    if "#shorts" in lowered_title or "shorts" in lowered_tags:
        signals.append("shorts-tag")

    return list(OrderedDict.fromkeys(signals))


def sort_and_filter_rows(rows: list[dict[str, Any]], args: argparse.Namespace) -> list[dict[str, Any]]:
    filtered = [row for row in rows if row["views"] >= args.min_views]
    if args.sort == "published_at":
        return sorted(
            filtered,
            key=lambda row: parse_rfc3339(str(row.get("published_at") or "")) or datetime.min.replace(tzinfo=timezone.utc),
            reverse=True,
        )
    return sorted(filtered, key=lambda row: float(row.get(args.sort) or 0), reverse=True)


def export_rows(rows: list[dict[str, Any]], args: argparse.Namespace) -> str:
    ensure_parent_dir(args.output)
    if pd is not None and not args.no_pandas:
        dataframe = pd.DataFrame(rows, columns=CSV_FIELDS)
        dataframe.to_csv(args.output, index=False, encoding="utf-8-sig")
        export_mode = f"pandas DataFrame ({len(dataframe)} rows)"
    else:
        with open(args.output, "w", newline="", encoding="utf-8-sig") as csv_file:
            writer = csv.DictWriter(csv_file, fieldnames=CSV_FIELDS)
            writer.writeheader()
            writer.writerows(rows)
        export_mode = f"built-in CSV writer ({len(rows)} rows)"

    if args.json_output:
        ensure_parent_dir(args.json_output)
        with open(args.json_output, "w", encoding="utf-8") as json_file:
            json.dump(rows, json_file, ensure_ascii=False, indent=2)

    return export_mode


def ensure_parent_dir(path: str) -> None:
    parent = os.path.dirname(os.path.abspath(path))
    if parent:
        os.makedirs(parent, exist_ok=True)


def print_summary(rows: list[dict[str, Any]], args: argparse.Namespace, export_mode: str) -> None:
    if args.quiet:
        return

    print("\n=== TOM Gaming TH YouTube idea research ===")
    print(f"Rows exported: {len(rows)} via {export_mode}")
    print(f"CSV: {args.output}")
    if args.json_output:
        print(f"JSON: {args.json_output}")

    if not rows:
        print("No videos matched the current filters.")
        return

    top_rows = rows[: args.show_top]
    print(f"\nTop {len(top_rows)} by {args.sort}:")
    for index, row in enumerate(top_rows, start=1):
        print(
            f"{index:>2}. {row['views']:,} views | {row['views_per_day']:,.0f}/day | "
            f"{row['engagement_rate_pct']:.2f}% ER | {row['title']} ({row['channel_title']})"
        )
        print(f"    {row['url']}")

    pattern_summary = analyze_patterns(top_rows)
    print_counter("Title signals", pattern_summary["signals"])
    print_counter("Frequent title terms", pattern_summary["terms"])
    print_counter("Frequent tags", pattern_summary["tags"])


def analyze_patterns(rows: list[dict[str, Any]]) -> dict[str, Counter[str]]:
    term_counter: Counter[str] = Counter()
    tag_counter: Counter[str] = Counter()
    signal_counter: Counter[str] = Counter()

    for row in rows:
        title = row.get("title", "")
        terms = [
            token.casefold()
            for token in TOKEN_RE.findall(title)
            if token.casefold() not in STOPWORDS and len(token) > 1
        ]
        term_counter.update(terms)

        tags = [tag.strip().casefold() for tag in str(row.get("tags", "")).split(";") if tag.strip()]
        tag_counter.update(tags)

        signals = [
            signal.strip()
            for signal in str(row.get("title_signals", "")).split(";")
            if signal.strip()
        ]
        signal_counter.update(signals)

    return {"terms": term_counter, "tags": tag_counter, "signals": signal_counter}


def print_counter(label: str, counter: Counter[str], limit: int = 8) -> None:
    if not counter:
        return
    formatted = ", ".join(f"{value} ({count})" for value, count in counter.most_common(limit))
    print(f"\n{label}: {formatted}")


def main() -> int:
    args = parse_args()
    api_key = os.getenv(args.api_key_env)
    if not api_key:
        print(
            f"Missing API key. Set {args.api_key_env}, for example:\n"
            f"  export {args.api_key_env}='YOUR_YOUTUBE_DATA_API_KEY'",
            file=sys.stderr,
        )
        return 2

    keywords = load_keywords(args)
    published_after = build_published_after(args)

    if not args.quiet:
        print("Searching metadata only via the official YouTube Data API v3.")
        print(f"Keywords: {', '.join(keywords)}")
        if published_after:
            print(f"Published after: {published_after}")
        if args.creative_commons:
            print("License filter: Creative Commons only")

    try:
        search_hits: list[dict[str, Any]] = []
        for keyword in keywords:
            if not args.quiet:
                print(f"Searching: {keyword}")
            search_hits.extend(search_videos(api_key, keyword, args, published_after))

        video_ids = [hit["video_id"] for hit in search_hits]
        video_details = fetch_video_details(api_key, video_ids, args.sleep)
        rows = sort_and_filter_rows(build_rows(search_hits, video_details), args)
        export_mode = export_rows(rows, args)
        print_summary(rows, args, export_mode)
        return 0
    except RuntimeError as exc:
        print(f"Error: {exc}", file=sys.stderr)
        return 1
    except KeyboardInterrupt:
        print("Interrupted.", file=sys.stderr)
        return 130


if __name__ == "__main__":
    raise SystemExit(main())
