# Quick Fix - Website Not Found

## Problem
The website shows "Not Found" because the files are not in XAMPP's web directory.

## Solution

### Copy Website Files to XAMPP:

```cmd
xcopy "website" "C:\xampp\htdocs\pantheos" /E /I /Y
```

This copies all website files to `C:\xampp\htdocs\pantheos\`

### Then Access Website At:

```
http://localhost/pantheos/pantheos-optimized.html
```

## Update Game Title Screen:

In `title_scene/title_scene.gd`, change:

```gdscript
const WEBSITE_URL: String = "http://localhost/pantheos-optimized.html"
```

To:

```gdscript
const WEBSITE_URL: String = "http://localhost/pantheos/pantheos-optimized.html"
```

## Update API Path in Website:

In `pantheos-optimized.html`, change:

```javascript
const response = await fetch('api/account.php', {
```

To:

```javascript
const response = await fetch('/pantheos/api/account.php', {
```

## Quick Setup Steps:

1. **Copy files:**
   ```cmd
   xcopy "website" "C:\xampp\htdocs\pantheos" /E /I /Y
   ```

2. **Test website:**
   - Open: `http://localhost/pantheos/pantheos-optimized.html`
   - Should see the website!

3. **Test API:**
   - Open: `http://localhost/pantheos/api/account.php`
   - Should see CORS headers or blank page (not 404)

4. **Update game:**
   - Change WEBSITE_URL in title_scene.gd
   - Restart game

## Alternative: Use Root Directory

If you want `http://localhost/pantheos-optimized.html`:

```cmd
copy "website\*" "C:\xampp\htdocs\" /Y
xcopy "website\api" "C:\xampp\htdocs\api" /E /I /Y
```

Then no need to change paths!

## Verify Setup:

- [ ] XAMPP Apache running
- [ ] Files in C:\xampp\htdocs\
- [ ] Can access http://localhost/pantheos/pantheos-optimized.html
- [ ] API at http://localhost/pantheos/api/account.php
- [ ] Game WEBSITE_URL updated
- [ ] Website API path updated

## Current File Structure Should Be:

```
C:\xampp\htdocs\pantheos\
├── pantheos-optimized.html
├── api\
│   └── account.php
├── dengg.jpg
├── aj.jpg
├── vida.jpg
├── gek.jpg
└── (other images)
```

## Test It:

1. Open browser: `http://localhost/pantheos/pantheos-optimized.html`
2. Should see website
3. Click profile icon
4. Click "SIGN UP"
5. Should see signup form
6. Try creating account
7. Should work!

Done! ✅
