<?php

$idioma = 'es';

if ($_GET && isset($_GET['idioma'])) {
    $idioma = in_array($_GET['idioma'], ['es', 'en']) ? $_GET['idioma'] : 'es';
}

$cadenas = [
    'nav1' => [
        'es' => 'Inicio',
        'en' => 'Home'
    ],
    'nav2' => [
        'es' => 'Subir',
        'en' => 'Upload'
    ],
    'nav3' => [
        'es' => 'Ficheros',
        'en' => 'Files'
    ],
    'bienvenida' => [
        'es' => 'Bienvenid@ a MiniMyCloud',
        'en' => 'Welcome to MiniMyCloud'
    ],
    'parrafo1' => [
        'es' => 'Desde aquí puedes administrar tus ficheros.',
        'en' => 'From here you can manage your files.'
    ],
    'boton1' => [
        'es' => 'Empieza a subir ficheros.',
        'en' => 'Start uploading files.'
    ],
    'cabezeraSubir' => [
        'es' => 'Sube ficheros PDF o imágenes GIF, PNG y JPEG.',
        'en' => 'Upload PDF files or GIF, PNG and JPEG images.'
    ],
    'NombreFicheroForm' => [
        'es' => 'Nombre del fichero:',
        'en' => 'File name:'
    ],
    'FicheroForm' => [
        'es' => 'Selecciona un fichero:',
        'en' => 'Select a file:'
    ],
    'Examinar' => [
        'es' => 'Examinar.',
        'en' => 'Search.'
    ],
    'SubirFichero' => [
        'es' => 'Subir fichero.',
        'en' => 'Upload file.'
    ],
    'nombreInvalido' => [
        'es' => 'Error: Nombre de fichero invalido.',
        'en' => 'Error: Invalid file name.'
    ],
    'ExensionInvalida' => [
        'es' => 'No es una extensión permitida.',
        'en' => 'Is not an allowed extension.'
    ],
    'FicheroValido' => [
        'es' => 'Subido correctamente.',
        'en' => 'Uploaded successfully.'
    ],
    'SubirOtroFichero' => [
        'es' => 'Subir otro fichero.',
        'en' => 'Upload another file.'
    ],
    'ficheroVacio' => [
        'es' => 'Error: No hay ningun fichero seleccionado.',
        'en' => 'Error: There is no selected file.'
    ],
    'ficheroNoSubido' => [
        'es' => 'El fichero no ha sido subido.',
        'en' => 'The file has not been uploaded.'
    ],
    'tusFicheros' => [
        'es' => 'Tus ficheros:',
        'en' => 'Your files:'
    ],
    'tusFotos' => [
        'es' => 'Tus fotos:',
        'en' => 'Your photos:'
    ],
    'nombreExistente' => [
        'es' => 'Error: el nombre del fichero ya existe',
        'en' => 'Error: the name of the file already exists.'
    ],
    'sinImagenes' => [
        'es' => 'No hay imagenes subidas.',
        'en' => 'No images uploaded.'
    ],
    'sinPdf' => [
        'es' => 'No hay PDFs subidos.',
        'en' => 'No PDFs uploaded.',
    ]


];

function getCadena(string $id): string
{
    global $idioma, $cadenas;

    if (isset($cadenas[$id])) {
        return $cadenas[$id][$idioma];
    } else {
        return "Error interno: la cadena identificada con $id no existe";
    }
}
