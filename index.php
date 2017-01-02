<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

function differenceBetweenTwoArrays($prevArray, $currArray) {
    $previousArray = json_decode($prevArray);
    $currentArray = json_decode($currArray);

    $metaData = array();
    foreach ($currentArray as $key => $val) {
        foreach ($val->meta as $key2 => $val2) {
            $metaData[] = $key2;
        }
    }
    $metaData = array_unique($metaData);

    //Creating Table HTML to Return
    $tableToReturn = '<h2 style="text-align:center">Test Job By Ejaz</h2>';
    $tableToReturn .= '<table  border="2" style="margin: 5% 36%;"><thead><tr>';
    $tableToReturn.='<th>_id</th>';
    $tableToReturn.='<th>someKey</th>';

    foreach ($metaData as $key3 => $va3) {
        $tableToReturn.='<th>meta_' . $va3 . '</th>';
    }
    $tableToReturn.='</tr></thead><tbody>';
    foreach ($currentArray as $key4 => $val4) {
        $makeBold = '';
        if ($key4 == 1) {
            $makeBold = 'font-weight:bold;';
        }
        $tableToReturn.='<tr style=' . $makeBold . '>';
        $tableToReturn.='<td>' . $val4->_id . '</td>';
        $tableToReturn.='<td>' . $val4->someKey . '</td>';
        foreach ($metaData as $keyname) {
            $tableToReturn.='<td>';
            if ($val4->meta->$keyname)
                $tableToReturn.=$val4->meta->$keyname;
            else {
                if ($previousArray[$key4]->meta->$keyname)
                    $tableToReturn.='<b>DELETED</b>';
            }
            $tableToReturn.='</td>';
        }
        $tableToReturn.='</tr>';
    }
    $tableToReturn.='</tbody></table>';
    return $tableToReturn;
}

//Define Arrays
$prevArray = '[{"_id":1,"someKey":"RINGING","meta":{"subKey1":1234,"subKey2":52}}]';
$currArray = '[{"_id":1,"someKey":"HANGUP","meta":{"subKey1":1234}},{"_id":2,"someKey":"RINGING","meta":{"subKey1":5678,"subKey2":207,"subKey3":52}}]';

//Running the Function
echo differenceBetweenTwoArrays($prevArray, $currArray);
?>
