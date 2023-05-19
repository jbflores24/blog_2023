<?php 
    include("../includes/header.php"); 
    include("../config/Mysql.php");
    include("../modelos/Articulo.php");
    $base = new Mysql();
    $cx = $base->connect();
    $articulos = new Articulo($cx);
    if (isset($_GET['mensaje'])){
        $mensaje = $_GET['mensaje'];
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
    <div class="col-sm-6">
        <h3>Lista de Artículos</h3>
    </div> 
    <div class="col-sm-4 offset-2">
        <a href="gestion_articulo.php?op=1" class="btn btn-success w-100"><i class="bi bi-plus-circle-fill"></i> Nuevo Artículo</a>
    </div>    
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblArticulos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th> 
                        <th>Texto</th>
                        <?php if ($_SESSION['rol_id']==1):?>
                            <th>Autor</th>
                        <?php endif;?>
                        <th>Fecha de creación</th>              
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($articulos->listar($_SESSION['id'], $_SESSION['rol_id']) as $articulo):?>
                        <tr>
                            <td><?=$articulo->id?></td>
                            <td><?=$articulo->titulo?></td>
                            <td>
                                <img src="<?=RUTA_FRONT?>img/articulos/<?=$articulo->imagen?>" style="width:180px;">
                            </td>
                            <td><?=$articulo->texto?></td>
                            <?php if ($_SESSION['rol_id']==1):?>
                                <td><?=$articulo->autor?></td>
                            <?php endif;?>
                            <td><?=$articulo->fecha_creacion?></td>                      
                            <td>
                            <a href="gestion_articulo.php?op=2" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>                       
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>       
            </table>
    </div>
</div>
<?php include("../includes/footer.php") ?>

<script>
    $(document).ready( function () {
        $('#tblArticulos').DataTable();
    });
</script>