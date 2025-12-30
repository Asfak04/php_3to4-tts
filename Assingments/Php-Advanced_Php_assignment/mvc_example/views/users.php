<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>

<h2>Users List</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

    <?php while ($row = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
    </tr>
    <?php endwhile; ?>

</table>

</body>
</html>
