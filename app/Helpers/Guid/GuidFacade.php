<?php
namespace App\Helpers\Guid;
use Illuminate\Support\Facades\Facade;

Class GuidFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'Guid';
	}
}