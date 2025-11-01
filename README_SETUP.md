# ServiceFinder - Quick Setup Guide

## 🚀 XAMPP এ Setup করার পদ্ধতি

### ১. XAMPP Install করুন (যদি না থাকে)
- https://www.apachefriends.org/ থেকে download করুন
- Install করুন

### ২. Project Folder Copy করুন
```
C:\xampp\htdocs\servicefinder
```
এখানে সব files রাখুন

### ৩. XAMPP Start করুন
1. XAMPP Control Panel খুলুন
2. **Apache** → Start
3. **MySQL** → Start

### ৪. Database তৈরি করুন
1. Browser এ যান: `http://localhost/phpmyadmin`
2. New Database তৈরি করুন: `servicefinder`
3. SQL tab এ যান
4. `database_setup.sql` file এর content copy করে paste করুন
5. Go button চাপুন

### ৫. Website Test করুন
```
http://localhost/servicefinder/test.php
```
এই page এ সব ঠিক আছে কিনা দেখতে পাবেন

### ৬. Main Website
```
http://localhost/servicefinder/index.php
```

## 🔑 Default Login

**Admin:**
- Username: `admin`
- Password: `admin123`

**User:**
- Username: `user`
- Password: `user123`

## ❗ Common Issues

### Page Blank বা Error দেখাচ্ছে?
1. `test.php` visit করুন
2. Error message দেখুন
3. XAMPP MySQL running আছে কিনা check করুন

### Database Error?
1. phpMyAdmin এ যান
2. Database `servicefinder` আছে কিনা check করুন
3. `database_setup.sql` আবার run করুন

### File Not Found?
- Folder path check করুন: `htdocs/servicefinder`
- URL check করুন: `http://localhost/servicefinder/`

## 📝 Next Steps

1. Admin account দিয়ে login করুন
2. Services add করুন
3. User account দিয়ে services search করুন

## 🆘 Help Needed?

`test.php` page visit করে screenshot নিয়ে help নিন!

