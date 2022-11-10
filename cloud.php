<?php
    require 'idioma.php';

    //funcion que imprime todas las fotos
    function imprimirFotos()
    {   
        $contador = 0;
        //filtra por extension con preg_grep, y mete a otro array los elementos .. y . que se crean al crear un array con scandir
        $imagenes = preg_grep('~\.(jpeg|jpg|png|gif)$~',array_diff(scandir("ficheros/"), array('..', '.')));
        foreach($imagenes as $imagen){
            echo "<a href='ficheros/$imagen'><img src='ficheros/$imagen'></a>"; 
            $contador++;
        }
        
        //si no hay ninguna imagen:
        if($contador == 0){
            echo getCadena('sinImagenes');
        }
    }

    //funcion que imprime todos los ficheros
    function imprimirFicheros()
    {   
        $contador = 0;
        //filtra por extension con preg_grep, y mete a otro array los elementos .. y . que se crean al crear un array con scandir
        $ficheros = preg_grep('~\.(pdf)$~',array_diff(scandir("ficheros/"), array('..', '.')));  
        echo "<ul>";
        foreach ($ficheros as $fichero) { 
            echo "<li><a href='ficheros/$fichero'>$fichero</a></li>"; 
            $contador++;
        }
        //si no hay ningun pdf
        if($contador == 0){
            echo getCadena('sinPdf');
        }
        echo "</ul>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/cloud.css?1.0">
    
    <title>Document</title>
</head>
<body>
    <header>
        <ul id="navigation">
            <li id="logo">MiniCloud</li>
            <li><a href="index.php?idioma=<?=$idioma?>" ><?=getCadena('nav1')?></a></li>
            <li><a href="subir.php?idioma=<?=$idioma?>" ><?=getCadena('nav2')?></a></li>
            <li><a href="cloud.php?idioma=<?=$idioma?>" style="color: black; background-color: whitesmoke;"><?=getCadena('nav3')?></a></li>
        </ul>
    
        
        <form action="#" method="GET" id="lang">
            <select name="idioma" id="selectLang">
                <option value="es" <?php if ($idioma == 'es') { echo 'selected'; }?>>Español</option>
                <option value="en" <?php if ($idioma == 'en') { echo 'selected'; }?>>English</option>
            </select>
            <input type="submit" value="Ok" id="OK">
        </form>
    </header>
    <main>
        <h1><?=getCadena('tusFicheros')?></h1>
        <div id="ficheros">
            <?php
            imprimirFicheros();
            ?>
        </div>
        <h1><?=getCadena('tusFotos')?></h1>
        <div id="imagenes">
            <?php
            imprimirFotos();
            ?>
        </div>
    </main> 
    <footer>
        @2022 DWES, inc.
    </footer>
</body>
</html>