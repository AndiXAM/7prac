<?php

class ImageModel {
    public function addWatermark($originalImagePath, $watermarkImagePath, $outputImagePath) {
        $originalImage = imagecreatefrompng($originalImagePath);
        $watermarkImage = imagecreatefrompng($watermarkImagePath);

        // размеры изображений
        $originalWidth = imagesx($originalImage);
        $originalHeight = imagesy($originalImage);
        $watermarkWidth = imagesx($watermarkImage);
        $watermarkHeight = imagesy($watermarkImage);

        $xPosition = ($originalWidth - $watermarkWidth) / 2; // Центр по горизонтали
        $yPosition = ($originalHeight - $watermarkHeight) / 2; // Центр по вертикали

        $transparentWatermark = imagecreatetruecolor($watermarkWidth, $watermarkHeight);

       
        imagealphablending($transparentWatermark, false);
        imagesavealpha($transparentWatermark, true);
        $transparentColor = imagecolorallocatealpha($transparentWatermark, 255, 255, 255, 127); // Полностью прозрачный цвет
        imagefill($transparentWatermark, 0, 0, $transparentColor);

        
        imagealphablending($watermarkImage, true);
        imagesavealpha($watermarkImage, true);
        imagecopyresampled($transparentWatermark, $watermarkImage, 0, 0, 0, 0, $watermarkWidth, $watermarkHeight, $watermarkWidth, $watermarkHeight);

        
        imagealphablending($transparentWatermark, true);
        imagecopy($originalImage, $transparentWatermark, $xPosition, $yPosition, 0, 0, $watermarkWidth, $watermarkHeight);

        
        imagepng($originalImage, $outputImagePath);

       
        imagedestroy($originalImage);
        imagedestroy($watermarkImage);
        imagedestroy($transparentWatermark);
    }
}