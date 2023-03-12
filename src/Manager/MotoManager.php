<?php
namespace App\Manager;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class MotoManager {
                    // Tipamos los argumentos.
    public function load ( UploadedFile $file, string $target) {
                // Para saber la extension de el fichero que vamos a subir.
        $fileName = uniqid().'.'.$file-> guessClientExtension();
        $file -> move($target, $fileName);
        return $fileName;
    }
}

// Lo que hace la funcion load es calcular el nombre que queremos dar a el fichero, lo mueve y devulve el nombre que hemos generado. 