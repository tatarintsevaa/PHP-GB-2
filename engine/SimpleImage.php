<?php
/*
* File: SimpleImage.php
* Author: Simon Jarvis
* Copyright: 2006 Simon Jarvis
* Date: 08/11/06
* Link: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details:
* http://www.gnu.org/licenses/gpl.html
*
*/
 namespace app\engine;
class SimpleImage {

   private $image;
   private $image_type;

   private function load($filename) {
      $image_info = getimagesize($filename);
      $this->image_type = $image_info[2];
      if( $this->image_type == IMAGETYPE_JPEG ) {
         $this->image = imagecreatefromjpeg($filename);
      } elseif( $this->image_type == IMAGETYPE_GIF ) {
         $this->image = imagecreatefromgif($filename);
      } elseif( $this->image_type == IMAGETYPE_PNG ) {
         $this->image = imagecreatefrompng($filename);
      }
   }
   private function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image,$filename,$compression);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image,$filename);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image,$filename);
      }
      if( $permissions != null) {
         chmod($filename,$permissions);
      }
   }
   private function output($image_type=IMAGETYPE_JPEG) {
      if( $image_type == IMAGETYPE_JPEG ) {
         imagejpeg($this->image);
      } elseif( $image_type == IMAGETYPE_GIF ) {
         imagegif($this->image);
      } elseif( $image_type == IMAGETYPE_PNG ) {
         imagepng($this->image);
      }
   }
   private function getWidth() {
      return imagesx($this->image);
   }
   private function getHeight() {
      return imagesy($this->image);
   }
   private function resizeToHeight($height) {
      $ratio = $height / $this->getHeight();
      $width = $this->getWidth() * $ratio;
      $this->resize($width,$height);
   }
   private function resizeToWidth($width) {
      $ratio = $width / $this->getWidth();
      $height = $this->getheight() * $ratio;
      $this->resize($width,$height);
   }
   private function scale($scale) {
      $width = $this->getWidth() * $scale/100;
      $height = $this->getheight() * $scale/100;
      $this->resize($width,$height);
   }
   private function resize($width,$height) {
      $new_image = imagecreatetruecolor($width, $height);
      imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
      $this->image = $new_image;
   }

    public function filesUpload() {
        if (empty($_FILES["newFile"]['tmp_name'])) {
            return "Файл не выбран";
        }
//        $path = ROOT_DIR . '/public/' . BIG_IMG_DIR . $_FILES["newFile"]["name"];
        $path = App::call()->config['big_image_dir'] . $_FILES["newFile"]["name"];
        $pathToMiddle = App::call()->config['middle_image_dir'] . $_FILES["newFile"]["name"];
//        $pathToSmall = ROOT_DIR . '/public/' . SMALL_IMG_DIR . $_FILES["newFile"]["name"];
        $pathToSmall = App::call()->config['small_image_dir'] . $_FILES["newFile"]["name"];
        $blacklist = array(".php", ".phtml", ".php3", ".php4");
        foreach ($blacklist as $item) {
            if(preg_match("/$item\$/i", $_FILES['newFile']['name'])) {
                return "Файлы PHP загружать запрещено\n";
            }
        }

        $imageInfo = getimagesize($_FILES['newFile']['tmp_name']);


        if($imageInfo['mime'] != 'image/gif' && $imageInfo['mime'] != 'image/jpeg' && $imageInfo['mime'] != 'image/png') {
            return "Извините, мы принимаем только файлы с форматами: jpeg, gif и png\n";
        }
        if(move_uploaded_file($_FILES["newFile"]["tmp_name"],$path)) {
//            $image = new SimpleImage();
            $this->load($path);
            $this->resizeToWidth(150);
            $this->save($pathToMiddle);
            $this->resizeToWidth(80);
            $this->save($pathToSmall);
            return $_FILES["newFile"]["name"];
        } else {
            return "Ошибка! Код ошибки - {$_FILES['newFile']['error']}";
        }
    }

    public function deleteImage($imageName) {
        unlink(App::call()->config['big_image_dir'] . $imageName);
        unlink(App::call()->config['middle_image_dir'] . $imageName);
        unlink(App::call()->config['small_image_dir'] . $imageName);
    }

}