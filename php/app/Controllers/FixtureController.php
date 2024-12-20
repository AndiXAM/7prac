<?php

class FixtureController {
    private $model;

    public function __construct() {
        
        require_once ROOT_PATH . '/app/models/FixtureModel.php';
        $this->model = new FixtureModel();
    }

    public function generate() {
        return $this->model->generateFixtures(); 
    }

    public function displayFixtures() {
        
        $fixtures = $this->model->getFixtures();
        
        include __DIR__ . '/../views/fixtures.php'; 
    }
}