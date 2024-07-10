<?php
include 'database.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $status = $_POST['status'];
    $last_status_update = date('Y-m-d H:i:s');

    $stmt = $pdo->prepare('UPDATE products SET status = ?, last_status_update = ? WHERE id = ?');
    $stmt->execute([$status, $last_status_update, $product_id]);

    header('Location: index.php');
    exit();
}


$stmt = $pdo->query('SELECT * FROM products');
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Státusz Frissítése</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Elektronikai Szerviz</h1>
        <nav>
            <ul>
                <li><a href="index.php">Szerviz összesítő</a></li>
                <li><a href="add_product.php">Termék leadás</a></li>
                <li><a href="update_status.php">Státusz Frissítése</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Termék státuszának frissítése</h2>
        <form action="update_status.php" method="POST">
            <label for="product_id">Termék:</label>
            <select id="product_id" name="product_id" required>
                <?php foreach ($products as $product): ?>
                    <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['serial_number']) ?> - <?= htmlspecialchars($product['manufacturer']) ?> - <?= htmlspecialchars($product['type']) ?></option>
                <?php endforeach; ?>
            </select><br>
            <label for="status">Új státusz:</label>
            <select id="status" name="status" required>
                <option value="Beérkezett">Beérkezett</option>
                <option value="Hibafeltárás">Hibafeltárás</option>
                <option value="Alkatrészbeszerzésalatt">Alkatrészbeszerzésalatt</option>
                <option value="Javítás">Javítás</option>
                <option value="Kész">Kész</option>
            </select><br>
            <button type="submit">Frissítés</button>
        </form>
    </main>
    <footer>
        <p>Bölönyi Péter, Vizsga dátuma 2024.07.10</p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>
