<?php
require_once "../db/conn.php";
require_once "../db/table-utilities.php";

function addDbRow($conn, $tableName, $rows, $columns, $valueDefinition, $getRowValues) {
    $sql = "INSERT INTO $tableName
        $columns
        VALUES $valueDefinition
    ";

    try {
        $stmt = $conn->prepare($sql);
        foreach($rows as $row) {
            $rowValues = $getRowValues($row);
            $stmt->execute($rowValues);
        }
        print("That's a spicy meatball!!!");
    } catch (PDOException $e) {
        $existingkey = "Integrity constraint violation: 1062 Duplicate entry";
        if (strpos($e->getMessage(), $existingkey) !== FALSE) {
    
            // Take some action if there is a key constraint violation, i.e. duplicate name
        } else {
            throw $e;
        }
    }
}

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();


$table = "inmates";

// print(
//     createTable($pdo, $table, "
//     ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
//     FirstName VARCHAR( 500 ) NOT NULL,
//     MiddleName VARCHAR( 500 ),
//     LastName VARCHAR( 500 ) NOT NULL,
//     Age VARCHAR( 3 ) NOT NULL,
//     DateOfBirth VARCHAR( 100 ) NOT NULL,
//     Crime VARCHAR( 1000 ) NOT NULL
//     "
// ));

?>
<h1><?php echo 'MySQL version:' . $row['Value']; ?></h1>

<a href="/csv-parser.php">CSV Parser</a>

