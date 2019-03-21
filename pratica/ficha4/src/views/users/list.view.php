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
            <td><?=$user->email?></td>
            <td><?=$user->fullname?></td>
            <td><?=$user->registered_at?></td>
            <td><?=$user->type?></td>
            <td>
                <a class="btn btn-info" href="user-edit.php" style="background-color: blue">Edit</a>
                <a class="btn btn-info" href="user-delete.php" style="background-color: red">Delete</a>
            <!-- fill with edit and delete actions -->
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
