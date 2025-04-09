<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kamal's PHP Practice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 40px;
            text-align: center;
            transition: background 0.4s, color 0.4s;
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

        /* ... (rest of your CSS) ... */
    </style>
</head>
<body>

<h1>Welcome to Kamal's PHP Practice</h1>

<?php
if (isset($_GET['file']) && file_exists($_GET['file'])) {
    $filename = $_GET['file'];
    $fileContent = file_get_contents($filename);

    // ✅ Check for SQL/MySQL/Mysqli/PDO keywords
    $db_keywords = ['mysqli_', 'mysql_', 'PDO', 'pg_connect', 'oci_connect'];
    foreach ($db_keywords as $keyword) {
        if (stripos($fileContent, $keyword) !== false) {
            echo "<div class='alert'>
                    This program will throw a fatal error on this website. 
                    Try this code on your local server using <strong>XAMPP</strong> or <strong>WAMP</strong>
                </div>";
            break;
        }
    }

    echo "<div class='split-view' id='output-section'>";
    echo "<div class='panel'><h2>Code: $filename</h2><pre>" . htmlspecialchars($fileContent) . "</pre></div>";
    echo "<div class='panel'><h2>Output:</h2>";

    ob_start();
    try {
        include($filename);
    } catch (Throwable $e) {
        echo "<p style='color:red;'>Error: " . $e->getMessage() . "</p>";
    }
    ob_end_flush();
    echo "</div></div>";
}
?>

</body>
</html>
