<?php session_start(); ?>

<h2>Social Login Demo</h2>

<?php if (isset($_SESSION['user'])): ?>

    <h3>Welcome <?= $_SESSION['user']['name']; ?></h3>
    <p>Email: <?= $_SESSION['user']['email']; ?></p>
    <a href="logout.php">Logout</a>

<?php else: ?>

    <a href="google-login.php">Login with Google</a>

<?php endif; ?>
