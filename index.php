<?php

session_start();

require_once 'config/parameters.php';
require_once 'autoload.php';
require_once 'views/layouts/header.php';

require_once 'views/layouts/sidebar.php';


function show_error()
{
    $error = new ErrorController();
    $error->index();
}

if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $nombre_controlador = controller_default;
} else {
    show_error();
    echo "error 404 Pagina no encontrada";
    exit();
}

if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();

    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
        echo "error 404 pagina no encontrada ";
    }
} else {
    show_error();
    echo "error 404 pagina no encontrada";
}

require_once 'views/layouts/footer.php';
