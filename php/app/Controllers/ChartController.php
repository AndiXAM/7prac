<?php
require __DIR__ . '/../../../vendor/autoload.php';

use CpChart\Data;
use CpChart\Image;

class ChartController {
    private $model;

    public function __construct() {
        require_once ROOT_PATH . '/app/models/ProductModel.php'; 
        
        $this->model = new ProductModel('fixtures.json');
    }

    public function generateChart() {
        
        $productNames = $this->model->getProductNames();
        $prices = $this->model->getPrices();

       
        $data = new Data();
        $data->addPoints($prices, "Prices");
        $data->addPoints($productNames, "Labels");
        $data->setAbscissa("Labels");

        $image = new Image(700, 230, $data);
        $image->setGraphArea(60, 40, 680, 200);
        $image->drawScale();
        $image->drawLineChart();

        
        $imagePath = 'chart.png'; 

       
        if (!is_dir(dirname($imagePath))) {
            mkdir(dirname($imagePath), 0755, true); 
        }

        
        if ($image->render($imagePath) === false) {
            die('Ошибка при сохранении изображения: ' . error_get_last()['message']);
        }
    }

    public function displayChart() {
        include __DIR__ . '/../views/chart_view.php';
    }
}