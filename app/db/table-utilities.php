<?php
    function dropTable($conn, $tableName) {
        $conn->exec("DROP TABLE $tableName");
        return "Dropped $tableName Table.\n";
    }

    function createTable($conn, $tableName, $columns) {
        $sql ="CREATE table $tableName(
            $columns
        );" ;

        $conn->exec($sql);
        return "Created $tableName Table.\n";
    }

    function clearAllRows($conn, $tableName) {
        $query = $conn->prepare("DELETE from $tableName");
        $query->execute();
    
        echo "<script>alert('Successfully deleted all from " . $tableName . "!')</script>";
    }

    function selectFromTable($conn, $tableName, $columns = "*") {
        return $conn->query("SELECT $columns from $tableName");
    }
?>
