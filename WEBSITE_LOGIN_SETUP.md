# Website Login Setup Guide

## Overview

Your website now has a functional login system that connects to the same MySQL database as your game!

## Features

✅ **User Registration** - Create new accounts
✅ **User Login** - Authenticate with username/password
✅ **Password Hashing** - Bcrypt encryption for security
✅ **Session Management** - LocalStorage for persistent login
✅ **Same Database** - Uses the same MySQL database as the game
✅ **Smooth UI** - Animated modals with error handling

## Setup Instructions

### 1. Copy API Files

The API endpoint is already created at:
```
website/api/account.php
```

This file uses the same database configuration as your game backend.

### 2. Update API Key

In `pantheos-optimized.html`, find and replace the API key:

```javascript
'X-API-Key': 'your_secret_api_key_here'
```

Change it to match your `Network/php_backend/config.php` API key.

### 3. File Structure

```
website/
├── pantheos-optimized.html    # Main website
├── api/
│   └── account.php            # Login/Signup API
├── dengg.jpg                  # Team photos
├── aj.jpg
├── vida.jpg
├── gek.jpg
└── (other images)

Network/php_backend/
├── config.php                 # Shared database config
└── (other game API files)
```

### 4. Test the System

1. **Start XAMPP:**
   - Apache ✅
   - MySQL ✅

2. **Open Website:**
   ```
   http://localhost/pantheos-optimized.html
   ```

3. **Test Signup:**
   - Click profile icon
   - Click "SIGN UP"
   - Enter username, nickname, password
   - Click "CREATE ACCOUNT"
   - Should see success message

4. **Test Login:**
   - Click "LOGIN"
   - Enter username and password
   - Click "LOGIN"
   - Should see welcome message
   - Profile icon changes to show initials

5. **Verify in Database:**
   - Open phpMyAdmin
   - Check `mmorpg_game` → `players` table
   - Your account should be there!

## How It Works

### Registration Flow:
```
1. User fills signup form
2. JavaScript sends POST to api/account.php
3. PHP validates input
4. PHP hashes password with bcrypt
5. PHP inserts into MySQL database
6. Returns success/error
7. JavaScript shows message
```

### Login Flow:
```
1. User fills login form
2. JavaScript sends POST to api/account.php
3. PHP queries database for username
4. PHP verifies password with bcrypt
5. PHP returns player data
6. JavaScript stores in localStorage
7. UI updates to show logged-in state
```

### Data Storage:
```
MySQL Database (mmorpg_game)
└── players table
    ├── player_id
    ├── username
    ├── password_hash (bcrypt)
    ├── nickname
    ├── level
    ├── xp
    ├── gold
    ├── hp
    ├── inventory (JSON)
    ├── quests (JSON)
    └── last_login
```

## Security Features

✅ **Password Hashing** - Bcrypt with salt
✅ **SQL Injection Protection** - Prepared statements
✅ **API Key Authentication** - Prevents unauthorized access
✅ **Input Validation** - Username/password requirements
✅ **CORS Headers** - Configured in config.php

## Integration with Game

The website and game share the same database, so:

1. **Create account on website** → Can login in game
2. **Create account in game** → Can login on website
3. **Same player data** - Level, gold, inventory sync
4. **Same authentication** - One account for both

## Customization

### Change API Endpoint:

In `pantheos-optimized.html`, find:
```javascript
const response = await fetch('api/account.php', {
```

Change to your API URL if different.

### Add More Fields:

In `api/account.php`, add to the INSERT statement:
```php
$stmt = $conn->prepare("
    INSERT INTO players (username, password_hash, nickname, email)
    VALUES (?, ?, ?, ?)
");
```

### Custom Validation:

In `api/account.php`, add validation:
```php
if (strlen($password) < 8) {
    echo json_encode(['success' => false, 'message' => 'Password must be 8+ characters']);
    return;
}
```

## Troubleshooting

### Issue: "Connection error"
**Solution:**
- Check XAMPP Apache is running
- Verify API file path is correct
- Check browser console for errors

### Issue: "Invalid API key"
**Solution:**
- Make sure API key matches in:
  - `pantheos-optimized.html`
  - `Network/php_backend/config.php`

### Issue: "Username already exists"
**Solution:**
- This is normal - username is taken
- Try a different username

### Issue: "Failed to create account"
**Solution:**
- Check MySQL is running
- Verify database exists
- Check PHP error logs: `C:\xampp\apache\logs\error.log`

### Issue: Login doesn't persist
**Solution:**
- Check browser localStorage is enabled
- Clear cache and try again

## Testing Checklist

- [ ] XAMPP running (Apache + MySQL)
- [ ] Database `mmorpg_game` exists
- [ ] Table `players` exists
- [ ] API key matches in both files
- [ ] Can open website in browser
- [ ] Can click profile icon
- [ ] Signup modal opens
- [ ] Can create account
- [ ] Account appears in phpMyAdmin
- [ ] Can login with new account
- [ ] Profile icon updates after login
- [ ] Login persists after page refresh

## Next Steps

1. **Add Email Verification** - Send confirmation emails
2. **Password Reset** - Forgot password functionality
3. **Profile Page** - View/edit player info
4. **Leaderboards** - Show top players from database
5. **News System** - Post updates from admin panel

## Example Usage

### Create Account:
```javascript
// Automatically handled by the form
// User enters: username, nickname, password
// System creates account in database
```

### Login:
```javascript
// Automatically handled by the form
// User enters: username, password
// System authenticates and stores session
```

### Check Login Status:
```javascript
const loggedIn = localStorage.getItem('pantheos_logged_in');
const playerData = JSON.parse(localStorage.getItem('pantheos_player'));

if (loggedIn === 'true') {
    console.log('Welcome back, ' + playerData.nickname);
}
```

### Logout:
```javascript
localStorage.removeItem('pantheos_logged_in');
localStorage.removeItem('pantheos_player');
location.reload();
```

## Summary

✅ Website login system is ready
✅ Connects to same MySQL database as game
✅ Secure password hashing
✅ Smooth user experience
✅ Easy to test and use

Your players can now create accounts on the website and use them in the game!
