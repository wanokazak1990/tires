<?php
namespace App\Helpers\Messandger;
use Illuminate\Support\Facades\Facade;

Class MessandgerFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Messandger';
	}
}