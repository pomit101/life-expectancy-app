# 📦 Detailed Installation Guide

ขั้นตอนการติดตั้ง Life Expectancy App อย่างละเอียด

---

## Requirements

### Minimum System Requirements
- **PHP:** 7.4 หรือสูงกว่า
- **MySQL:** 5.7 หรือสูงกว่า (หรือ MariaDB 10.3+)
- **Apache:** 2.4+ (with mod_rewrite)
- **Disk Space:** 500 MB (โปรแกรม) + additional สำหรับ database
- **RAM:** 512 MB

### Recommended
- **PHP:** 8.0+
- **MySQL:** 8.0+
- **Server:** Dedicated or managed hosting with cPanel/Plesk

---

## Step 1: Prepare Your System

### For Linux/Ubuntu

```bash
# Update system packages
sudo apt update
sudo apt upgrade -y

# Install Apache
sudo apt install apache2 -y

# Install PHP and extensions
sudo apt install php php-mysql php-json php-xml php-curl -y

# Install MySQL
sudo apt install mysql-server -y

# Enable Apache modules
sudo a2enmod rewrite
sudo systemctl restart apache2
```

### For Windows (Using XAMPP)

1. Download XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org)
2. Install XAMPP (includes Apache, MySQL, PHP)
3. Start Apache and MySQL from Control Panel

### For macOS (Using Homebrew)

```bash
# Install Homebrew first if not installed
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install PHP
brew install php

# Install MySQL
brew install mysql

# Start MySQL
brew services start mysql
```

---

## Step 2: Create Database User

### Linux/macOS

```bash
# Connect to MySQL
mysql -u root -p

# Create database
CREATE DATABASE life_expectancy_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Create user (สำหรับ local development)
CREATE USER 'life_user'@'localhost' IDENTIFIED BY 'your_secure_password';

# Grant permissions
GRANT ALL PRIVILEGES ON life_expectancy_app.* TO 'life_user'@'localhost';
FLUSH PRIVILEGES;

# Exit MySQL
EXIT;
```

### Windows (phpMyAdmin)

1. เปิด phpMyAdmin จาก `http://localhost/phpmyadmin`
2. ล็อกอินด้วย username: `root`
3. ไปที่ "Databases"
4. สร้างตัวแปรใหม่: `life_expectancy_app`
5. ตั้งค่า Collation: `utf8mb4_unicode_ci`

---

## Step 3: Download/Clone Project

### Option A: Clone from GitHub

```bash
# Navigate to web directory
cd /var/www/html  # Linux
cd /Applications/XAMPP/htdocs  # macOS
cd C:\xampp\htdocs  # Windows

# Clone repository
git clone https://github.com/pomit101/life-expectancy-app.git
cd life-expectancy-app
```

### Option B: Manual Download

1. ดาวน์โหลด .zip จาก GitHub
2. แตกไฟล์ในโฟลเดอร์ `htdocs` หรือ `html`
3. เข้าไปในโฟลเดอร์ `life-expectancy-app`

---

## Step 4: Install Dependencies

```bash
# Check if Composer is installed
composer --version

# If not installed, download from https://getcomposer.org

# Install dependencies
composer install
```

---

## Step 5: Configure Environment

```bash
# Copy environment file
cp .env.example .env

# Edit .env file with your settings
nano .env  # or use your editor
```

**Edit the following values:**

```
DB_HOST=localhost
DB_USER=life_user
DB_PASS=your_secure_password
DB_NAME=life_expectancy_app
BASE_URL=http://localhost/life-expectancy-app/public/
```

---

## Step 6: Import Database Schema

### Option A: Command Line

```bash
# Using MySQL command
mysql -u life_user -p life_expectancy_app < database/schema.sql

# When prompted, enter the password you created
```

### Option B: phpMyAdmin

1. เปิด phpMyAdmin
2. เลือก database `life_expectancy_app`
3. ไปที่ "Import"
4. เลือกไฟล์ `database/schema.sql`
5. คลิก "Go"

### Option C: Manual via MySQL CLI

```bash
mysql -u life_user -p
USE life_expectancy_app;
SOURCE /path/to/database/schema.sql;
EXIT;
```

---

## Step 7: Set File Permissions

### Linux/macOS

```bash
# Navigate to project
cd /var/www/html/life-expectancy-app

# Set permissions
chmod 755 public/
chmod 755 src/
chmod 755 database/

# If running with Apache user
sudo chown -R www-data:www-data .
```

### Windows

ปกติ Windows ไม่ต้องตั้งค่า permissions เมื่อใช้ XAMPP

---

## Step 8: Configure Web Server

### Apache Configuration

#### For Linux/macOS

**Create virtual host:**

```bash
# Edit Apache config
sudo nano /etc/apache2/sites-available/life-expectancy-app.conf
```

**Add the following:**

```apache
<VirtualHost *:80>
    ServerName life-expectancy-app.local
    ServerAlias www.life-expectancy-app.local
    DocumentRoot /var/www/html/life-expectancy-app/public
    
    <Directory /var/www/html/life-expectancy-app/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteBase /
            RewriteRule ^index\.php$ - [L]
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule . /index.php [L]
        </IfModule>
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/life-expectancy-error.log
    CustomLog ${APACHE_LOG_DIR}/life-expectancy-access.log combined
</VirtualHost>
```

**Enable site and restart:**

```bash
sudo a2ensite life-expectancy-app.conf
sudo apache2ctl configtest
sudo systemctl restart apache2
```

**Add to hosts file:**

```bash
sudo nano /etc/hosts
# Add: 127.0.0.1 life-expectancy-app.local
```

#### For Windows (XAMPP)

Edit `C:\xampp\apache\conf\extra\httpd-vhosts.conf` and add:

```apache
<VirtualHost *:80>
    ServerName life-expectancy-app.local
    DocumentRoot "C:/xampp/htdocs/life-expectancy-app/public"
    
    <Directory "C:/xampp/htdocs/life-expectancy-app/public">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Edit `C:\Windows\System32\drivers\etc\hosts` and add:
```
127.0.0.1 life-expectancy-app.local
```

Restart Apache from XAMPP Control Panel.

---

## Step 9: Verify Installation

### Check PHP Version
```bash
php -v
```
Should show: PHP 7.4 or higher

### Check Database Connection
```bash
php -r "
\$pdo = new PDO('mysql:host=localhost;dbname=life_expectancy_app', 'life_user', 'your_password');
echo 'Database connection successful!';
"
```

### Test via Browser

Navigate to one of these URLs:

```
http://localhost/life-expectancy-app/public/
http://127.0.0.1/life-expectancy-app/public/
http://life-expectancy-app.local/  (if configured)
```

---

## Step 10: Import Sample Data (Optional)

```bash
mysql -u life_user -p life_expectancy_app < database/sample_data.sql
```

---

## Troubleshooting

### Issue: 404 Error

**Solution:**
- Verify `.htaccess` exists in `public/` folder
- Enable mod_rewrite: `sudo a2enmod rewrite && sudo systemctl restart apache2`
- Check Apache configuration for AllowOverride All

### Issue: Database Connection Failed

**Solution:**
```bash
# Test connection
mysql -u life_user -p -h localhost life_expectancy_app
# Enter password when prompted
```

### Issue: Permission Denied

**Solution:**
```bash
sudo chown -R www-data:www-data /var/www/html/life-expectancy-app
sudo chmod -R 755 /var/www/html/life-expectancy-app
```

### Issue: PHP Extensions Not Found

**Solution:**
```bash
# Check installed extensions
php -m

# Install missing extensions
sudo apt install php-mysql php-json php-xml php-curl
```

### Issue: MySQL Connection Timeout

**Solution:**
- Increase timeout in `src/config/database.php`
- Check if MySQL server is running: `sudo systemctl status mysql`

---

## Post-Installation

### 1. Change Database Passwords

For production, use strong passwords:

```bash
mysql -u root -p
ALTER USER 'life_user'@'localhost' IDENTIFIED BY 'new_strong_password_here';
FLUSH PRIVILEGES;
EXIT;
```

### 2. Update .env File

```
APP_ENV=production
APP_DEBUG=false
```

### 3. Set Up Regular Backups

```bash
# Create backup script
#!/bin/bash
mysqldump -u life_user -p'password' life_expectancy_app > /backups/life_expectancy_app_$(date +%Y%m%d).sql
```

### 4. Enable HTTPS (Production)

Use Let's Encrypt for free SSL certificates

---

## Getting Help

If you encounter issues:

1. Check error logs:
   - Apache: `/var/log/apache2/life-expectancy-error.log`
   - PHP: `/var/log/php-fpm.log`
   - MySQL: `/var/log/mysql/error.log`

2. Test configuration:
   ```bash
   php -l public/index.php  # Syntax check
   ```

3. Create GitHub Issue with:
   - Error message
   - System information (OS, PHP version, MySQL version)
   - Steps to reproduce

---

## Maintenance

### Regular Tasks

```bash
# Backup database (weekly)
mysqldump -u life_user -p life_expectancy_app > backup_$(date +%Y%m%d).sql

# Check disk space
df -h

# Monitor logs
tail -f /var/log/apache2/access.log

# Update Composer packages (monthly)
composer update --no-dev
```

---

**Installation Date:** 2024-04-07 15:41:23
**Version:** 1.0.0

Congratulations! Your Life Expectancy App is now ready to use! 🎉