<?php 
    include("../includes/header.php");
    include("../config/Mysql.php");
    include("../modelos/Articulo.php");
    $base = new Mysql();
    $cx = $base->connect();
    $articulo = new Articulo($cx); 
    if (isset($_GET['op'])){
        $op = $_GET['op'];
        if ($op == 1){
            $titulo = "Crear Artículo";
        } else {
            $titulo = "Editar Artículo";
        }
    }
    if (isset($_POST['gestionArticulo'])){
      $titulo = $_POST['titulo'];
      $texto = $_POST['texto'];
      if (empty($titulo) || $titulo=='' || empty($texto) || $texto==''){
        $error = "Algunos campos están vacíos";
      }else {
        if ($_FILES['imagen']['error']>0){
            if ($op!=2){
                $error = "Debe seleccionar una imagen";
            } else {
                //se va a editar
            }
        } else {
            $image = $_FILES['imagen']['name'];
            $imageArr = explode('.',$image);
            $rand = rand(1000, 9999);
            $newImage = $imageArr[0].$rand.".".$imageArr[1];
            $rutaFinal = "../img/articulos/".$newImage;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaFinal))
            {
                if ($op==1)
                {   
                    if ($articulo->crear($titulo, $newImage, $texto, $_SESSION['id']))
                    {
                        $mensaje = "Articulo creado correctamente";
                        header("Location:articulos.php?mensaje=".urldecode($mensaje));
                    } else {
                        $error ="No se pudo crear el artículo";
                    }
                } else {
                    //Va a editar
                }
            }
        }
      }  
    }
?>
<!--Imprimir el error o el mensaje -->
<div class="row">
        <div class="col-sm-12">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?=$error?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ;?>    
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if (isset($mensaje)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?=$mensaje?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ;?>    
        </div>
    </div>

<div class="row">
       
    </div>

<div class="row">
        <div class="col-sm-12">
            <h3 class="text-center"><?=$titulo;?></h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="4">

            <div class="mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="titulo test">               
            </div>
            <?php if ($op==2):?>
                <div class="mb-3">
                    <img class="img-fluid img-thumbnail" src="../img/articulos/img4.jpg">
                </div>
            <?php endif;?>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" accept=".jpg, .png, .jpeg" class="form-control" name="imagen" id="imagen" placeholder="Selecciona una imagen">               
            </div>
            <div class="mb-3">
                <label for="texto">Texto</label>   
                <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto" style="height: 200px">
               ejemplo texto
                </textarea>              
            </div>          
        
            <br />
            <?php if ($op==2):?>
                <button type="submit" name="gestionArticulo" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Artículo</button>
                <button type="submit" name="borrarArticulo" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Artículo</button>
            <?php else:?>
                <button type="submit" name="gestionArticulo" class="btn btn-primary float-left"><i class="bi bi-person-bounding-box"></i> Crear Artículo</button>
            <?php endif;?>
        </form>    
    </div>
</div>
<?php include("../includes/footer.php") ?>