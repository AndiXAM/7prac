<?php

define('ROOT_PATH', dirname(__DIR__));


$requestUri = $_SERVER['REQUEST_URI'];


$requestUri = strtok($requestUri, '?');

switch ($requestUri) {
    case '/public/':
        require_once ROOT_PATH . '/app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;

    case '/public/generate_fixtures': 
        require_once ROOT_PATH . '/app/controllers/FixtureController.php';
        $controller = new FixtureController();
        $fixtures = $controller->generate(); 
        $controller->displayFixtures(); 
        break;

    case '/public/generate_chart': 
        require_once ROOT_PATH . '/app/controllers/ChartController.php';
        $controller = new ChartController();
        $controller->generateChart();
        $controller->displayChart();    
        break;


    case '/public/process_image': 
        require_once ROOT_PATH . '/app/controllers/ImageController.php';
        $controller = new ImageController();
        $controller->processImage(); 
        break;
        

    default:
        
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
        echo $requestUri;
        break;
}