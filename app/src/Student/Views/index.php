<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Students List</h1>  
    <ul>  
        <?php
    foreach($students as $student):
        ?>
        <li><h1>ID:</h1> <?= $student['id'] ?></li>
        <li><h1>Name:</h1> <?= $student['name'] ?></li>
        <li><h1>Email:</h1> <?= $student['email'] ?></li>
        <?php
    endforeach;
    
    ?>
    </ul>

</body>

</html>