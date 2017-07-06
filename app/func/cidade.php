<?php
function cidade(){
  try{


    $cidade=new PDO ("mysql:host=cloud908.configrapp.com;dbname=".$vAdmin->banco."","prefs","IwOfBHgJvO5bI");
    $gerenciador->exec("SET CHARACTER SET utf8");



  }catch(PDOException $e){
    echo $e -> getMessage();
  }
  return $pdo;

}
?>
