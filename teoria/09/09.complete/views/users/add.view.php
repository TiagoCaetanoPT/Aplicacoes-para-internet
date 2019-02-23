<div>
    <a href="<?= action('user', 'index')?>">Return to the list of users</a>
</div>
<hr>
<form action="<?= action('user', 'add')?>" method="post">
    <div>
        <label for="inputName">Name</label>
        <input type="text" name="name" id="inputName" placeholder="Name" value="<?= escape(old('name', $user->name)) ?>">
        <?= htmlErrorMessage('name', $errors) ?>
    </div>
    <div>
        <label for="inputAge">Age</label>
        <input type="text" name="age" id="inputAge" placeholder="Age" value="<?= escape(old('age', $user->age)) ?>">
        <?= htmlErrorMessage('age', $errors) ?>
    </div>
    <div>
        <button type="submit" name="ok">Save</button>
        <button type="submit" name="cancel">Cancel</button>
    </div>
</form>
