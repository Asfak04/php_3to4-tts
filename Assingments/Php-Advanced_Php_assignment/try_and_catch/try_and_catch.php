<?php
$host = "localhost";
$db   = "mvc_demo";
$user = "root";
$pass = "";

try {
    /* ===== Database Connection ===== */
    $conn = new PDO(
        "mysql:host=$host;dbname=$db",
        $user,
        $pass
    );

    // Enable exception mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully<br>";

    /* ===== SQL Query Execution ===== */
    $sql = "SELECT * FROM users";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch data
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo $user['name'] . "<br>";
    }

} catch (PDOException $e) {
    // Handle both connection & query errors
    echo "Database Error: " . $e->getMessage();
}
?>
