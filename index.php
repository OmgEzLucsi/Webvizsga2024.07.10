<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Elektronikai Szerviz</title>
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
        <?php
        include 'database.php';

        $stmt = $pdo->query("SELECT * FROM products WHERE status != 'Kész' OR (status = 'Kész' AND DATE(last_status_update) = CURDATE()) ORDER BY FIELD(status, 'Beérkezett', 'Hibafeltárás', 'Alkatrészbeszerzésalatt', 'Javítás', 'Kész'), last_status_update");
        $products = $stmt->fetchAll();
        ?>

        <table class="table">
            <thead>
                <tr>
                    <th>Szériaszám</th>
                    <th>Gyártó</th>
                    <th>Típus</th>
                    <th>Leadás dátuma</th>
                    <th>Státusz</th>
                    <th>Utolsó státuszváltozás</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <?php $statusClass = str_replace(' ', '_', htmlspecialchars($product['status'])); ?>
                    <tr class="status-<?= $product['status'] ?>">
                        <td><?= htmlspecialchars($product['serial_number']) ?></td>
                        <td><?= htmlspecialchars($product['manufacturer']) ?></td>
                        <td><?= htmlspecialchars($product['type']) ?></td>
                        <td><?= htmlspecialchars($product['date_received']) ?></td>
                        <td><?= htmlspecialchars($product['status']) ?></td>
                        <td><?= htmlspecialchars($product['last_status_update']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>Bölönyi Péter, Vizsga dátuma 2024.07.10</p>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>
