# XAMPP Setup Guide - ServiceFinder

## সমস্যা: ওয়েবসাইট XAMPP এ দেখাচ্ছে না

### ধাপ ১: XAMPP চালু করুন

1. XAMPP Control Panel খুলুন
2. **Apache** Start করুন (বাম পাশে Start বাটন)
3. **MySQL** Start করুন (বাম পাশে Start বাটন)
4. দুটোই Green হয়ে যাওয়া পর্যন্ত অপেক্ষা করুন

### ধাপ ২: ফাইল স্থানান্তর

1. আপনার project folder (`servicefinder`) কপি করুন
2. XAMPP এর `htdocs` folder এ রাখুন
   - Path: `C:\xampp\htdocs\servicefinder`
   - বা Windows এর ক্ষেত্রে: `D:\xampp\htdocs\servicefinder`

### ধাপ ৩: Database তৈরি করুন

#### Option A: phpMyAdmin দিয়ে (আসান)

1. Browser এ যান: `http://localhost/phpmyadmin`
2. বাম পাশে "New" ক্লিক করুন
3. Database name দিন: `servicefinder`
4. Collation: `utf8_general_ci`
5. "Create" ক্লিক করুন
6. উপরে "SQL" tab এ ক্লিক করুন
7. `database_setup.sql` ফাইল খুলুন এবং সব কোড copy করুন
8. phpMyAdmin এর SQL box এ paste করুন
9. "Go" বা Ctrl+Enter চাপুন

#### Option B: SQL File Import

1. Browser এ যান: `http://localhost/phpmyadmin`
2. উপরে "Import" tab এ ক্লিক করুন
3. "Choose File" এ ক্লিক করে `database_setup.sql` select করুন
4. "Go" ক্লিক করুন

### ধাপ ৪: Test করুন

1. Browser এ যান: `http://localhost/servicefinder/test.php`
   - যদি সব সবুজ (✅) দেখায়, মানে সব ঠিক আছে!
   - যদি লাল (❌) দেখায়, error message দেখুন এবং fix করুন

2. Main website: `http://localhost/servicefinder/index.php`

### ধাপ ৫: Default Login Credentials

**Admin Account:**
- Username: `admin`
- Password: `admin123`

**User Account:**
- Username: `user`  
- Password: `user123`

### Common Problems & Solutions

#### Problem 1: "Connection failed"
**Solution:** XAMPP Control Panel এ MySQL Start হয়েছে কিনা check করুন

#### Problem 2: "Database not found"
**Solution:** `database_setup.sql` file phpMyAdmin এ run করুন

#### Problem 3: "Access Denied" or Blank Page
**Solution:** 
- PHP errors check করুন: `test.php` page visit করুন
- Browser console (F12) এ error দেখুন

#### Problem 4: Page Not Found (404)
**Solution:** 
- URL check করুন: `http://localhost/servicefinder/index.php`
- Folder name সঠিক আছে কিনা check করুন

### Testing Checklist

- [ ] Apache running (Green)
- [ ] MySQL running (Green)
- [ ] Files in `htdocs/servicefinder` folder
- [ ] Database `servicefinder` created
- [ ] Tables `service_users` and `services` exist
- [ ] `test.php` shows all green checkmarks
- [ ] `index.php` loads successfully

### Still Not Working?

1. `test.php` file visit করুন: `http://localhost/servicefinder/test.php`
2. Error messages দেখুন
3. XAMPP error logs check করুন:
   - Apache: `C:\xampp\apache\logs\error.log`
   - MySQL: `C:\xampp\mysql\data\*.err`

### Port Conflicts

যদি Port 80 বা 3306 already use হয়ে থাকে:
- Apache port change: `C:\xampp\apache\conf\httpd.conf` → `Listen 8080`
- URL হবে: `http://localhost:8080/servicefinder/`

### Contact

যদি আরো সমস্যা হয়, `test.php` এর output screenshot নিয়ে help নিন।

