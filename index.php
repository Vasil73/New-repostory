<?php

 $searchRoot = 'test_search';
 $searchName = 'test.txt';
 $searchResult = [];

 function listFile(string $directory, string $fileName, array &$searchResult)
 {
     $scanDirect = array_diff(scandir($directory), array('..', '.'));

     foreach ($scanDirect as $value) {
         if (is_dir($directory . '/' . $value)) {
            listFile($directory . '/' . $value, $fileName, $searchResult);
         }elseif ($value === $fileName) {
            $searchResult[] = $directory . '/' . $value;
         }
     }
 }

 listFile($searchRoot, $searchName, $searchResult);

 $searchResult = array_filter($searchResult, fn ($file) => filesize($file) > 0);

 if (empty($searchResult)) {
    echo 'Поиск не дал результатов';
 }else {
    print_r($searchResult);
 }

