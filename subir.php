<?php
require 'idioma.php';

//array para los ficheros
$arrayFicheros = array();

/*
//Funcion que valida el campo nombre_fichero
//comprueba que es una cadena mayor que 0
*/
function validarNombre($nombre)
{
    if (mb_strlen($nombre) > 0) {
        return $nombre;
    } else {
        return false;
    }
}

/*
//Funcion que imprime el formulario
//$nombre es el valor que tiene el campo nombre_fichero
//$a es el posible error del campo nombre_fichero
//$b es el posible error del campo fichero_usuario
*/
function imprimirFormulario($nombre, $a, $b)
{
    $nombreFicherForm = getCadena('NombreFicheroForm');
    $ficheroForm = getCadena('FicheroForm');
    $subirFichero = getCadena('SubirFichero');
    echo <<< END
            <form action="#" method="POST" enctype="multipart/form-data" id="uploadForm">
        <p>
            <label for="nombre_fichero">$nombreFicherForm</label>
            <input type="text" name="nombre_fichero" id="nombre_fichero" value="$nombre"></br>
            <p class="error">$a</p>      
        </p> 
        <p>
            <label for="fichero_usuario">$ficheroForm</label>
            <input type="file" name="fichero_usuario" id="fichero_usuario" ></br>
            <p class="error">$b</p>
        </p>
        <input type="submit" value="$subirFichero">
        </form>
       END; 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style/subir.css?1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <ul id="navigation">
            <li id="logo">MiniCloud</li>
            <li><a href="index.php?idioma=<?= $idioma ?>"><?= getCadena('nav1') ?></a> </li>
            <li><a href="subir.php?idioma=<?= $idioma ?>" style="color: black; background-color: whitesmoke;"><?= getCadena('nav2') ?></a></li>
            <li><a href="cloud.php?idioma=<?= $idioma ?>"><?= getCadena('nav3') ?></a></li>
        </ul>

        <form action="#" method="GET" id="lang">
            <select name="idioma" id="selectLang">
                <option value="es" <?php if ($idioma == 'es') {
                                        echo 'selected';
                                    } ?>>Español</option>
                <option value="en" <?php if ($idioma == 'en') {
                                        echo 'selected';
                                    } ?>>English</option>
            </select>
            <input type="submit" value="Ok" id="OK">
        </form>


    </header>
    <main>

        <h1><?= getCadena('cabezeraSubir') ?></h1>

        <?php
        //si no hay post imprime el formulario
        if (!$_POST) {
            imprimirFormulario("", "", "");
        } else {
            //Cadenas de idioma.php
            $ficheroNoSubido = getCadena('ficheroNoSubido');
            $ficheroVacio = getCadena('ficheroVacio');
            $nombreInvalido = getCadena('nombreInvalido');
            $exensionInvalida = getCadena('ExensionInvalida');
            $ficheroValido = getCadena('FicheroValido');
            $subirOtroFichero = getCadena('SubirOtroFichero');
            $nombreExistente = getCadena('nombreExistente');

            //datos saneados
            $nombreFicheroSaneado = htmlspecialchars(trim($_POST['nombre_fichero']));

            //los datos saneados se pasan a un array
            $datosSaneados = [
                'nombre_fichero' => $nombreFicheroSaneado,
            ];

            //filtros
            $filtros = array(
                'nombre_fichero' => array(
                    'filter' => FILTER_CALLBACK,
                    'options' =>  'validarNombre'
                )
            );

            $validacion = filter_var_array($datosSaneados, $filtros);

            //si hay $_FILES , esta el campo fichero_usuario,
            // no hay error, el fichero tiene un tamaño mayor que 0
            // y el nombre del fichero ha pasado la validacion
            if ($_FILES && isset($_FILES['fichero_usuario']) &&
                $_FILES['fichero_usuario']['error'] === UPLOAD_ERR_OK &&
                $_FILES['fichero_usuario']['size'] > 0 
                && $validacion['nombre_fichero'] == true){
                    //booleano para saber si el fichero se puede subir o no
                    $valido = true;
                    //fichero que le pasamos al formulario
                    $fichero = $_FILES['fichero_usuario']['name'];
                     //extension del fichero
                    $extension = pathinfo($fichero, PATHINFO_EXTENSION);
                    //ruta en la que se va a guardar el fichero ya con el nombre que le hemos pasado
                    $rutaFicheroDestino = 'ficheros/' . basename($nombreFicheroSaneado . "." . pathinfo($fichero, PATHINFO_EXTENSION));
                    //extensiones permitidas
                    $permitido = array('gif', 'png', 'jpeg', 'jpg', 'pdf');
                    
                    //si la extension no esta permitida, valido pasa a ser false
                    if(!in_array($extension, $permitido)){
                        imprimirFormulario($nombreFicheroSaneado, "", ".$extension $exensionInvalida");
                        $valido=false;
                    }
                    //si el nombre del fichero ya existe, valido pasa a ser false
                    if(file_exists($rutaFicheroDestino)){
                        imprimirFormulario($nombreFicheroSaneado, "$nombreExistente", "");
                        $valido=false;
                    }
                    //si $valido es true el fichero se sube al directorio
                    if ($valido==true) { 
                        $seHaSubido = move_uploaded_file($_FILES['fichero_usuario']['tmp_name'], $rutaFicheroDestino);
                        echo "<p>$rutaFicheroDestino $ficheroValido</p><br>";
                        echo "<a id='subirOtroFichero' href='subir.php?idioma=$idioma'>$subirOtroFichero</a>";   
                    } else {
                        //si no se ha subido el fichero, lo indica
                        echo "<p class='error'>$ficheroNoSubido</p>";
                    }
                }else{
                    //Señalizacion de los errores
                    //si hay un error con el fichero y su nombre, se indican los dos errores
                    if($validacion['nombre_fichero'] == false && (!$_FILES['fichero_usuario']['size'] > 0  || !$_FILES['fichero_usuario']['error'] === UPLOAD_ERR_OK)){
                        imprimirFormulario($nombreFicheroSaneado, $nombreInvalido, $ficheroVacio);
                        echo "<p class='error'>$ficheroNoSubido</p>";
                    }else{
                        //si solo hay un error con el fichero se indica
                        if(!$_FILES['fichero_usuario']['size'] > 0  || !$_FILES['fichero_usuario']['error'] === UPLOAD_ERR_OK ){
                            imprimirFormulario($nombreFicheroSaneado, "", $ficheroVacio);
                            echo "<p class='error'>$ficheroNoSubido</p>";
                        }
                        //si solo hay un error con el nombre se indica
                        if($validacion['nombre_fichero'] == false){
                            imprimirFormulario($nombreFicheroSaneado, $nombreInvalido, "");
                            echo "<p class='error'>$ficheroNoSubido</p>";
                        }
                    }
                }
        }
        ?>
    </main>
    <footer>
        @2022 DWES, inc.
    </footer>
</body>

</html>