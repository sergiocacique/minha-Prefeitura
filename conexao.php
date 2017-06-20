<?php
function conectar(){
  try{
    //$pdo=new PDO ("mysql:host=localhost;dbname=db_transparencia","root","root");
    $pdo=new PDO ("mysql:host=cloud908.configrapp.com;dbname=db_minhaprefeitura","prefs","IwOfBHgJvO5bI");
    $pdo->exec("SET CHARACTER SET utf8");
  }catch(PDOException $e){
    echo $e -> getMessage();
  }
  return $pdo;
}

?>
