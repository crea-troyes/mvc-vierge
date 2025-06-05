<?php
spl_autoload_register(function ($class) {
    // On remplace le début du namespace par le chemin
    $class = str_replace('App\\', 'app/', $class);

    // On remplace les antislashs par des slashs
    $class = str_replace('\\', '/', $class);

    // On construit le chemin complet du fichier
    $file = __DIR__ . '/' . $class . '.php';

    // Si le fichier existe, on l’inclut
    if (file_exists($file)) {
        require_once $file;
    } else {
        echo "Fichier introuvable : $file";
    }
});