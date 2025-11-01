@echo off
echo ========================================
echo   Windows Firewall Setup for Apache
echo ========================================
echo.
echo This will add a firewall rule to allow Apache (port 80)
echo.
echo You need to run this as Administrator!
echo.
pause

netsh advfirewall firewall add rule name="Apache XAMPP HTTP" dir=in action=allow protocol=TCP localport=80

if %errorlevel% == 0 (
    echo.
    echo ========================================
    echo SUCCESS! Firewall rule added.
    echo ========================================
    echo.
    echo Apache port 80 is now accessible from network.
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

