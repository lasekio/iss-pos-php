<?php

use Controller\IssPositionController;

spl_autoload_register(function ($class_name) {
    include 'src/' . str_replace('\\', '/', $class_name) . '.php';
});

$controller = new IssPositionController(
    new \Repository\RestSatellitePositionRepository(),
    new \Services\GoogleHumanReadableSatellitePositionProvider('AIzaSyBs5InPxoz80zGJYyXch9rfg3Q2L4iQQF4')
);

echo $controller->showAction();