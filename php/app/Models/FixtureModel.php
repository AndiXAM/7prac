<?php
require __DIR__ . '/../../../vendor/autoload.php';
use Faker\Factory;

class FixtureModel {
    private $fixtures;

    public function generateFixtures($count = 10) {
        $faker = Factory::create();
        $this->fixtures = [];

        // Генерация фикстур
        for ($i = 0; $i < $count; $i++) {
            $this->fixtures[] = [
                'product_name' => $faker->word . ' ' . $faker->word,
                'price' => $faker->randomFloat(2, 1, 100),
                'category' => $faker->word,
                'stock' => $faker->numberBetween(0, 100),
                'description' => $faker->sentence(10),
            ];
        }

       
        $filePath =  'fixtures.json';

        
        if (!file_exists($filePath)) {
            
            file_put_contents($filePath, json_encode([], JSON_PRETTY_PRINT));
        }

        
        if (file_put_contents($filePath, json_encode($this->fixtures, JSON_PRETTY_PRINT)) === false) {
            die('Ошибка при записи в файл: ' . error_get_last()['message']);
        }

        return $this->fixtures;
    }

    public function getFixtures() {
        return $this->fixtures;
    }
}