# Hostinger Deployment Checklist for OMPLEO Laravel Application

## 🚀 Pre-Deployment Checklist

### 1. Environment Configuration (.env)
```env
# Application
APP_NAME="OMPLEO"
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database (Hostinger MySQL)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password

# File Storage
FILESYSTEM_DISK=public
MAX_FILE_UPLOAD_SIZE=5120

# Mail Configuration (Hostinger SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=your_email@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

# Cache
CACHE_DRIVER=database
QUEUE_CONNECTION=database
```

### 2. File Upload Configuration

#### Storage Permissions
```bash
# Set correct permissions for storage directories
chmod -R 755 storage/
chmod -R 755 public/storage/
chmod -R 755 bootstrap/cache/
```

#### Storage Link Creation
```bash
# Create symbolic link for public storage
php artisan storage:link
```

#### File Upload Limits
- **PHP Configuration** (php.ini):
  ```ini
  upload_max_filesize = 10M
  post_max_size = 10M
  max_execution_time = 300
  max_input_time = 300
  memory_limit = 256M
  ```

### 3. Directory Structure Verification
```
public/
├── storage/ (symlink to storage/app/public)
├── build/
└── index.php

storage/app/public/
├── avatars/
├── logos/
├── resumes/
├── blog/
└── blog-content/
```

## 🔧 Hostinger-Specific Configuration

### 1. PHP Version
- **Required**: PHP 8.1 or higher
- **Recommended**: PHP 8.2
- **Extensions Required**:
  - BCMath
  - Ctype
  - cURL
  - DOM
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PCRE
  - PDO
  - Tokenizer
  - XML
  - GD (for image processing)
  - Imagick (optional, for advanced image processing)

### 2. Database Setup
1. Create MySQL database in Hostinger control panel
2. Create database user with full privileges
3. Import your database dump
4. Update .env with correct credentials

### 3. File Upload Testing

#### Test Image Uploads
1. **Avatar Upload** (Candidate/Recruiter profiles):
   - Go to profile settings
   - Upload JPG/PNG image (max 2MB)
   - Verify image appears correctly

2. **Company Logo Upload** (Company profiles):
   - Go to company profile
   - Upload logo (max 2MB)
   - Verify logo displays in company listings

3. **Resume Upload** (Job applications):
   - Apply for a job
   - Upload PDF/DOC/DOCX (max 5MB)
   - Verify file is stored correctly

4. **Blog Image Upload** (Admin blog editor):
   - Create/edit blog post
   - Upload featured image
   - Upload content images
   - Verify images display correctly

### 4. Storage Verification Commands
```bash
# Check storage link
ls -la public/storage

# Check storage permissions
ls -la storage/app/public/

# Test file upload
php artisan tinker
>>> Storage::disk('public')->put('test.txt', 'Hello World');
>>> Storage::disk('public')->url('test.txt');
```

## 🐛 Common Issues & Solutions

### Issue 1: "Storage link not found"
**Solution**:
```bash
php artisan storage:link
# If that fails, create manual symlink
ln -s ../storage/app/public public/storage
```

### Issue 2: "File upload fails silently"
**Solutions**:
1. Check PHP upload limits in php.ini
2. Verify storage directory permissions
3. Check Laravel logs: `storage/logs/laravel.log`

### Issue 3: "Images not displaying"
**Solutions**:
1. Verify storage link exists
2. Check file permissions (755 for directories, 644 for files)
3. Clear browser cache
4. Check .env APP_URL is correct

### Issue 4: "File too large" errors
**Solutions**:
1. Increase PHP limits in php.ini:
   ```ini
   upload_max_filesize = 10M
   post_max_size = 10M
   max_execution_time = 300
   ```
2. Check Laravel validation rules in controllers

## 📋 Post-Deployment Testing

### 1. Image Upload Tests
- [ ] Candidate avatar upload
- [ ] Recruiter avatar upload  
- [ ] Company logo upload
- [ ] Blog featured image upload
- [ ] Blog content image upload
- [ ] Resume file upload

### 2. File Display Tests
- [ ] All uploaded images display correctly
- [ ] Images load in different browsers
- [ ] Mobile responsive image display
- [ ] File download links work

### 3. Performance Tests
- [ ] Large file uploads (5MB) complete successfully
- [ ] Multiple simultaneous uploads work
- [ ] Page load times are acceptable

## 🔒 Security Considerations

### 1. File Upload Security
- File type validation is enforced
- File size limits are set
- Files are stored outside web root (storage/app/public)
- Unique filenames prevent conflicts

### 2. Directory Permissions
```bash
# Secure permissions
chmod 755 storage/
chmod 755 public/storage/
chmod 644 storage/app/public/*
```

## 📞 Support Commands

### Debug File Upload Issues
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Check storage configuration
php artisan config:show filesystems

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Verify Upload Functionality
```bash
# Test storage link
php artisan storage:link

# Check file permissions
ls -la storage/app/public/

# Test file operations
php artisan tinker
>>> Storage::disk('public')->exists('avatars/');
>>> Storage::disk('public')->files('avatars/');
```

## ✅ Final Checklist

- [ ] Environment variables configured
- [ ] Database connected and migrated
- [ ] Storage link created
- [ ] File permissions set correctly
- [ ] PHP upload limits configured
- [ ] All image uploads tested
- [ ] File displays verified
- [ ] Error handling tested
- [ ] Performance acceptable
- [ ] Security measures in place

---

**Note**: If you encounter any issues with image uploads on Hostinger, check the Laravel logs first and ensure all file permissions are set correctly. The most common issues are related to storage links and file permissions.
