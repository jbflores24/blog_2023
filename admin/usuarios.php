<?php 
    include("../includes/header.php");
    include("../config/Mysql.php");
    include("../modelos/Usuario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $usuarios = new Usuario($cx);
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
        <h3>Lista de Usuarios</h3>
    </div>     
</div>
<div class="row mt-2 caja">
    <div class="col-sm-12">
            <table id="tblUsuarios" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Fecha de Creación</th>                       
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios->listar() as $usuario):?>
                    <tr>
                        <td><?=$usuario->id?></td>
                        <td><?=$usuario->nombre?></td>
                        <td><?=$usuario->email?></td>
                        <td><?=$usuario->rol?></td>
                        <td><?=$usuario->fecha_creacion?></td>
                        <td>
                            <a href="editar_usuario.php?id=<?=$usuario->id?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i></a>                                            
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
        $('#tblUsuarios').DataTable();
    });
</script>