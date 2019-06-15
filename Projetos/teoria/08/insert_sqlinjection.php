<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DBO-MySQL - Insert</title>
</head>
<body>
    <h1>DBO-MySQL - Insert</h1>
    <a href='../index.html#08mysqlpdo'>Back to the start</a>
    <hr>
    <p>No validation is implemented</p>
    <p>Command is contructed with string concatenation instead of parameters. This is prone to SQL Injection.</p>
    <p>Try to fill "name" field with the following examples, and analyse the database structure with a MySQL client (Adminer; PHPMyAdmin; MySQLWorkbench):</p>
    <p>a',1); create table mytable(id integer); --</p>
    <p>a',1); drop table mytable; --</p>
    <form action="insert_sqlinjection_process.php" method="post">
        <div>
            <label for="name_id">Name:</label>
            <input type="text" id="name_id" name="name">
        </div>
        <div>
            <label for="age_id">Age:</label>
            <input type="text" id="age_id" name="age">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>
    <hr>
    <p>No validation is implemented</p>
    <p>If you try previous commands on this form, no SQL injection ocours. Why?</p>
    <form action="insert_process.php" method="post">
        <div>
            <label for="name_id">Name:</label>
            <input type="text" id="name_id" name="name">
        </div>
        <div>
            <label for="age_id">Age:</label>
            <input type="text" id="age_id" name="age">
        </div>
        <div>
            <input type="submit">
        </div>
    </form>    
</body>
</html>