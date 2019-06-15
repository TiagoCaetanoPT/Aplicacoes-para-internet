<div>
    <a href="users-add.php">Add User</a>
</div>
<hr>
<table>
<thead>
    <tr>
        <th>Name</th>
        <th>Age</th>
        <th></th>
        <th></th>
    </tr>
</thead>
<tbody>                
<?php foreach ($users as $user) : ?>
    <tr>
        <td><?= htmlspecialchars($user->name) ?></td>
        <td><?= htmlspecialchars($user->age) ?></td>
        <td><a href="users-edit.php?id=<?= htmlspecialchars($user->id) ?>">Edit</a></td>
        <td>
            <form action="users-delete.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">
                <input type="submit" value="Delete">
            </form>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
