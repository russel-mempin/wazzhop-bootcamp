<?php
    session_start();

    if (!isset($_SESSION['colors'])) {
        $_SESSION['colors'] = [];
    }

    if (isset($_POST['color']) && !empty($_POST['color'])) {
        if (isset($_POST['array_push'])) {
            array_push($_SESSION['colors'], ["value" => $_POST['color'], "id" => time() . $_POST['color']]);
        }
        else if (isset($_POST['array_unshift'])) {
            array_unshift($_SESSION['colors'], ["value" => $_POST['color'], "id" => time() . $_POST['color']]);
        }
        header("location: ./activity3.php");
    }

    if (isset($_POST['array_shift'])) {
        array_shift($_SESSION['colors']);
        header("location: ./activity3.php");
    }

    if (isset($_POST['array_pop'])) {
        array_pop($_SESSION['colors']);
        header("location: ./activity3.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Using Array</title>
</head>
<body>
    <a href="activity3display.php">See all input</a>
    <form action="activity3.php" method="POST">
        <input type="text" name="color" required>
        <input type="submit" name="array_push" value="Push">
        <input type="submit" name="array_unshift" value="Unshift">
    </form>

    <form action="activity3.php" method="POST">
        <input type="submit" value="Array Shift">
        <input type="submit" value="Array Pop">
    </form>
</body>
</html>