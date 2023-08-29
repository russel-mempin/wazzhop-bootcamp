<?php
    session_start();
    if (!isset($_SESSION['colors'])) {
        $_SESSION['colors'] = [];
    }
    
    $array = $_SESSION['colors'];

    function arrayFilter($color) {
        return $color['id'] != $_POST['id'];
    }

    if(isset($_POST['btn_delete']) && isset($_POST['id'])){
        $_SESSION['colors'] = array_filter($_SESSION['colors'], "arrayFilter");
        header("location: ./activity3display.php"); // REDIRECTED BACK TO HOME PAGE IN GET METHOD
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
</head>
<body>
    <a href="activity3.php">Go back</a>
    <?php
        foreach($array as $color) {
    ?>
        <div style="background-color: <?= $color['value'] ?>; color: white; padding: 0.5rem; display: flex; align-items: center; margin-top: 1rem;">
            <form style="display: inline;" action="./activity3display.php" method="POST">
                <input type="hidden" name="id" value="<?= $color["id"] ?>">
                <input type="submit" name="btn_delete" value="Delete" style="margin-right: 0.5rem;">
                <?= $color['value'] ?>
            </form>
        </div>
    <?php
        }
    ?>
</body>
</html>