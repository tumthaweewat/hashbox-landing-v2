# GTM Runbook — funnel-v2 workspace (ws13)

## gtm-funnel-v2-import.json = **Merge-only delta**
- Import ต้องเลือก **Merge + Rename conflicting** เท่านั้น — **ห้าม Overwrite เด็ดขาด**
  (Overwrite จะลบทุก tag/trigger/variable ที่ไม่อยู่ในไฟล์ = ทำลาย container;
  เหตุการณ์จริง 2026-09-01: preview เคยโชว์ "13 Deleted" เพราะ UI ดีดไป Overwrite+Default Workspace — ต้อง Cancel แล้ว verify chooser + preview ต้องเป็น `0 Deleted` ก่อนกด Add ทุกครั้ง)
- ไฟล์นี้เป็น delta 4 รายการ: trigger `CE | hb_web funnel diagnostics v1`, tag `GA4 | funnel diagnostics | Website Audit | v1`, variables `DL - hb_cta_location`, `DL - hb_field_name`

## Dependencies ที่ต้องมีอยู่แล้วจาก GTM Version 10 (ไม่อยู่ในไฟล์นี้)
- `DL - hb_schema_version` (Data Layer Variable)
- `DL - hb_lead_source` (Data Layer Variable)
- GA4 base tag: `Google Analytics | G-WQ4CG18QQT | All Pages`
- Ads base: `Google Ads | AW-18190672421 | All Pages` + `Conversion Linker | All Pages`
- ถ้า import ลง container ที่ไม่มีของเหล่านี้ tag diagnostics จะ resolve variable ไม่ได้ / GA4 ไม่มี base config

## Publish gate
- ห้าม publish ws13 จนกว่า: T+48h measurement gate ผ่าน + Codex ตรวจ diff + Preview 6/6 แล้วสั่ง go
- Clarity คง **Paused** จนกว่า: scope Page Path `/website-audit/` + Mask all input text (ตั้งใน Clarity dashboard + เก็บ screenshot) + consent/privacy review ผ่าน
