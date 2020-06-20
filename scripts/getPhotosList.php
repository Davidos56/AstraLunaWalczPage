<?php
header("Content-Type: application/json");
$prefix = "../";
$dir = "assets/images/gallery/".$_GET['name'];
$response = array();


if (is_dir($prefix.$dir))
{
    if ($dh = opendir($prefix.$dir))
    {
        while (($file = readdir($dh)) !== false)
        {
          if ($file != '.' && $file != '..') 
          {
              $response[] = array( 
                  'src' => str_replace(' ', '%20','./././'.$dir.'/'.$file),
                  'show'=> 'false'
              );
          }
        }
        closedir($dh);
    }
}

header('Access-Control-Allow-Origin: *');
$fp = fopen($prefix.'assets/json/gallery/getPhotosList_'.$_GET['name'].'.json', 'w');
fwrite($fp, json_encode($response,true));
fclose($fp);
echo json_encode($response);
?>