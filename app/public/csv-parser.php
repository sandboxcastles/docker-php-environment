<?php
    require_once "../csv/csv-utilities.php";
    require_once "index.php";

    $csvColumns = array(
        array(
            'label' => "Name",
            'cellValue' => function ($row) {
                return $row["FirstName"] . " " . $row["LastName"];
            }
        ),
        array(
            'label' => "Age",
            'cellValue' => function ($row) {
                return $row["Age"];
            }
        ),
        array(
            'label' => "Crime",
            'cellValue' => function ($row) {
                return $row["Crime"];
            }
        ),
        array(
            'label' => "DOB",
            'cellValue' => function ($row) {
                return $row["DateOfBirth"];
            }
        ),
    );
    $csvRows = csvParser("files/test.csv");
    clearAllRows($pdo, $table);

    $getRowValuesFunc = function($r) {
        $fName = $r[0];
        $lName = $r[1];
        $age = $r[2];
        $dob = $r[3];
        $crime = $r[4];
        return array($fName, $lName, $age, $dob, $crime);
    };

    addDbRow(
        $pdo,
        $table,
        $csvRows,
        "(FirstName, MiddleName, LastName, Age, DateOfBirth, Crime)",
        "(?,NULL,?,?,?,?)",
        $getRowValuesFunc
    );

    $dbRows = selectFromTable($pdo, $table);
?>
<table>
    <tr>
<?php
    for ($columnIndex = 0; $columnIndex < count($csvColumns); $columnIndex++) {
?>
        <th><?php echo $csvColumns[$columnIndex]["label"] ?></th>
<?php
    }
?>
    </tr>
<?php

    foreach($dbRows as $dbRow)
    {
?>
    <tr>
<?php
        for ($ci = 0; $ci < count($csvColumns); $ci++) {
?>
        <td><?php echo $csvColumns[$ci]["cellValue"]($dbRow) ?></td>
<?php
        }
    }
?>
</table>