<?php
    require 'idioma.php';

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/index.css?1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <ul id="navigation">
            <li id="logo">MiniCloud</li>
            <li><a href="index.php?idioma=<?=$idioma?>" style="color: black ;background-color: whitesmoke;"><?=getCadena('nav1')?></a></li>
            <li><a href="subir.php?idioma=<?=$idioma?>"><?=getCadena('nav2')?></a></li>
            <li><a href="cloud.php?idioma=<?=$idioma?>"><?=getCadena('nav3')?></a></li>
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
        <h1><?=getCadena('bienvenida')?></h1>
        <p><?=getCadena('parrafo1')?></p></br>
        <a href="subir.php?idioma=<?=$idioma?>"><?=getCadena('boton1')?></a>
        
    </main>
    <footer>
        @2022 DWES, inc.
    </footer>
</body>
</html>