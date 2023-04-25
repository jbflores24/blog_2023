<?php
    $protocolo = "http";
    $servidor = "localhost";
    $proyecto = "blog_2023";
    // Definimos la ruta de admin
    define ('RUTA_ADMIN',$protocolo.'://'.$servidor."/".$proyecto."/admin/");
    //Definimos la ruta de un usuario sin autenticar
    define ('RUTA_FRONT',$protocolo.'://'.$servidor."/".$proyecto."/admin/");