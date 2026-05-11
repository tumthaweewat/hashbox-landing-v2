# การ Deploy เว็บไซต์ WordPress ไปยัง hashbox.co.th

## ขั้นตอนการ Deploy

### 1. เตรียมไฟล์สำหรับ Upload

#### A. ไฟล์ Theme (โฟลเดอร์ปัจจุบัน)
ไฟล์ทั้งหมดในโฟลเดอร์นี้คือ WordPress Theme ที่จะต้องอัพโลดไปยัง:
```
/wp-content/themes/hashbox-studio/
```

#### B. ไฟล์ที่ต้องอัพโลด:
- `style.css` - ไฟล์ CSS หลักของ theme
- `functions.php` - ฟังก์ชันของ theme
- `index.php` - template หลัก
- `header.php` - header template
- `footer.php` - footer template
- `front-page.php` - หน้าแรก
- `template-parts/` - โฟลเดอร์ template ย่อย
- `js/` - ไฟล์ JavaScript
- `screenshot.jpg` - รูปตัวอย่าง theme

### 2. ขั้นตอนการติดตั้ง WordPress

#### Option A: ใช้ cPanel/Hosting Control Panel
1. **เข้า cPanel ของ hashbox.co.th**
2. **ติดตั้ง WordPress:**
   - ใช้ Softaculous หรือ WordPress Auto Installer
   - หรือดาวน์โหลด WordPress จาก wordpress.org และอัพโลดเอง

3. **อัพโหลด Theme:**
   ```
   /public_html/wp-content/themes/hashbox-studio/
   ```

#### Option B: Manual Installation
1. **ดาวน์โหลด WordPress ล่าสุด**
   ```bash
   wget https://wordpress.org/latest.zip
   unzip latest.zip
   ```

2. **อัพโหลดไฟล์ WordPress ไปยัง server**
   - อัพโหลดไปยัง `/public_html/` หรือ document root

3. **สร้าง Database**
   - สร้าง MySQL database ใหม่
   - สร้าง database user และกำหนดสิทธิ์

### 3. การตั้งค่า wp-config.php

1. **Copy wp-config-sample.php เป็น wp-config.php**
2. **แก้ไขการตั้งค่า Database:**
   ```php
   define( 'DB_NAME', 'hashbox_db' );
   define( 'DB_USER', 'hashbox_user' );
   define( 'DB_PASSWORD', 'your_secure_password' );
   define( 'DB_HOST', 'localhost' );
   ```

3. **สร้าง Security Keys:**
   - ไปที่: https://api.wordpress.org/secret-key/1.1/salt/
   - Copy keys ใหม่มาใส่ใน wp-config.php

### 4. การอัพโหลด Theme

#### ผ่าน FTP/SFTP:
```bash
# อัพโหลดไฟล์ theme ไปยัง
/public_html/wp-content/themes/hashbox-studio/
```

#### ผ่าน WordPress Admin:
1. เข้า WordPress Admin (hashbox.co.th/wp-admin)
2. ไปที่ Appearance > Themes
3. คลิก "Add New" > "Upload Theme"
4. อัพโหลดไฟล์ ZIP ของ theme

### 5. การเปิดใช้งาน Theme

1. **เข้า WordPress Admin**
2. **ไปที่ Appearance > Themes**
3. **เลือก "Hashbox Studio" และคลิก Activate**

### 6. การตั้งค่าเพิ่มเติม

#### A. Permalink Settings:
- ไปที่ Settings > Permalinks
- เลือก "Post name" หรือ custom structure

#### B. Homepage Settings:
- ไปที่ Settings > Reading
- เลือก "A static page" สำหรับ homepage

#### C. Menu Setup:
- ไปที่ Appearance > Menus
- สร้างเมนูและกำหนดตำแหน่ง

### 7. SSL Certificate Setup

#### A. ติดตั้ง SSL Certificate:
- ใช้ Let's Encrypt (ฟรี)
- หรือซื้อ SSL Certificate

#### B. Force HTTPS:
```php
// เพิ่มใน wp-config.php
define( 'FORCE_SSL_ADMIN', true );

// เพิ่มใน .htaccess
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 8. Performance Optimization

#### A. Caching Plugin:
- ติดตั้ง WP Rocket หรือ W3 Total Cache

#### B. Image Optimization:
- ติดตั้ง Smush หรือ ShortPixel

#### C. CDN Setup:
- ใช้ Cloudflare หรือ MaxCDN

### 9. Security Measures

#### A. Security Plugins:
- Wordfence Security
- Sucuri Security

#### B. File Permissions:
```bash
# Directories: 755
find /path/to/wordpress/ -type d -exec chmod 755 {} \;

# Files: 644
find /path/to/wordpress/ -type f -exec chmod 644 {} \;

# wp-config.php: 600
chmod 600 wp-config.php
```

### 10. Backup Strategy

#### A. Database Backup:
```bash
mysqldump -u username -p database_name > backup.sql
```

#### B. File Backup:
- ใช้ UpdraftPlus Plugin
- หรือ backup ผ่าน cPanel

## ไฟล์ที่ต้องการสำหรับ Deploy

### Theme Files (ทั้งหมดในโฟลเดอร์ปัจจุบัน):
- ✅ style.css
- ✅ functions.php
- ✅ index.php
- ✅ header.php
- ✅ footer.php
- ✅ front-page.php
- ✅ template-parts/ (โฟลเดอร์)
- ✅ js/ (โฟลเดอร์)
- ✅ screenshot.jpg

### Configuration Files:
- ✅ wp-config-sample.php (template สำหรับ production)

## Commands สำหรับ Deploy

### สร้างไฟล์ ZIP สำหรับอัพโหลด:
```bash
# สร้าง ZIP ของ theme
zip -r hashbox-studio-theme.zip . -x "*.git*" "*.DS_Store*" "node_modules/*" "DEPLOYMENT-GUIDE.md"
```

### ตรวจสอบไฟล์ที่จำเป็น:
```bash
# ตรวจสอบว่ามีไฟล์ครบหรือไม่
ls -la style.css functions.php index.php header.php footer.php front-page.php
```

## การแก้ไขปัญหาที่อาจเกิดขึ้น

### 1. Theme ไม่แสดงผล:
- ตรวจสอบ file permissions
- ตรวจสอบ PHP errors ใน error log

### 2. CSS ไม่โหลด:
- ตรวจสอบ path ใน functions.php
- Clear cache

### 3. Database Connection Error:
- ตรวจสอบการตั้งค่าใน wp-config.php
- ตรวจสอบว่า database server ทำงานปกติ

## ติดต่อสำหรับความช่วยเหลือ

หากมีปัญหาในการ deploy สามารถติดต่อ:
- Hosting Support
- WordPress Developer
- หรือตรวจสอบ WordPress Codex

---

**หมายเหตุ:** อย่าลืมสำรองข้อมูลก่อนทำการ deploy ทุกครั้ง!