<?php 
    include("includes/header_front.php"); 
    include("config/Mysql.php");
    include("config/config.php");
    include("modelos/Usuario.php");
    $base = new Mysql();
    $cx = $base->connect();
    $usuario = new Usuario($cx);
    if (isset($_POST['acceder'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || $email=='' || empty($password) || $password==''){
            $error = "Algunos campos están vacíos, verifique !!";
        }else {
            if ($usuario->acceder($email, $password)){
                $_SESSION['auth']=true;
                $_SESSION['email']=$email;
                $u = $usuario->usuario_email($email);
                $_SESSION['id'] = $u->id;
                $_SESSION['nombre'] = $u->nombre;
                $_SESSION['rol_id'] = $u->rol_id;
                header("location:". RUTA_FRONT ."index.php");
                die();
            } else {
                $error = "Correo y/o contraseña incorrectos";
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

    <div class="container-fluid mt-5">
        <h1 class="text-center">Acceso de Usuarios</h1>
        <div class="row">
            <div class="col-sm-6 offset-3">
                <div class="card">
                   <div class="card-header">
                        Ingresa tus datos para acceder
                   </div>
                    <div class="card-body">
                    <form method="POST" action="">

                   

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" placeholder="Ingresa el email">               
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Ingresa el password">               
                    </div>

                    <br />
                    <button type="submit" name="acceder" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Acceder</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>  
         
    </div>
<?php include("includes/footer.php") ?>
       