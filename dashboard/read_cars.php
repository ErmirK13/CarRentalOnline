<?php
session_start();
include "../includes/database.php";

$result = mysqli_query($conn, "SELECT * FROM cars");
?>

<h1>Cars</h1>

<a href="create_car.php">Add new car</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Type</th>
    <th>Transmission</th>
    <th>Image</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['price'] ?></td>
    <td><?= $row['type'] ?></td>
    <td><?= $row['transmission'] ?></td>
    <td>
        <img src="../images/cars/<?= $row['image_path'] ?>" width="80">
    </td>
    <td>
        <a href="edit_car.php?id=<?= $row['id'] ?>">Edit</a>
        <a href="delete_car.php?id=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>
