<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kamal's PHP Practice</title>
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
        body.dark-mode {
            background-color: #121212;
            color: #eee;
        }
        body.dark-mode a { color: #66b2ff; }
        body.dark-mode table, body.dark-mode .panel { background: #1e1e1e; }
        body.dark-mode pre { background: #2e2e2e; }

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

        /* Search Bar */
        #searchInput {
            padding: 10px;
            width: 50%;
            margin: 20px auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 5px;
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
</div>

<h1>Welcome to Kamal's PHP Practice</h1>
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
    // Dark Mode Toggle
    const toggle = document.getElementById('modeToggle');
    const body = document.body;

    if (localStorage.getItem("theme") === "dark") {
        toggle.checked = true;
        body.classList.add("dark-mode");
    }

    toggle.addEventListener('change', () => {
        if (toggle.checked) {
            body.classList.add("dark-mode");
            localStorage.setItem("theme", "dark");
        } else {
            body.classList.remove("dark-mode");
            localStorage.setItem("theme", "light");
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
