<div>
    <a href="index.php?user/add">Add User</a>
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
        <td><a href="index.php?user/edit&id=<?= htmlspecialchars($user->id) ?>">Edit</a></td>
        <td>
            <form action="index.php?user/delete" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">
                <input type="submit" value="Delete">
            </form>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
