<?php

class ProductModel {
    private $data;

    public function __construct($jsonFilePath) {
        $this->loadData($jsonFilePath);
    }

    private function loadData($jsonFilePath) {
        $jsonData = file_get_contents($jsonFilePath);
        $this->data = json_decode($jsonData, true);

        if ($this->data === null) {
            die('Ошибка при загрузке данных из ' . $jsonFilePath);
        }
    }

    public function getProductNames() {
        return array_column($this->data, 'product_name');
    }

    public function getPrices() {
        return array_column($this->data, 'price');
    }
}