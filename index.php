                <!-- CABECERA -->
                <!-- LOGO -->
                <!-- MENÚ -->
<?php require_once 'includes/cabecera.php'; ?>
            <!-- SIDEBAR -->
 <?php require_once 'includes/lateral.php'; ?>

             <!-- MAIN -->
 <div id="principal">
     <h1>Últimas entradas</h1>
     
     <?php 
        $entradas = conseguirEntradas($db, true);
        if(!empty($entradas)): 
            while($entrada = mysqli_fetch_assoc($entradas)): 
         ?>
            
          
      
                <article class="entrada">
                    <a href="entrada.php?id=<?=$entrada['id']?>">
                        <h2><?=$entrada['titulo'] ?></h2>
                        <span class="fecha"><?=$entrada['categoria'].' | '.$entrada['fecha']?></span>
                       <p>
                           <?=substr($entrada['descripcion'], 1, 180). "..." ?>
                       </p>
                    </a>
                </article>
            
      <?php  
      endwhile;
        endif;
     ?>
     <?php if(empty($entradas)): ?>
          <?php echo 'No hay entradas'; ?>
     <?php
     endif; ?>
     
     
     <div id="ver-todas">
     <a href="entradas.php">Ver todas las entradas</a>
     </div>
 </div>

        <!-- FOOTER -->
        <?php require_once 'includes/pie.php'; ?>
        
        
        
