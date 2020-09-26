
<?php


include_once "Templates/cabecera.php";?>





<div class="container">
<div class="row">


<?php

include "Database/data_base.php";


$datos = new Base_datos();
$sql="SELECT * FROM productos";
$conect = $datos->Conectar()->prepare($sql);
$conect->execute();


if($conect->rowCount()){

    

    
      while($filas = $conect->fetch()){


        ?>

          <div class="producto col-3 m-4">

          <div class="card" style="width: 18rem;">
          <img src="Images/<?php  echo $filas["Imagen"]  ?>.jpg" class="card-img-top" height="200px" alt="...">
          <div class="card-body">
          <h5 class="card-title"><?php echo $filas["Nombre"]  ?></h5>
          <p class="card-text">$ <?php echo $filas["Precio"]  ?></p>



          <?php

          if(isset($_SESSION["carrito"])){

          foreach ($_SESSION["carrito"] as $items => $valor){

            if($valor["id"]==$filas["Id"]){

              echo "<a href='carrito.php' class='btn btn-warning form-control mb-3'>Ver el carrito</a>";
              
                }

              }

            }

            ?>



          <form action="carrito.php" method="POST" class="formulario">

          <input type="hidden" name="id" value="<?php echo$filas["Id"] ?>">
          <input type="hidden" name="nombre" value="<?php echo $filas["Nombre"]  ?>">
          <input type="hidden" name="precio" value="<?php echo openssl_encrypt($filas["Precio"],METHOD,KEY)   ?>">
          <input type="hidden" name="cantidad" value= <?php echo openssl_encrypt(1,METHOD,KEY)   ?>>
          <input type="hidden" name="imagen" value="<?php echo$filas["Imagen"] ?>">


          <button type="submit" name="boton" value="agregar" class="btn btn-success form-control mt-1">
          Añadir al carrito
          
          <svg class="cesta" width="20px" height="20" viewBox="0 0 16 16" class="bi bi-bag-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 1a2.5 2.5 0 0 0-2.5 2.5V4h5v-.5A2.5 2.5 0 0 0 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5H2z"/>
          <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5z"/>
          </svg>
          
          </button>

          </form>


        
        </div>
        </div>
        </div>



      <?php

      }




}else{

    echo "No se pudo cargar los Productos";
}



?>



<!-- Final de la fila -->
</div>
<!-- Final del contenedor -->
</div>



</body>
</html>
