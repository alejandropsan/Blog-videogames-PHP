<?php require_once 'includes/redireccion.php'; ?>
<?php require_once 'includes/cabecera.php'; ?>
 <?php require_once 'includes/lateral.php'; ?>


<div id="principal">
     <h1>Crear categorias</h1>
     <p>Añadiendo nuevas categorías podrán ser usadas por todos los demás usuarios</p>
     <br />
     <form action="guardar-categoria.php" method="POST">
         <label for="nombre">Nombre de la nueva categoría:</label>
         <input type="text" name="nombre" />
         <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>
         <input type="submit" value="Guardar" />
     </form>


</div>

             
             
         
        <!-- FOOTER -->
        <?php require_once 'includes/pie.php'; ?>