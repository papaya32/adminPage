<?php
$data = file_get_contents("/home/papaya/.userdata/papaya96");
$test = json_decode($data);
//$test2 = json_decode($test);
//var_dump($test);

        $result = array(
            'data_from_file' => $test,
            'timestamp' => $last_change_in_data_file
        );

var_dump($result);

        // encode to JSON, render the result (for AJAX)
//        $json = json_encode($result);
//        echo $json;



?>
