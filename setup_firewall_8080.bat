@echo off
echo ========================================
echo   Windows Firewall Setup for Apache (Port 8080)
echo ========================================
echo.
echo This will add a firewall rule to allow Apache on port 8080
echo.
echo You need to run this as Administrator!
echo.
pause

netsh advfirewall firewall add rule name="Apache XAMPP Port 8080" dir=in action=allow protocol=TCP localport=8080

if %errorlevel% == 0 (
    echo.
    echo ========================================
    echo SUCCESS! Firewall rule added for port 8080.
    echo ========================================
    echo.
    echo Apache port 8080 is now accessible from network.
    echo.
    echo Access your website at: http://YOUR_IP:8080/servicefinder
    echo.
) else (
    echo.
    echo ========================================
    echo ERROR! Failed to add firewall rule.
    echo ========================================
    echo.
    echo Please run this file as Administrator:
    echo 1. Right-click this file
    echo 2. Select "Run as administrator"
    echo.
)

pause

