# Quick Test Guide - Website Login Fix

## 🚀 Quick Start

### Step 1: Start XAMPP
1. Open XAMPP Control Panel
2. Start **Apache**
3. Start **MySQL**

### Step 2: Test the API
Open in browser: `http://localhost/pantheos/test_api.html`

This will automatically:
- ✓ Test database connection
- ✓ Test hero account login
- ✓ Allow you to create new accounts
- ✓ Test login with any account

### Step 3: Test the Website
Open in browser: `http://localhost/pantheos/pantheos-optimized.html`

Try these actions:
1. **Login with hero account:**
   - Username: `hero`
   - Password: `hero123`
   
2. **Create a new account:**
   - Click profile icon → Sign Up
   - Fill in details
   - Create account

3. **Login with new account:**
   - Use the credentials you just created

### Step 4: Test in Game
1. Start Node.js server: `start_nodejs_server.bat`
2. Launch Godot game
3. Try logging in with:
   - Hero account (created via terminal)
   - New account (created via website)

## ✅ Expected Results

### Website → Game
- Account created on website should work in game
- Password hashing is compatible (bcrypt)

### Game → Website  
- Account created in game should work on website
- Both use same database and hashing

## 🔧 Troubleshooting

### "Invalid API key"
- Check `website/api/config.php` - API_KEY value
- Check HTML files - X-API-Key header
- Both must match: `your_secret_api_key_here`

### "Database connection failed"
- XAMPP MySQL must be running
- Database `mmorpg_game` must exist
- Run: `complete_database_setup.sql` if needed

### "Invalid username or password"
- Verify account exists in database
- Check password is correct
- Use test_api.html to debug

### CORS errors
- Already fixed in config.php
- If still occurring, check Apache configuration

## 📝 Test Checklist

- [ ] XAMPP running (Apache + MySQL)
- [ ] test_api.html loads successfully
- [ ] Connection test passes
- [ ] Hero account login works
- [ ] Can create new account
- [ ] New account can login
- [ ] Website login works
- [ ] Game login works with website account
- [ ] Website login works with game account

## 🎯 Files to Check

1. **website/api/config.php** - Database credentials
2. **website/api/account.php** - Login/signup logic
3. **website/pantheos-optimized.html** - Main website
4. **website/test_api.html** - Testing tool
5. **server/config/database.js** - Node.js database config

## 💡 Pro Tips

1. Use `test_api.html` first to verify everything works
2. Check browser console (F12) for JavaScript errors
3. Check XAMPP Apache error logs if API fails
4. Use `test_password.php` to verify password hashing
5. Both systems use bcrypt - passwords are compatible!

## 🐛 Still Having Issues?

1. Open browser console (F12)
2. Try test_api.html
3. Check what error appears
4. Verify XAMPP is running
5. Verify database exists
6. Check API key matches

The password hashing is now compatible between PHP and Node.js!
