<?php 
    include("includes/header_front.php"); 
    include("config/Mysql.php");
    include("modelos/Usuario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $u = new Usuario($cx);
    if (isset($_POST['registrarse'])){
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmar_password = $_POST['confirmar_password'];
        if (empty($nombre) || $nombre=='' || empty($email) || $email=='' || empty($password) || $password=='' || empty($confirmar_password) || $confirmar_password==''){
            $error = "Algunos campos están vacíos, verifique !!";
        } else {
            if ($password != $confirmar_password){
                $error = "Las contraseñas no coinciden, verifique!!";
            }else{
                if ($u->valida_email($email)){
                    $error = "Ya existe ese correo electrónico, verifique o coloque otro!!";
                } else {
                    if ($u->registro($nombre, $email, $password)){
                        $mensaje = "Se registro correctamente";
                    } else {
                        $error = "Ocurrió un error al registrar al usuario";
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
    <!--Inicia código de registro-->
    <div class="container-fluid mt-5">
        <h1 class="text-center">Registro de Usuarios</h1>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="card">
                   <div class="card-header">
                        Regístrate para poder comentar
                   </div>
                    <div class="card-body">
                    <form method="POST" action="">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingresa el nombre">               
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingresa el email">               
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Ingresa el password">               
                    </div>

                    <div class="mb-3">
                        <label for="confirmar_password" class="form-label">Confirmar password:</label>
                        <input type="password" class="form-control" name="confirmar_password" placeholder="Ingresa la confirmación del password">            
                    </div>                    

                    <br />
                    <button type="submit" name="registrarse" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Registrarse</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>  
         
    </div>
<?php include("includes/footer.php") ?>
       