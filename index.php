<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LKK3VTPXKX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LKK3VTPXKX');
</script>
    <meta charset="UTF-8">
    <title>Kamal's PHP Code Practicer</title>
    <link rel="icon" type="image/png" href="favicon.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 40px;
            text-align: center;
            transition: background 0.4s, color 0.4s;
        }
        h1 { color: #333; }
        table {
            margin: 0 auto 30px auto;
            border-collapse: collapse;
            width: 80%;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 20px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            transition: 0.3s;
        }
        a:hover { color: #0056b3; }
        .split-view {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
            flex-wrap: wrap;
        }
        .panel {
            background: white;
            border-radius: 8px;
            padding: 20px;
            width: 45%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: left;
        }
        pre {
            background: #eee;
            padding: 10px;
            overflow-x: auto;
        }
        footer {
            margin-top: 40px;
            color: gray;
            font-size: 14px;
        }
        .alert {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 15px;
            width: 80%;
            margin: 20px auto;
            border-radius: 5px;
        }

        /* Dark Mode */
        /* Dark Mode */
body.dark-mode {
    background-color: #121212;  /* Dark background for whole page */
    color: #ddd;                /* Light text color */
}

body.dark-mode h1 {
    color: #d0bcff; /* Softer purple */
    background-color: transparent; /* Remove white bg */
    text-shadow: none;
    padding: 10px 0;
    border-radius: 5px;
}

body.dark-mode a {
    color: #80aaff;
}

body.dark-mode table,
body.dark-mode .panel {
    background: #1e1e1e;
    color: #ccc;
}

body.dark-mode pre {
    background: #2e2e2e;
    color: #eee;
}


        /* Toggle Switch */
        .toggle-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0;
            right: 0; bottom: 0;
            background-color: #ccc;
            transition: 0.4s;
            border-radius: 24px;
        }
        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.4s;
            border-radius: 50%;
        }
        input:checked + .slider {
            background-color: #2196F3;
        }
        input:checked + .slider:before {
            transform: translateX(26px);
        }

        #modeLabel {
    font-size: 20px;
    margin-left: 10px;
    transition: 0.3s;
}


        /* Search Bar */
        /* Light Mode - Default */
#searchInput {
    background-color: #fff;
    border: 1px solid #ccc;
    color: #333;
    padding: 10px 1rem;
    border-radius: 12px;
    font-size: 16px;
    width: 50%;
    margin: 20px auto;
    display: block;
    transition: 0.3s ease-in-out;
    box-shadow: none;
}

#searchInput:focus {
    outline: none;
    border-color: #915eff;
    box-shadow: 0 0 5px #915eff;
    background-color: #f9f9f9;
}

/* Dark Mode overrides */
body.dark-mode #searchInput {
    background-color: #0f0f0f;
    border: none;
    outline: 2px solid #915eff;
    outline-offset: 3px;
    color: white;
    box-shadow: 0 0 10px #915eff, 0 0 20px #ff00cc;
}

body.dark-mode #searchInput:focus {
    background-color: #1a1a1a;
    outline-offset: 5px;
}


        #backToTop {
    position: fixed;
    bottom: 30px;
    right: 30px;
    display: none;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    z-index: 999;
    transition: background 0.3s;
}
#backToTop:hover {
    background: #0056b3;
}

    </style>
</head>
<body>

<div class="toggle-switch">
    <label class="switch">
        <input type="checkbox" id="modeToggle">
        <span class="slider"></span>
    </label>
    <span id="modeLabel">🌞</span> <!-- Default emoji for Light Mode -->
</div>

<h1>Welcome to Kamal's PHP Code Practicer</h1>
<p>Select a topic to view:</p>

<input type="text" id="searchInput" placeholder="Search by topic...">

<table>
    <tr>
        <th>#</th>
        <th>Topic</th>
    </tr>
    <?php
    $files = glob("Q*.php");
    natcasesort($files);
    $i = 1;
    foreach ($files as $file) {
        $display = str_replace(["Q", "_", ".php"], ["Q", " ", ""], $file);
        $encoded = urlencode($file); // Encode filename for URL
        echo "<tr><td>$i</td><td><a href='?file=$encoded'>$display</a></td></tr>";
        $i++;
    }
    ?>
</table>

<?php
if (isset($_GET['file'])) {
    $filename = basename(urldecode($_GET['file'])); // Decode URL parameter
    $filepath = __DIR__ . '/' . $filename;

    if (file_exists($filepath)) {
        $fileContent = file_get_contents($filepath);

        // Show warning for DB-related code
        if (preg_match('/\b(mysqli|mysql|PDO|pg_connect|oci_connect|connect|database)\b/i', $fileContent)) {
            echo "<div class='alert'>
                    ⚠ This program may throw a fatal error on this website.<br>
                    Try it locally using <strong>XAMPP</strong> or <strong>WAMP</strong>.
                  </div>";
        }

        echo "<div class='split-view' id='output-section'>";
        echo "<div class='panel'><h2>Code: $filename</h2><pre>" . htmlspecialchars($fileContent) . "</pre></div>";
        echo "<div class='panel'><h2>Output:</h2>";

        ob_start();
        try {
            include $filepath;
        } catch (Throwable $e) {
            echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
        }
        ob_end_flush();
        echo "</div></div>";
    } else {
        echo "<div class='alert'>🚫 File not found: <strong>$filename</strong></div>";
    }
}
?>

<footer>
    Made with ❤️ by Kamal Mittal | <a href="https://github.com/kaml0402" target="_blank">My GitHub</a>
</footer>

<?php if (isset($_GET['file'])): ?>
<script>
    document.getElementById("output-section").scrollIntoView({ behavior: "smooth" });
</script>
<?php endif; ?>

<script>
    // Dark Mode Toggle with Emoji
const toggle = document.getElementById('modeToggle');
const body = document.body;
const modeLabel = document.getElementById('modeLabel'); // Emoji span

if (localStorage.getItem("theme") === "dark") {
    toggle.checked = true;
    body.classList.add("dark-mode");
    modeLabel.textContent = "🌙";
} else {
    modeLabel.textContent = "🌞";
}

toggle.addEventListener('change', () => {
    if (toggle.checked) {
        body.classList.add("dark-mode");
        localStorage.setItem("theme", "dark");
        modeLabel.textContent = "🌙";
    } else {
        body.classList.remove("dark-mode");
        localStorage.setItem("theme", "light");
        modeLabel.textContent = "🌞";
    }
});

    // Search Filter
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("keyup", function () {
        const filter = searchInput.value.toLowerCase();
        const rows = document.querySelectorAll("table tr");
        rows.forEach((row, index) => {
            if (index === 0) return;
            const text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
</script>
<button id="backToTop">🔝 Top</button>

<script>
    const backToTop = document.getElementById("backToTop");

    window.addEventListener("scroll", () => {
        backToTop.style.display = window.scrollY > 300 ? "block" : "none";
    });

    backToTop.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
</script>

</body>
</html>
