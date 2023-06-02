<?php
    include ('config/Mysql.php');
    include ('modelos/Articulo.php');
    $base = new Mysql();
    $cx = $base->connect();
    $articulos = new Articulo($cx);
?>

<div class="container-fluid my-4">
        <h1 class="text-center">Artículos</h1>
        <div class="row">
            <?php foreach($articulos->listar(0,1) as $articulo):?>
                <div class="col-sm-4 my-2">
                    <div class="card h-100">
                        <img src="img/articulos/<?=$articulo->imagen?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?=$articulo->titulo?></h5>
                            <p><strong><?=formatearFecha($articulo->fecha_creacion)?></strong></p>
                            <p class="card-text"><?=textocorto($articulo->texto,300)?></p>
                            <a href="detalle.php?id=<?=$articulo->id?>" class="btn btn-sprimary">Ver más</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            
        </div>            
    </div>