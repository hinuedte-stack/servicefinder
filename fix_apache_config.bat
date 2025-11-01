@echo off
echo ========================================
echo   XAMPP Apache Configuration Helper
echo ========================================
echo.
echo This will help you configure Apache for network access.
echo.
echo Step 1: Finding XAMPP installation...
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
echo Step 2: Opening httpd.conf file...
echo You need to make these changes:
echo.
echo 1. Find: Listen 80
echo    Add below it: Listen 0.0.0.0:80
echo.
echo 2. Find: ^<Directory "D:/xampp/htdocs"^>
echo    Change to: Require all granted (instead of Require local)
echo.
echo 3. Save the file
echo 4. Restart Apache in XAMPP Control Panel
echo.
pause

notepad "%XAMPP_PATH%\apache\conf\httpd.conf"

echo.
echo ========================================
echo Configuration file opened!
echo After making changes:
echo 1. Save the file (Ctrl+S)
echo 2. Close Notepad
echo 3. Go to XAMPP Control Panel
echo 4. Stop Apache, then Start Apache
echo ========================================
pause

