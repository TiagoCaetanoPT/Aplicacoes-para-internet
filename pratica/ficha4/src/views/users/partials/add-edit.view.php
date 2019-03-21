<div class="form-group">
    <label for="inputFullname">Fullname</label>
    <input
        type="text" class="form-control"
        name="fullname" id="inputFullname"
        placeholder="Fullname" value="<?=$user->fullname ?>" />
</div>
<div class="form-group">
    <label for="inputType">Type</label>
    <select name="user_type" id="inputType" class="form-control">
        <option disabled  <?= $user->type ==''? "selected" : "" ?>> -- select an option -- </option>
        <option value="0" <?= $user->type =='0'? "selected" : "" ?>>Administrator</option>
        <option value="1" <?= $user->type =='1'? "selected" : "" ?>>Publisher</option>
        <option value="2" <?= $user->type =='2'? "selected" : "" ?>>Client</option>
    </select>
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="email" class="form-control"
        name="email" id="inputEmail"
        placeholder="Email address" value="<?=$user->email ?>"/>
</div>


