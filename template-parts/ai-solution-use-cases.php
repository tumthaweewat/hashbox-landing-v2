<?php
/** Anonymous examples of scoped services; no client identifiers or result metrics. */
?>
<div class="hb-solution-examples">
    <p class="hb-solution-examples__note">ตัวอย่างขอบเขตบริการ · ต้องประเมินข้อมูลและระบบเดิมก่อนเริ่มพัฒนา</p>
    <div class="hb-solution-examples__rows">
        <?php foreach ( hashbox_ai_solution_use_cases() as $example ) : ?>
            <article class="hb-solution-example">
                <h3><?php echo esc_html( $example['title'] ); ?></h3>
                <dl>
                    <div><dt>ปัญหาที่เจอ</dt><dd><?php echo esc_html( $example['problem'] ); ?></dd></div>
                    <div><dt>ระบบช่วยอะไร</dt><dd><?php echo esc_html( $example['solution'] ); ?></dd></div>
                    <div><dt>คนตัดสินใจอะไร</dt><dd><?php echo esc_html( $example['approval'] ); ?></dd></div>
                    <div><dt>วัดผลจากอะไร</dt><dd><?php echo esc_html( $example['measure'] ); ?></dd></div>
                </dl>
            </article>
        <?php endforeach; ?>
    </div>
    <p class="hb-solution-examples__note">ตัวอย่างเหล่านี้อธิบายแนวทางบริการ ไม่ใช่รายงานผลลัพธ์ของลูกค้า งานแจ้งเตือนตามเงื่อนไขใช้ Automation ได้โดยไม่ต้องใช้ AI ทุกขั้นตอน</p>
</div>
