<?php

class ImageController {
    private $model;

    public function __construct() {
        
        require_once ROOT_PATH . '/app/models/ImageModel.php';
        $this->model = new ImageModel();
    }

    public function processImage() {
        
        $originalImagePath = 'chart.png'; 
        $watermarkImagePath = 'watermark4.png'; 
        $outputImagePath = 'image2waterr.png'; 

        
        $this->model->addWatermark($originalImagePath, $watermarkImagePath, $outputImagePath);

       
        include __DIR__ . '/../views/image_view.php';
    }
}