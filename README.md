# PHP-Code-Practicer

This project is a personal PHP practice site created by Kamal Mittal. It helps beginners learn PHP through real examples with a modern, interactive, and responsive interface. It is hosted for free using InfinityFree.

---

## 🌟 Features

- 📜 Automatically lists all PHP question files (Q10, Q11, etc.)
- 🧠 Displays both code and output side by side
- 🌗 Dark Mode toggle (with saved preference)
- 🔒 HTTPS secure with free SSL
- 💻 Mobile-friendly responsive design
- 🌐 Favicon added to browser tab

---

## 📁 Project Structure

```
htdocs/
├── index.php               # Main UI file
├── Q10_ResourceTypes.php   # Example PHP question file
├── Q11_ArithmeticOperators.php
├── favicon.png             # Tab icon
```

---

## ✅ What We Did (Step-by-Step)

### 1. Created Multiple PHP Files
- Files named like `Q10_ResourceTypes.php`, each contains a small PHP concept or example.

### 2. Made an index.php
- Reads all `Q*.php` files automatically using:
  ```php
  $files = glob("Q*.php");
  ```
- Displays the file name as a clickable link.

### 3. On Clicking a File
- It shows:
  - Code using `file_get_contents()` inside `<pre>`
  - Output using `include()`

### 4. Added Split View Layout
- Side-by-side display of code and output using CSS Flexbox
- Works well on both PC and mobile

### 5. Added Dark Mode Toggle
- A switch lets users toggle light/dark theme
- Saved in `localStorage` so it remembers choice

### 6. Added Favicon
- File: `favicon.png`
- Line in HTML:
  ```html
  <link rel="icon" type="image/png" href="favicon.png">
  ```

### 7. Hosted on InfinityFree
- Uploaded all files to `htdocs/` folder using file manager
- Used free subdomain like `kamalmittal.free.nf`

### 8. Added SSL (HTTPS)
- From InfinityFree's Free SSL panel
- Verified domain using CNAME
- Pasted certificate in SSL settings

### 9. Redirected All Traffic to HTTPS
In `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} !=on
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## 🧠 What Beginners Will Learn

- How to use `include()` and `file_get_contents()`
- How to create an automatic file list
- HTML + CSS layout with Flexbox
- JavaScript localStorage for dark mode
- How to host free website with custom domain
- SSL setup without any cost

---

## 👨🏻‍💻 Author
**Kamal Mittal**  
[GitHub: kaml0402](https://github.com/kaml0402)

---

Feel free to fork this repo and make your own PHP learning project! 🚀

