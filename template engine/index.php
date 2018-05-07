<?php
  require_once("cfg.php");

  const KEY_CUR_EUR = 292;
  const KEY_CUR_USD = 145;
  const KEY_CUR_RUB = 298;

  $page_template = "templates/main.tpl";

  $page_data = file_get_contents($page_template);

  foreach($contentYesterday as $value){
    if(in_array(KEY_CUR_USD, $value) || (in_array(KEY_CUR_EUR, $value)) || (in_array(KEY_CUR_RUB, $value))){
      $resYesterday[] = $value;
    }
  }

  foreach($content as $value){
    if(in_array(KEY_CUR_USD, $value) || (in_array(KEY_CUR_EUR, $value)) || (in_array(KEY_CUR_RUB, $value))){
      $resToday[] = $value;
    }
  }


  +

  for ($i=0; $i < 3; $i++) { 
    switch ($i) {
      case 0:
        $date = date_create($resYesterday[$i]['Date']);
        $page_data = preg_replace("/{USDyesterday}/U",$resYesterday[$i]['Cur_Scale']." ".$resYesterday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);
        $date = date_create($resToday[$i]['Date']);
        $page_data = preg_replace("/{USDtoday}/U",$resToday[$i]['Cur_Scale']." ".$resToday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);

        $page_data = preg_replace("/{USDyRate}/U", $resYesterday[$i]['Cur_OfficialRate'], $page_data);
        $page_data = preg_replace("/{USDtRate}/U",$resToday[$i]['Cur_OfficialRate'], $page_data);
        break;
      case 1:
        $date = date_create($resYesterday[$i]['Date']);
        $page_data = preg_replace("/{EURyesterday}/U",$resYesterday[$i]['Cur_Scale']." ".$resYesterday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);
        $date = date_create($resToday[$i]['Date']);
        $page_data = preg_replace("/{EURtoday}/U", $resToday[$i]['Cur_Scale']." ".$resToday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);

        $page_data = preg_replace("/{EURyRate}/U", $resYesterday[$i]['Cur_OfficialRate'], $page_data);
        $page_data = preg_replace("/{EURtRate}/U",$resToday[$i]['Cur_OfficialRate'], $page_data);
        break;
        case 2:
        $date = date_create($resYesterday[$i]['Date']);
        $page_data = preg_replace("/{RUByesterday}/U",$resYesterday[$i]['Cur_Scale']." ".$resYesterday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);
        $date = date_create($resToday[$i]['Date']);
        $page_data = preg_replace("/{RUBtoday}/U", $resToday[$i]['Cur_Scale']." ".$resToday[$i]['Cur_Name']."<br>".date_format($date,'Y.m.d'), $page_data);

        $page_data = preg_replace("/{RUByRate}/U", $resYesterday[$i]['Cur_OfficialRate'], $page_data);
        $page_data = preg_replace("/{RUBtRate}/U",$resToday[$i]['Cur_OfficialRate'], $page_data);
        break;
    }

  }
  echo $page_data;

  