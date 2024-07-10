<?php
include 'database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serial_number = $_POST['serial_number'];
    $manufacturer = $_POST['manufacturer'];
    $type = $_POST['type'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $date_received = date('Y-m-d');
    $status = 'Beérkezett';
    $last_status_update = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('INSERT INTO products (serial_number, manufacturer, type, date_received, status, last_status_update) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$serial_number, $manufacturer, $type, $date_received, $status, $last_status_update]);
    $product_id = $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO contacts (product_id, name, phone, email) VALUES (?, ?, ?, ?)');
    $stmt->execute([$product_id, $name, $phone, $email]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Termék leadás</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Elektronikai Szerviz</h1>
        <nav>
            <ul>
                <li><a href="index.php">Szerviz összesítő</a></li>
                <li><a href="add_product.php">Termék leadás</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Új termék leadása</h2>
        <form action="add_product.php" method="POST">
            <label for="serial_number">Szériaszám:</label>
            <input type="text" id="serial_number" name="serial_number" required><br>
            <label for="manufacturer">Gyártó:</label>
            <input type="text" id="manufacturer" name="manufacturer" required><br>
            <label for="type">Típus:</label>
            <input type="text" id="type" name="type" required><br>
            <label for="name">Kapcsolattartó neve:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="phone">Kapcsolattartó telefonja:</label>
            <input type="tel" id="phone" name="phone" required><br>
            <label for="email">Kapcsolattartó emailje:</label>
            <input type="email" id="email" name="email" required><br>
            <button type="submit">Leadás</button>
        </form>
    </main>
    <footer>
        <p>Bölönyi Péter, Vizsga dátuma 2024.07.10</p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>
