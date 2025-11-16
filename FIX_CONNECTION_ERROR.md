# Fix Connection Error - Website Login

## Problem
Getting "Connection error. Please try again." when trying to login on the website.

## Solutions

### 1. Make Sure XAMPP is Running
The website needs Apache and MySQL to be running:

```batch
# Start XAMPP services
1. Open XAMPP Control Panel
2. Click "Start" for Apache
3. Click "Start" for MySQL
```

### 2. Check File Location
The website files must be in the correct location:

**Option A: XAMPP htdocs (Recommended)**
```
C:\xampp\htdocs\pantheos\
  ├── pantheos-optimized.html
  ├── api\
  │   └── account.php
  │   └── config.php
  └── (other files)
```

Access at: `http://localhost/pantheos/pantheos-optimized.html`

**Option B: Direct File Access**
If opening the HTML file directly (file:///...), the API won't work due to CORS.
You MUST use a web server (XAMPP).

### 3. Verify API Configuration

Check `website/api/config.php`:
```php
<?php
// Database configuration
$db_host = 'localhost';
$db_name = 'pantheos_mmorpg';
$db_user = 'root';
$db_pass = '';  // Default XAMPP password is empty

// API Key
$api_key = 'your_secret_api_key_here';
```

### 4. Test API Directly

Open in browser: `http://localhost/pantheos/api/account.php`

You should see:
```json
{"success":false,"error":"Invalid API key"}
```

If you see this, the API is working!

### 5. Check Browser Console

1. Press F12 to open Developer Tools
2. Go to "Console" tab
3. Try logging in again
4. Look for error messages

Common errors:
- **404 Not Found** - File path is wrong
- **CORS error** - Not using a web server
- **500 Internal Server Error** - PHP error, check Apache error logs

### 6. Quick Fix Script

Run this to copy files to XAMPP:

```batch
@echo off
echo Copying website files to XAMPP...

REM Create directory
mkdir "C:\xampp\htdocs\pantheos" 2>nul

REM Copy files
xcopy /E /Y "website\*" "C:\xampp\htdocs\pantheos\"

echo.
echo Done! Access at: http://localhost/pantheos/pantheos-optimized.html
pause
```

Save as `copy_to_xampp.bat` and run it.

### 7. Alternative: Use PHP Built-in Server

If XAMPP isn't working, use PHP's built-in server:

```batch
cd website
php -S localhost:8000
```

Then access: `http://localhost:8000/pantheos-optimized.html`

## Still Not Working?

1. Check XAMPP Apache error logs: `C:\xampp\apache\logs\error.log`
2. Make sure MySQL database `pantheos_mmorpg` exists
3. Verify the `players` table exists in the database
4. Try creating a test account using `website/test_api.html`
