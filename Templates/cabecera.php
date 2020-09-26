


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Css/tienda.css">
    <title>Tienda Oficial</title>
</head>
<body>
    


<!-- Just an image -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="index.php">
    <img src="Images/logo.png" width="70" height="50" alt="" loading="lazy">
    Nike
  </a>
 <a class="nav-link" href="carrito.php">
 
<img src="Images/carrito.svg" class="mt-2">
 
 <span class="badge badge-success">
 
 <?php

session_start(); 
 if(isset($_SESSION["carrito"])){
 
  $cantidad = 0;
  foreach ($_SESSION["carrito"] as $key => $value) {
    
    $cantidad = $cantidad + $value["cantidad"];

  }

echo $cantidad;

 }else{

echo 0;

 }




?>
 
 </span>
 
 </a>

</nav>