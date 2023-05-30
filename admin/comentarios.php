<?php 
    include("../includes/header.php"); 
    include("../config/Mysql.php");
    include("../modelos/Comentario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $comentarios = new Comentario($cx);
?>

<div class="row">
    <div class="col-sm-6">
        <h3>Lista de Comentarios</h3>
    </div>       
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblContactos" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comentario</th>
                        <th>Usuario</th>
                        <th>Artículo</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>                                          
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($comentarios->listar($_SESSION['id'],$_SESSION['rol_id']) as $comentario):?>
                    <tr>
                        <td><?=$comentario->id?></td>
                        <td><?=$comentario->comentario?></td>
                        <td><?=$comentario->autor?></td>
                        <td><?=$comentario->titulo?></td> 
                        <td><?=$comentario->estado==1?'APROBADO':'PENDIENTE'?></td>
                        <td><?=$comentario->fecha_creacion?></td>              
                        <td>
                            <a href="editar_comentario.php" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>                            
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
        $('#tblContactos').DataTable();
    });
</script>