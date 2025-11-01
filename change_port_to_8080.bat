@echo off
echo ========================================
echo   Change Apache Port to 8080
echo ========================================
echo.
echo This will help you change Apache port from 80 to 8080
echo (Useful if port 80 is already in use)
echo.

set XAMPP_PATH=D:\xampp
if not exist "%XAMPP_PATH%" (
    echo XAMPP not found in D:\xampp
    echo Please edit this file and set correct XAMPP path
    pause
    exit
)

echo XAMPP found at: %XAMPP_PATH%
echo.
echo Opening httpd.conf file...
echo.
echo INSTRUCTIONS:
echo ========================================
echo 1. Find this line (around line 245):
echo    Listen 80
echo.
echo 2. Change it to:
echo    Listen 8080
echo.
echo 3. Find this line (around line 60):
echo    ServerName localhost:80
echo.
echo 4. Change it to:
echo    ServerName localhost:8080
echo.
echo 5. Save the file (Ctrl+S)
echo 6. Close Notepad
echo 7. Restart Apache in XAMPP Control Panel
echo ========================================
echo.
pause

notepad "%XAMPP_PATH%\apache\conf\httpd.conf"

echo.
echo ========================================
echo After making changes:
echo 1. Save the file (Ctrl+S)
echo 2. Close Notepad
echo 3. Go to XAMPP Control Panel
echo 4. Stop Apache, then Start Apache
echo.
echo Then access your website at:
echo http://YOUR_IP:8080/servicefinder
echo ========================================
echo.
pause

