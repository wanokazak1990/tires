<?php
namespace App\Helpers\Image;
use Illuminate\Support\Facades\Facade;

Class ImageFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Image';
	}
}