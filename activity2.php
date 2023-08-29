<?php
    if (isset($_POST['row'])) {
        $row = is_numeric($_POST['row']) && $_POST['row'] > 0 ? $_POST['row'] : 1;
    }
    else {
        $row = 1;
    }
    if (isset($_POST['col'])) {
        $col = is_numeric($_POST['col']) && $_POST['col'] > 0 ? $_POST['col'] : 1;
    }
    else {
        $col = 1;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>
    <style>
        body {
            font-family: Arial;
        }

        table {
            margin: 1rem 0;
            border-collapse: collapse;
        }

        th {
            padding: 0.7rem 1rem;
            background-color: #f0600c;
            color: #FFF;
        }

        tr {
            background-color: #ffcfb3;
        }

        tr:nth-child(even) {
            background-color: #faab7d;
        }

        td {
            padding: 0.2rem 0.5rem;
            text-align: center;
        }

        td:hover {
            background-color: #db5a0f;
            cursor: pointer;
        }

        #rowNcol input::-webkit-outer-spin-button,
        #rowNcol input::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        #rowNcol input[type=number] {
            padding: 0.3rem 0.4rem;
            border: 1px solid #FFA500;
        }

        #rowNcol input[type="submit"] {
            padding: 0.3rem 0.4rem;
            border: 1px solid #FFA500;
            background-color: #FFA500;
            color: #FFF;
        }

        #rowNcol input[type="submit"]:hover {
            background-color: #e39400;
        }
    </style>
</head>
<body>
    <form action="activity2.php" method="POST" id="rowNcol">
        <input type="number" placeholder="Enter number of rows" name="row" min="1"/>
        <input type="number" placeholder="Enter number of columns" name="col" min="1"/>
        <input type="submit" value="Submit"/>
    </form>
    <!-- Row table -->
    <table>
        <th colspan="<?= $row ?>">Columns</th>
        <tr>
        <?php
            for ($i = 1; $i <= $row; $i++) {  
        ?>
            <td>
                <?= $i; ?>
            </td>
        <?php
            }
        ?>
        </tr>
    </table>
    <!-- Column table -->
    <table>
        <th>Rows</th>
        <?php
            for($i = 1; $i <= $col; $i++) {  
        ?>
            <tr>
                <td>
                    <?= $i; ?>
                </td>
            </tr>
        <?php
            }
        ?>
    </table>
    <!-- Multiplication Table -->
    <table>
        <th colspan="<?= $col ?>">Multiplication Table</th>
        <?php
            for ($i = 1; $i <= $col; $i++) {
        ?>
        <tr>
            <?php
                for ($j = 1; $j <= $row; $j++) {
            ?>
            <td>
                <?= $j * $i; ?>
            </td>
            <?php
                }
            ?>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>