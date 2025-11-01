# Port 8080 এ Website Access করার Guide

## কখন Port 8080 ব্যবহার করবেন?

- ✅ Port 80 already use হয়ে থাকলে
- ✅ "Port 80 is already in use" error দেখালে
- ✅ Skype বা অন্য program port 80 use করলে

---

## 🚀 সহজ Method (Auto Script)

### Step 1: Script Run করুন
1. `change_port_to_8080.bat` file এ double-click করুন
2. এটি automatically httpd.conf file খুলবে
3. Instruction দেখাবে

---

## 📝 Manual Method

### Step 1: httpd.conf File খুলুন

**Method A: XAMPP Control Panel থেকে**
1. XAMPP Control Panel খুলুন
2. **Apache** এর পাশে **Config** button এ click করুন
3. **httpd.conf** select করুন

**Method B: Direct Path**
- File path: `D:\xampp\apache\conf\httpd.conf`
- Notepad দিয়ে open করুন (Run as Administrator)

### Step 2: Port Change করুন

**Change 1: Listen Port**
1. File এ search করুন (Ctrl+F): `Listen 80`
2. Find করুন (আনুমানিক line 245):
   ```
   Listen 80
   ```
3. Change করুন:
   ```
   Listen 8080
   ```

**Change 2: ServerName (যদি থাকে)**
1. File এ search করুন: `ServerName localhost:80`
2. Find করুন (আনুমানিক line 60):
   ```
   ServerName localhost:80
   ```
3. Change করুন:
   ```
   ServerName localhost:8080
   ```

### Step 3: File Save করুন
- **Ctrl+S** press করুন
- File close করুন

### Step 4: Apache Restart করুন
1. XAMPP Control Panel এ যান
2. **Apache** → **Stop** (click করুন)
3. **Apache** → **Start** (click করুন)
4. Green হয়ে যাওয়া পর্যন্ত অপেক্ষা করুন

---

## 🔧 Firewall Setup (Port 8080)

### Step 1: Firewall Rule Add করুন

**Method A: Automatic**
1. `setup_firewall_8080.bat` file create করেছি
2. Right-click → "Run as administrator"

**Method B: Manual**
1. Windows Settings → Update & Security → Windows Security
2. Firewall & network protection → Advanced settings
3. Inbound Rules → New Rule
4. Port → Next
5. TCP → Specific local ports: **8080** → Next
6. Allow the connection → Next
7. সব checkbox check করুন → Next
8. Name: `Apache XAMPP Port 8080` → Finish

---

## 🌐 Website Access করুন

### localhost থেকে:
```
http://localhost:8080/servicefinder
```

### Network/IP থেকে:
```
http://YOUR_IP_ADDRESS:8080/servicefinder
```

**উদাহরণ:**
```
http://192.168.1.100:8080/servicefinder
```

---

## 📋 Quick Checklist

- [ ] httpd.conf এ `Listen 80` → `Listen 8080` change করা হয়েছে
- [ ] httpd.conf এ `ServerName localhost:80` → `ServerName localhost:8080` change করা হয়েছে (যদি থাকে)
- [ ] File save করা হয়েছে
- [ ] Apache restart করা হয়েছে
- [ ] Firewall rule added (port 8080)
- [ ] Browser এ test করা হয়েছে: `http://localhost:8080/servicefinder`

---

## ⚠️ Important Notes

1. **Port Number:** URL এ **:8080** add করতে হবে সবসময়
2. **phpMyAdmin:** phpMyAdmin ও port 8080 এ access করতে হবে:
   ```
   http://localhost:8080/phpmyadmin
   ```
3. **Firewall:** Port 8080 এর জন্য firewall rule add করতে হবে

---

## 🔍 Troubleshooting

### Problem: "Port 8080 is already in use"
**Solution:**
- অন্য port use করুন, যেমন: 8081, 8082, 3000
- httpd.conf এ `Listen 8081` change করুন

### Problem: "This site can't be reached" (Port 8080)
**Solution:**
1. Apache running আছে কিনা check করুন
2. Firewall rule আছে কিনা check করুন (port 8080)
3. URL এ `:8080` add করেছেন কিনা check করুন

### Problem: Port 80 এ কাজ করছে কিন্তু 8080 এ না
**Solution:**
- httpd.conf file এ changes save করেছেন কিনা verify করুন
- Apache restart করেছেন কিনা check করুন
- Browser cache clear করুন

---

## 🎯 Complete Steps Summary

1. ✅ `change_port_to_8080.bat` run করুন
2. ✅ httpd.conf এ `Listen 80` → `Listen 8080` change করুন
3. ✅ File save করুন (Ctrl+S)
4. ✅ Apache restart করুন
5. ✅ Firewall rule add করুন (port 8080)
6. ✅ Test করুন: `http://localhost:8080/servicefinder`

---

## 📱 Phone/Tablet থেকে Access

1. Phone এবং Computer same WiFi এ connect করুন
2. Phone এর browser এ যান:
   ```
   http://YOUR_COMPUTER_IP:8080/servicefinder
   ```
   যেমন: `http://192.168.1.100:8080/servicefinder`

---

**💡 Tip:** যদি port 8080 ও conflict হয়, 8081, 8082, 3000 ইত্যাদি try করুন!

