# Password Hashing Fix for Website Login

## Problem
The website login system needs to use the same password hashing as the Node.js server so accounts created on either platform work on both.

## Solution
Both systems now use **bcrypt** for password hashing, which is compatible between PHP and Node.js.

## Testing the Fix

### 1. Test existing account (hero)
```bash
# Navigate to: http://localhost/pantheos/test_password.php
# This will verify the 'hero' account password hash
```

### 2. Create a new account via website
1. Open: `http://localhost/pantheos/pantheos-optimized.html`
2. Click the profile icon
3. Click "SIGN UP"
4. Create account with:
   - Username: testuser
   - Nickname: TestPlayer
   - Password: test123

### 3. Verify account works in game
1. Start the Node.js server: `start_nodejs_server.bat`
2. Launch the Godot game
3. Try logging in with the account created on the website

### 4. Verify cross-compatibility
- Create account via website → Login via game ✓
- Create account via game → Login via website ✓

## Technical Details

### PHP (website/api/account.php)
```php
// Creating account
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Verifying password
password_verify($password, $stored_hash)
```

### Node.js (server/routes/auth.js)
```javascript
// Creating account
const passwordHash = await bcrypt.hash(password, 10);

// Verifying password
await bcrypt.compare(password, stored_hash)
```

Both use bcrypt with compatible settings:
- PHP: `PASSWORD_BCRYPT` (default cost: 10)
- Node.js: `bcrypt.hash(password, 10)` (cost: 10)

## Common Issues

### Issue 1: API Key Error
**Error:** "Invalid API key"
**Fix:** Make sure the API key in the HTML matches `config.php`:
```javascript
'X-API-Key': 'your_secret_api_key_here'
```

### Issue 2: Database Connection
**Error:** "Database connection failed"
**Fix:** 
1. Start XAMPP (Apache + MySQL)
2. Verify database exists: `mmorpg_game`
3. Check credentials in `website/api/config.php`

### Issue 3: CORS Error
**Error:** "CORS policy blocked"
**Fix:** Already handled in `config.php` with:
```php
header('Access-Control-Allow-Origin: *');
```

## Verification Checklist

- [ ] XAMPP Apache is running
- [ ] XAMPP MySQL is running
- [ ] Database `mmorpg_game` exists
- [ ] Website accessible at `http://localhost/pantheos/`
- [ ] API key matches in HTML and config.php
- [ ] Test password script works
- [ ] Can create account via website
- [ ] Can login via website
- [ ] Account created on website works in game
- [ ] Account created in game works on website

## Files Modified
- `website/pantheos-optimized.html` - Fixed API paths
- `website/api/account.php` - Already using bcrypt correctly
- `server/routes/auth.js` - Already using bcrypt correctly
- `website/test_password.php` - New test script

## Next Steps
1. Run the test script to verify password hashing
2. Try creating an account via the website
3. Verify you can login with that account in the game
4. Report any errors for further debugging
