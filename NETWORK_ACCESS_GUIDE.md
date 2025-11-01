# Browser এ Direct Link দিয়ে Website Show করার Guide

## সমস্যা: localhost এ কাজ করছে, কিন্তু browser এ direct link দিয়ে দেখা যাচ্ছে না

## সমাধান ১: Local Network থেকে Access (Same WiFi/Router)

### Step 1: Your Computer IP Address জানুন

1. **Command Prompt** খুলুন (Win + R → cmd)
2. এই command টি type করুন:
   ```
   ipconfig
   ```
3. **IPv4 Address** খুঁজুন, যেমন: `192.168.1.100` বা `192.168.0.105`

### Step 2: XAMPP Apache Configure করুন

1. XAMPP Control Panel এ **Apache** এর পাশে **Config** button এ click করুন
2. **httpd.conf** select করুন
3. File খুলবে Notepad এ

4. **Line 245** এর আশেপাশে খুঁজুন:
   ```
   Listen 80
   ```
   
5. এই line এর নিচে add করুন:
   ```
   Listen 0.0.0.0:80
   ```

6. **Line 277** এর আশেপাশে খুঁজুন (লগ করে থাকলে):
   ```
   <Directory />
       AllowOverride none
       Require all denied
   </Directory>
   ```
   
   বা দেখবেন:
   ```
   <Directory "C:/xampp/htdocs">
       ...
   </Directory>
   ```

7. **Line 277** এর পরিবর্তে বা তার নিচে add করুন:
   ```
   <Directory "C:/xampp/htdocs">
       Options Indexes FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
   ```

8. **File → Save** করুন
9. XAMPP Control Panel এ **Apache → Stop** করুন
10. **Apache → Start** করুন (restart)

### Step 3: Windows Firewall Allow করুন

1. **Windows Settings** → **Update & Security** → **Windows Security**
2. **Firewall & network protection** → **Advanced settings**
3. **Inbound Rules** → **New Rule**
4. **Port** → **Next**
5. **TCP** → **Specific local ports: 80** → **Next**
6. **Allow the connection** → **Next**
7. সব checkbox check করুন → **Next**
8. Name: `Apache XAMPP` → **Finish**

**অথবা Quick Method:**
- Command Prompt এ (Admin হিসেবে):
```
netsh advfirewall firewall add rule name="Apache XAMPP" dir=in action=allow protocol=TCP localport=80
```

### Step 4: Access করুন

1. **Same WiFi/Router** এ থাকা অন্য device থেকে:
   ```
   http://YOUR_IP_ADDRESS/servicefinder
   ```
   
   যেমন: `http://192.168.1.100/servicefinder`

2. **আপনার নিজের computer থেকেও:**
   ```
   http://YOUR_IP_ADDRESS/servicefinder
   ```

---

## সমাধান ২: Internet থেকে Access (Public URL)

### Option A: ngrok ব্যবহার (সহজ)

1. **ngrok** download করুন: https://ngrok.com/
2. Extract করুন
3. Command Prompt এ:
   ```
   cd C:\path\to\ngrok
   ngrok http 80
   ```
4. ngrok একটা URL দেবে, যেমন: `https://abc123.ngrok.io`
5. সেই URL দিয়ে access করুন: `https://abc123.ngrok.io/servicefinder`

### Option B: Port Forwarding (Advanced)

1. Router এর admin panel এ login করুন
2. **Port Forwarding** section find করুন
3. Add rule:
   - **External Port:** 80 (or any port like 8080)
   - **Internal IP:** আপনার computer এর IP (Step 1 এ পাওয়া)
   - **Internal Port:** 80
   - **Protocol:** TCP
4. Save করুন
5. http://your-public-ip/servicefinder ব্যবহার করুন

**⚠️ Warning:** Internet থেকে accessible করলে security concern আছে। Production environment এর জন্য proper security setup করুন।

---

## সমাধান ৩: Host File দিয়ে Custom Domain

### Step 1: Find Your IP
```
ipconfig
```
Note করুন: `192.168.x.x`

### Step 2: Edit Hosts File

1. **Notepad** run করুন **as Administrator**
2. File → Open → `C:\Windows\System32\drivers\etc\hosts`
3. File এর শেষে add করুন:
   ```
   192.168.1.100    servicefinder.local
   ```
   (আপনার IP দিয়ে replace করুন)
4. Save করুন

### Step 3: Access করুন
```
http://servicefinder.local/servicefinder
```

---

## Testing Checklist

- [ ] Apache running in XAMPP
- [ ] Firewall rule added for port 80
- [ ] httpd.conf configured (Require all granted)
- [ ] Apache restarted
- [ ] IP address noted
- [ ] Can access from same network: `http://YOUR_IP/servicefinder`

---

## Quick Fix Script

একটি batch file তৈরি করেছি যা automatically আপনার IP show করবে:
`show_ip.bat` file খুলুন - এটি browser এ automatically open করবে।

---

## Troubleshooting

### Problem: "This site can't be reached"
**Solution:**
- Firewall check করুন
- Apache running আছে কিনা check করুন
- IP address correct আছে কিনা verify করুন
- Same network এ আছেন কিনা check করুন

### Problem: "Access Denied"
**Solution:**
- httpd.conf এ `Require all granted` আছে কিনা check করুন
- Apache restart করুন

### Problem: Port 80 already in use
**Solution:**
- Apache config এ port change করুন: `Listen 8080`
- Access: `http://YOUR_IP:8080/servicefinder`
- Firewall rule এ port 8080 allow করুন

---

## Security Notes

⚠️ **Important:**
- Local network থেকে access করতে firewall properly configure করুন
- Internet থেকে access করলে strong passwords ব্যবহার করুন
- Production এর জন্য HTTPS setup করুন
- Database password change করুন (default empty password না রাখুন)

---

## Alternative: Use XAMPP Portable with ngrok

যদি configuration কঠিন লাগে:
1. ngrok install করুন
2. Command: `ngrok http 80`
3. ngrok এর URL use করুন

এটি সবচেয়ে সহজ method!

