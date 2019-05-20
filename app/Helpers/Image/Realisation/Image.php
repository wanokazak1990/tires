<?php
namespace App\Helpers\Image\Realisation;

use File;
use Storage;

Class Image
{
	public $image_type;
	public $image;
	public $path;

	public function url($img)
	{
		if(Storage::disk()->exists($img))
			return Storage::url($img);
		else
			return ;
	}

	function load($filename) {
		
		$url = Storage::disk()->url($filename);
        $this->path = public_path($url); 

		$image_info = getimagesize($this->path);
		$this->image_type = $image_info[2];

		if( $this->image_type == IMAGETYPE_JPEG ) {
			$this->image = imagecreatefromjpeg($this->path);
		} 
		elseif( $this->image_type == IMAGETYPE_GIF ) {
			$this->image = imagecreatefromgif($this->path);
		} 
		elseif( $this->image_type == IMAGETYPE_PNG ) {
			$this->image = imagecreatefrompng($this->path);
		}

		return $this;
   	}

	function save($filename, $image_type=IMAGETYPE_JPEG, $compression=75, $permissions=null) {
		if( $image_type == IMAGETYPE_JPEG ) {
			imagejpeg($this->image,$this->path,$compression);
		}
		elseif( $image_type == IMAGETYPE_GIF ) {
			imagegif($this->image,$this->path);
		} 
		elseif( $image_type == IMAGETYPE_PNG ) {
			imagepng($this->image,$this->path);
		}
		if( $permissions != null) {
			chmod($this->path,$permissions);
		}
	}

   	function getWidth() {
		return imagesx($this->image);
	}
	function getHeight() {
		return imagesy($this->image);
	}
	function resizeToHeight($height) {
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}
	function resizeToWidth($width) {
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
	}
	function scale($scale) {
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resize($width,$height);
	}
	function resize($width,$height) {
		$new_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
		$this->image = $new_image;
	}

	public function editImgByWidth($filename,$size)
	{
		$this->load($filename);
		$this->resizeToWidth($size);
		$this->save($filename);
	}
}