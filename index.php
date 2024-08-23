<?php
// Include configuration file
include 'config.php';

// Create operation
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email]);

    echo "Record created successfully!";
}

// Read operation
$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

// Update operation
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name=?, email=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $email, $id]);

    echo "Record updated successfully!";
}

// Delete operation
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM users WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    echo "Record deleted successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP CRUD</title>
</head>
<body>
    <h2>Create User</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="create">Create</button>
    </form>

    <h2>Users List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td>
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="text" name="name" value="<?= $user['name'] ?>" required>
                    <input type="email" name="email" value="<?= $user['email'] ?>" required>
                    <button type="submit" name="update">Update</button>
                </form>
                <form method="post" style="display:inline-block;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" name="delete" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
