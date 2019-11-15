<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lab 07: Basic SQL</title>
    <meta charset='utf-8' />
</head>

<body>
    <h1>Lab 07: Basic SQL</h1>
    <form action="sql.php" method="POST">
        Database:
        <input type="text" name="db"/>
        <br>
        SQL Query:
        <input type="text" name="query"/>
        <br>
        <input type="submit">
    </form>
    <h2>Query Result</h2>
    <ul>
    <?php
    if (isset($_POST['db']) and $_POST['db'] != "" and isset($_POST['query']) and $_POST['query'] != "") {
        try {
            $db = new PDO("mysql:dbname={$_POST['db']};port=3307", "root", "root");
            echo "DB connected!";
            $rows = $db->query($_POST['query']);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        
        foreach ($rows as $row) {
    ?>
    
    <li><?= print_r($row) ?></li>

    <?php
        }
    }
    ?>
    </ul>
</body>

</html>