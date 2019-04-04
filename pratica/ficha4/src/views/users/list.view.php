<div><a class="btn btn-primary" href="user-add.php">Add user</a></div>
<?php if (count($users)) {
    ?>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Fullname</th>
            <th>Registered At</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) {
        ?>
        <tr>
            <td><?= escape($user->email) ?></td>
            <td><?= escape($user->fullname) ?></td>
            <td><?= escape($user->registered_at) ?></td>
            <td><?= $user->typeToStr() ?></td>
            <td>
                <a class="btn btn-xs btn-primary" href="user-edit.php?user_id=<?= intval($user->user_id) ?>">Edit</a>
                <form action="user-delete.php" method="POST" role="form" class="inline">
                    <input type="hidden" name="user_id" value="<?= intval($user->user_id) ?>">
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    <?php

    } ?>
    </table>
<?php

} else {
    ?>
    <h2>No users found</h2>
<?php

} ?>
