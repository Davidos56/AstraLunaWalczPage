<?php


$baseLink = "http://localhost/AstraLunaWalcz/src/scripts/";
$infodir = "../assets/json/gallery/galleryList.json";
$exedir = "getPhotosList.php?name=";
$exedir2 = "getGalleryList.php";


ExeCommandUrl("", $exedir2);

$str = file_get_contents($infodir);
$json = json_decode($str,true);




  foreach($json as $item)
  {
      if($item['dirname'] != null)
      {
        ExeCommandUrl($item['dirname'] , $exedir);
      }
 
  }


  function ExeCommandUrl($dirname, $exedir)
  {
    global $baseLink;
    $name = str_replace(' ', '%20',$dirname);
    $location = $baseLink.$exedir.$name;
    echo  $location;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $location); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $output = curl_exec($ch); 
    echo  $output;
    curl_close($ch);     
  }
?>