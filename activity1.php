<?php
    $firstName = "1pc Macaroni";
    $lastName = "Soup";
    $gender = "With/Rice";
    $favoriteNumber = 1;
    $weight = 1;
    $num1 = 10;
    $num2 = 5;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>I am <?= $firstName . " " . $lastName?></h1>
    <h2>My favorite number is <?= $favoriteNumber ?></h2>
    <h3>I am <?= $weight?> kg.</h3>
    <?php
        echo "10 + 5 = " . $num1 + $num2 . "<br/>";
        echo "10 - 5 = " . $num1 - $num2 . "<br/>";
    ?>
    <?= "10 * 5 = " . $num1 * $num2 . "<br/> "; ?>
    <?= "10 / 5 = " . $num1 / $num2 . "<br/>"; ?>
</body>
</html>