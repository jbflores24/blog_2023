<?php 
    include("includes/header_front.php");
    include ('config/Mysql.php');
    include ('modelos/Articulo.php');
    $base = new Mysql();
    $cx = $base->connect();
    $articulo = new Articulo($cx);
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $article = $articulo->getArticulo($id);
    } 
?>

    <div class="row">
       
    </div>

    <div class="container-fluid"> 
      
        <div class="row">
                
        <div class="row">
        <div class="col-sm-12">
            
        </div>  
    </div>

            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header">
                        <h1><?=$article->titulo?></h1>
                   </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid img-thumbnail" src="img/articulos/<?=$article->imagen?>">
                        </div>

                        <p><?=$article->texto?></p>

                    </div>
                </div>
            </div>
        </div>  
  
        <?php if(isset($_SESSION['auth'])):?>
            <div class="row">        
                <div class="col-sm-6 offset-3">
                    <form method="POST" action="">
                        <input type="hidden" name="articulo" value="<?=$id?>">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario:</label>
                            <input type="text" class="form-control" name="usuario" id="usuario" value="<?=$_SESSION['email']?>" readonly>               
                        </div>
                    
                        <div class="mb-3">
                            <label for="comentario">Comentario</label>   
                            <textarea class="form-control" name="comentario" style="height: 200px"></textarea>              
                        </div>          
                    
                        <br />
                        <button type="submit" name="enviarComentario" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Comentario</button>
                    </form>
                </div>
            </div>
        <?php endif;?>
    </div>

    <div class="row">
    <h3 class="text-center mt-5">Comentarios</h3>
      
            <h4><i class="bi bi-person-circle"></i> juangarcia@gmail.com</h4>
            <p>texto comentario demo</p>
      
    </div>
         
    </div>
<?php include("includes/footer.php") ?>
       