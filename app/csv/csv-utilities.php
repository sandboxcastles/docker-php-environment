<?php
    function csvParser($fileLocation, $separator = ",", $maxLineLength = 1000) {
        if (($openFile = fopen($fileLocation, "r")) !== FALSE)
        {
            while (($data = fgetcsv($openFile, $maxLineLength, $separator)) !== FALSE)
            {
                $array[] = $data;
            }

            fclose($openFile);
        }
        return $array;
    }
?>