<?php
/** Shared, anonymous service examples. These are capabilities, not delivery claims. */
if ( ! defined( 'ABSPATH' ) ) { exit; }
function hashbox_ai_solution_use_cases() {
    return array(
        array(
            'title' => 'AI สำหรับเอกสารและงานปฏิบัติการ',
            'problem' => 'ทีมต้องอ่านเอกสาร คีย์ข้อมูลซ้ำ และค้นข้อมูลสินค้าจากหลายระบบ',
            'solution' => 'อ่านและดึงข้อมูลจากเอกสาร เตรียมรายการให้ตรวจสอบ และเชื่อมข้อมูลสินค้าหรือสต็อกจากระบบเดิม',
            'approval' => 'เจ้าหน้าที่ตรวจข้อมูลและอนุมัติรายการก่อนนำเข้าระบบหรือดำเนินการต่อ',
            'measure' => 'เวลาต่อเอกสาร ความถูกต้องของข้อมูล และจำนวนรายการที่ต้องแก้ไข',
        ),
        array(
            'title' => 'AI Agent สำหรับงานขายและบริการ',
            'problem' => 'คำขอลูกค้าเข้าทางอีเมลและไฟล์แนบ ทำให้ทีมเสียเวลารวบรวมข้อมูลก่อนตอบ',
            'solution' => 'คัดแยกอีเมล อ่านคำขอราคา ร่างใบเสนอราคา และเชื่อมข้อมูลกับ CRM หรือระบบงานที่มีสิทธิ์เข้าถึง',
            'approval' => 'ทีมขายตรวจราคา เงื่อนไข และผู้รับก่อนอนุมัติเอกสารที่ส่งให้ลูกค้า',
            'measure' => 'เวลาตั้งแต่รับคำขอถึงร่างพร้อมตรวจ และจำนวนคำขอที่ตกหล่น',
        ),
        array(
            'title' => 'AI สำหรับทีมคอนเทนต์และกองบรรณาธิการ',
            'problem' => 'ทีมใช้เวลาหาข้อมูล เรียบเรียงเนื้อหา และเตรียมโพสต์หลายขั้นตอน',
            'solution' => 'รวบรวมแหล่งข้อมูลที่กำหนด ร่างเนื้อหาตามสไตล์ และจัดคิวให้ทีมตรวจสอบก่อนเผยแพร่',
            'approval' => 'ผู้ดูแลตรวจข้อเท็จจริง แหล่งอ้างอิง และสิทธิ์ใช้ภาพก่อนอนุมัติโพสต์',
            'measure' => 'เวลาจัดเตรียมต่อชิ้น จำนวนรอบแก้ไข และงานที่ผ่านการตรวจ',
        ),
    );
}

function hashbox_enqueue_ai_solution_examples() {
    $path = trim( (string) wp_parse_url( isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '', PHP_URL_PATH ), '/' );
    if ( ! is_page_template( 'page-ai-consulting.php' ) && ! in_array( $path, array( 'ai-workflow-audit', 'services/ai-consulting' ), true ) ) {
        return;
    }
    $file = get_template_directory() . '/css/ai-solution-examples.css';
    wp_enqueue_style( 'hashbox-ai-solution-examples', get_template_directory_uri() . '/css/ai-solution-examples.css', array(), filemtime( $file ) );
}
add_action( 'wp_enqueue_scripts', 'hashbox_enqueue_ai_solution_examples', 25 );

/** Optional qualification data for the existing private enquiry notification. */
function hashbox_ai_solution_intake_details( $posted ) {
    $details = array();
    $types = array(
        'documents-operations' => 'เอกสาร / สินค้า / งานปฏิบัติการ',
        'sales-service' => 'อีเมลขอราคา / งานขาย / บริการลูกค้า',
        'content-editorial' => 'คอนเทนต์ / กองบรรณาธิการ',
        'other' => 'งานอื่น ต้องการให้ช่วยประเมิน',
    );
    $type = isset( $posted['workflow_type'] ) && is_string( $posted['workflow_type'] )
        ? sanitize_key( wp_unslash( $posted['workflow_type'] ) ) : '';
    if ( isset( $types[ $type ] ) ) {
        $details['Workflow type'] = $types[ $type ];
    }
    foreach ( array( 'current_systems' => 'Current systems', 'work_volume' => 'Work volume / baseline' ) as $key => $label ) {
        if ( isset( $posted[ $key ] ) && is_string( $posted[ $key ] ) ) {
            $value = mb_substr( sanitize_text_field( wp_unslash( $posted[ $key ] ) ), 0, 160 );
            if ( '' !== $value ) {
                $details[ $label ] = $value;
            }
        }
    }
    return $details;
}
