<?php
    
    //get yesterday date and currencyInfo
    $date = date('Y.m.d', strtotime('yesterday'));
    $link = "http://www.nbrb.by/API/ExRates/Rates?onDate=".$date."&Periodicity=0";
    $jsonString = file_get_contents($link);
    $contentYesterday = json_decode($jsonString, true);

    //get today date and currencyInfo
    $link = "http://www.nbrb.by/API/ExRates/Rates?Periodicity=0";
    $jsonString = file_get_contents($link);
    $content = json_decode($jsonString, true);

    //print_r($content);
   // echo gettype($content);
