<?php
    include ('config/Mysql.php');
    include ('modelos/Articulo.php');
    $base = new Mysql();
    $cx = $base->connect();
    $articulos = new Articulo($cx);
?>

<div class="container-fluid">
        <h1 class="text-center">Artículos</h1>
        <div class="row">
            <?php foreach($articulos->listar(0,1) as $articulo):?>
                <div class="col-sm-4">
                    <div class="card">
                        <img src="img/articulos/<?=$articulo->imagen?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?=$articulo->titulo?></h5>
                            <p><strong><?=$articulo->fecha_creacion?></strong></p>
                            <p class="card-text"><?=$articulo->texto?></p>
                            <a href="detalle.php?id=<?=$articulo->id?>" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            
        </div>            
    </div>