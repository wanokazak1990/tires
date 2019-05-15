<?php
namespace App\Helpers\Image\Realisation;

use File;
use Storage;

Class Image
{
	public function url($img)
	{
		if(Storage::disk()->exists($img))
			return Storage::url($img);
		else
			return ;
	}
}