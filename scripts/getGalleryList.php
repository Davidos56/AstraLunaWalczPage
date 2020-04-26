<?php
header("Content-Type: application/json");
$prefix = "../";
$dir = "assets/images/gallery/";
$response = array();


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
            if ($file != '.' && $file != '..') {
                $response[] = array( 
                    'dirname' => $file ,
                    'dirpath' => str_replace(' ', '%20','./././'.$dir.$file),
                    'photopath' => str_replace(' ', '%20','./././'.$dir.$file.'/'.$files)
                );
            }
            
        }
    }
    closedir($dh);
  }
}
echo json_encode($response);
?>