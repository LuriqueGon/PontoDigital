<?php
    if(file_exists("../vendor/MF/log/data.csv")){
        $file = fopen("../vendor/MF/log/data.csv", "r");

        $headers = str_replace(' ', '', str_replace('|', '',explode(' | ',fgets($file))));
        $data = array();

        while($row = fgets($file)){
            $rowData = str_replace(' ', '', str_replace('|', '',explode(' | ',$row)));
            $rowName = array();
            for($i = 0; $i<count($headers); $i++){
                $rowName[$headers[$i]] = $rowData[$i];
            }
            // $rowName['base64'] ="data:image/".$rowName['Extension']. ";base64,". base64_encode(file_get_contents("./img/".$rowName['Basename']));
            array_push($data, $rowName);
            
        }

        fclose($file);

    }
    echo '<br>';
    echo '<pre>';
    var_dump($data);
    echo '</pre>';