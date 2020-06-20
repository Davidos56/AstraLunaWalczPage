<?php

$prefix = "../";
$dir = "assets/images/gallery/";
$infodir = "../assets/json/gallery/galleryInfo.json";
//$response = array();


///Gallery info 
$str = file_get_contents($infodir);
$json = json_decode($str,true);



///FOLDERY
if (is_dir($prefix.$dir)){
  if ($dh = opendir($prefix.$dir)){
    while (($file = readdir($dh)) !== false){
        //echo "filename:" . $file . "<br>";
        if(is_dir($fullpath = $prefix.$dir.$file))
        {
            //echo $fullpath;
            if ($dh1 = opendir($fullpath)){
                   $files = scandir($fullpath)[2];   
                   closedir($dh1); 
            }
            if ($file != '.' && $file != '..') 
            {
              $info = GetGallrtyInfoByDirname($file);
              if($info['display'] == true){
                $response[] = array( 
                    'shortname' =>$info['shortname'],
                    'fullname' =>$info['fullname'],
                    'city' =>$info['city'],
                    'date' =>$info['date'],
                    'display' =>$info['display'],
                    'dirname' => $file ,
                    'dirpath' => str_replace(' ', '%20','./././'.$dir.$file),
                    'photopath' => str_replace(' ', '%20','./././'.$dir.$file.'/'.$files)
                );
              }
            }
            
        }
    }
    closedir($dh);
  }
}

function GetGallrtyInfoByDirname(string $name)
{
  global $json;
  foreach($json as $item)
  {
    if($item['dirname'] == $name)
    return $item;
  }
  return null;
}
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
$fp = fopen($prefix.'assets/json/gallery/galleryList.json', 'w');
fwrite($fp, json_encode($response,true));
fclose($fp);
echo json_encode($response,true);
?>