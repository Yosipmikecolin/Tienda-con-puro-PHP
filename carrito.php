<?php

include_once "Database/config.php";
include_once "Templates/cabecera.php";



$mensaje="";


if(isset($_POST["boton"])){


    header("location:carrito.php");

    switch($_POST["boton"]){

      case "agregar":
       
      if(is_numeric($_POST["id"])){

       $Id = $_POST["id"];
       $_SESSION["id"] = $Id;
          

         }else{

            echo $mensaje = "Hubo un error con el producto";
         }
//---------------------------------------------------------------------------------


         if(is_string($_POST["nombre"])){

            $Nombre = $_POST["nombre"];
          
         }else{

            echo $mensaje = "Hubo un error con el producto";
         }

//---------------------------------------------------------------------------------
         
         if(is_numeric( openssl_decrypt($_POST["precio"],METHOD,KEY) )){

             $Precio = openssl_decrypt($_POST["precio"],METHOD,KEY);
          
         }else{

           echo $mensaje = "Hubo un error con el precio";
         }

//---------------------------------------------------------------------------------

         
         if(is_numeric( openssl_decrypt($_POST["cantidad"],METHOD,KEY) )){

            $Cantidad = openssl_decrypt($_POST["cantidad"],METHOD,KEY);
         
        }else{

            echo $mensaje = "Hubo un error con el cantidad";
        }

//---------------------------------------------------------------------------------


        
        $Imagen= $_POST["imagen"];


        //VALIDAR LO QUE TENGO EN EL CARRITO

        
        if(!isset($_SESSION["carrito"])){


            $arreglo = array(

                "id"=> $Id,
                "nombre"=>$Nombre,
                "precio"=>$Precio,
                "imagen"=>$Imagen,
                "cantidad"=>$Cantidad
                

            );

             $_SESSION["carrito"][0] = $arreglo;
            


        }else{

          foreach ($_SESSION["carrito"] as $items => $valor){


            if($valor["id"]==$_SESSION["id"]){

              $cant = $valor["cantidad"];
              $arreglo = array(

                "id"=> $Id,
                "nombre"=>$Nombre,
                "precio"=>$Precio,
                "imagen"=>$Imagen,
                "cantidad"=>$cant+1
                
            );

             $_SESSION["carrito"][$items] = $arreglo;
             return $_SESSION["carrito"];
              

                }

              }


              // si es igual a 1 es por que tiene un array la sesion
              $numero_productos = count($_SESSION["carrito"]);
                            

              $arreglo = array(

              "id"=> $Id,
              "nombre"=>$Nombre,
              "precio"=>$Precio,
              "imagen"=>$Imagen,
              "cantidad"=>$Cantidad

              );


              $_SESSION["carrito"][ $numero_productos] = $arreglo;

              return $_SESSION["carrito"];

        }

        break;

}

    
   
    


}

?>













                          <?php

                          if(empty($_SESSION["carrito"])){

                            ?>

                            <div class="container text-center">
                            
                            <h1>Tu carrito está vacío.</h1>
                            <a href="index.php" class="btn btn-primary mt-5 pt-3 pb-3 pl-5 pr-5">Volver a la Tienda</a>
                            </div>


                            <?php
                            die();

                          }

                          ?>


                          <script>
                          if (window.history.replaceState) { // verificamos disponibilidad
                              window.history.replaceState(null, null, "carrito.php");
                          }
                          </script>





                        <!--......................................................................-->



                             <div class="container">



                            <table class="table table-striped text-center table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Producto</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>



                          <?php  $total=0; $suma_cantidad=0?>

                          <?php foreach ($_SESSION["carrito"] as $items => $value) {?>

                            


                              <tr class="text-center">

                            <!-- Fila ---------------------------------------------------- -->

                              <th class="pt-5">

                              <form action="" method="POST">


                              <button type="submit" name="eliminar" class="btn">
                              <svg class="text-danger" width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-x-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                              </svg>
                            </button>


                            <input type="hidden" name ="input_eliminar" value="<?php echo $value["id"] ?>">

                      
                            </form>

                            </th>

                          <!-- Fila ---------------------------------------------------- -->
                              
                            <th><img src="Images/<?php  echo $value["imagen"];  ?>.jpg" height="100px"></th>
                            <th class="pt-5"><?php echo $value["nombre"];  ?></th>
                            <td class="pt-5"><?php  echo $value["precio"];  ?></td>

                            <form action="carrito.php" method="POST">

                            <input type="hidden" name="input_id" value="<?php echo $value["id"] ?>">

                            <input type="hidden" name ="input_nombre" value="<?php echo $value["nombre"] ?>">
                            <input type="hidden" name ="input_precio" value="<?php echo $value["precio"] ?>">
                            <input type="hidden" name ="input_imagen" value="<?php echo $value["imagen"] ?>">
                            <input type="hidden" name ="input_cantidad" value="<?php echo $value["cantidad"] ?>">

                            <td class="text-center pt-5">
                              
                              <button class="mr-1" style="border:none;" id="btn-cantidad" name="cantidad" value="restar">
                              
                              <svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-arrow-left-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                              </svg>
                            
                             </button> 
                              
                              <?php echo $value["cantidad"]; ?>
                              
                              
                              <button style="border:none;" id="btn-cantidad" name="cantidad" value="sumar" class=" ml-2">

                              <svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5A.5.5 0 0 0 4 8z"/>
                              </svg>
                            
                             </button>
                            
                            </td>

                            
                            </form>

                            <td class="pt-5"><?php echo $suma = $value["precio"] * $value["cantidad"]; ?></td>

                            </tr>
                            
                          <?php  $total=$total+( $value["precio"] * $value["cantidad"]);
                          
                           $suma_cantidad = $suma_cantidad + ($value["cantidad"]);
                          ?>


                          <?php  } ?>



                          </tbody>
                          </table>


                          <h3 align="right">Total del carrito</h3> 
                          <h2 align="right"> <?php  echo "$". $total; ?></h2>

                           

                          
                          </div>

                      <!--......................................................................-->








                              <?php

                            //ELIMINAR UN PRODUCTO DE LA TABLA

                            if(isset($_POST["eliminar"])){

                            foreach ($_SESSION["carrito"] as $indice => $value) {
                                
                              if($value["id"]== $_POST["input_eliminar"]){

                                unset($_SESSION["carrito"][$indice]);
                                array_multisort($_SESSION["carrito"]);


                              ?>

                              <script>

                              location.reload();

                              </script>


                              <?php

                                }


                              }

                            }


                            //CAMBIAR CANTIDAD DE UN PRODUCTO DE LA TABLA


                            if(isset($_POST["cantidad"])){

                                switch($_POST["cantidad"]){

                                  case "sumar":

                                    foreach ($_SESSION["carrito"] as $items => $valor){


                                      if($valor["id"]==$_POST["input_id"]){
                                      

                                        $cant = $_POST["input_cantidad"];
                                        $arreglo = array(

                                          "id"=> $_POST["input_id"],
                                          "nombre"=>$_POST["input_nombre"],
                                          "precio"=>$_POST["input_precio"],
                                          "imagen"=>$_POST["input_imagen"],
                                          "cantidad"=>$cant+1
                                          
                                      );

                                      $_SESSION["carrito"][$items] = $arreglo;
                                      
                                      ?>

                                      <script>
        
                                      location.reload();
        
                                      </script>
        
        
                                      <?php
                                       return $_SESSION["carrito"];
                                        
                          
                                          }
                          
                                        }
                                    
                                    


                                  break;


                                  case "restar":

                                    foreach ($_SESSION["carrito"] as $items => $valor){


                                      if($valor["id"]==$_POST["input_id"]){
                                      

                                        $cant = $_POST["input_cantidad"];
                                        $arreglo = array(

                                          "id"=> $_POST["input_id"],
                                          "nombre"=>$_POST["input_nombre"],
                                          "precio"=>$_POST["input_precio"],
                                          "imagen"=>$_POST["input_imagen"],
                                          "cantidad"=>$cant-1
                                          
                                      );

                                      $_SESSION["carrito"][$items] = $arreglo;
                                      
                                      ?>

                                      <script>
        
                                      location.reload();
        
                                      </script>
        
        
                                      <?php
                                       return $_SESSION["carrito"];
                                        
                          
                                          }
                          
                                        }


                                  break;


                                }


                            }
                            




include_once "Templates/pie.php";
?>
