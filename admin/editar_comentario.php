<?php 
    include("../includes/header.php"); 
    include("../config/Mysql.php");
    include("../modelos/Comentario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $comentario = new Comentario($cx);
    if (isset($_GET['id'])){
        $id=$_GET['id'];
        $comment = $comentario->get_comentario($id);
    }
    if (isset($_POST['editarComentario'])){
        $id = $_GET['id'];
        $estado = $_POST['cambiarEstado'];
        if ($estado == -1){
            $error = "Debe seleccionar un estado del comentario";
        } else {
            if ($comentario->editar($id,$estado)){
                $mensaje = "Comentario editado correctamente";
                header("Location:comentarios.php?mensaje=".urlencode($mensaje));
            } else {
                $error = "No se ha podido editar el comentario";
            }
        }
    }
    if (isset($_POST['borrarComentario'])){
        $id = $_GET['id'];
        if ($comentario->eliminar($id)){
            $mensaje = "Comentario eliminado correctamente";
            header("Location:comentarios.php?mensaje=".urlencode($mensaje));
        } else {
            $error = "No se ha podido eliminar el comentario";
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
        <div class="col-sm-12">
            <h3 class="text-center">Editar Comentario</h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action=""> 

            <input type="hidden" name="id" value="<?=$comment->id?>">

            <div class="mb-3">
                <label for="texto">Texto</label>   
                <textarea class="form-control" placeholder="Escriba el texto de su artículo" name="texto" style="height: 200px" readonly>
                    <?=$comment->comentario?>
                </textarea>              
            </div>               

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" value="<?=$comment->autor?>" readonly>               
            </div>

            <div class="mb-3">
                <label for="cambiarEstado" class="form-label">Cambiar estado:</label>
                <select class="form-select" name="cambiarEstado" aria-label="Default select example">
                <option value="-1">--Seleccionar una opción--</option>
                <option value="1" <?=$comment->estado==1?'selected':''?>>Aprobado</option>
                <option value="0" <?=$comment->estado==0?'selected':''?>>No Aprobado</option>              
                </select>                 
            </div>  

            <br />
            <button type="submit" name="editarComentario" class="btn btn-success float-left"><i class="bi bi-person-bounding-box"></i> Editar Comentario</button>

            <button type="submit" name="borrarComentario" class="btn btn-danger float-right"><i class="bi bi-person-bounding-box"></i> Borrar Comentario</button>
            </form>
        </div>
    </div>
<?php include("../includes/footer.php") ?>
       