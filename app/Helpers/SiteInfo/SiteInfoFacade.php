<?php
namespace App\Helpers\SiteInfo;
use Illuminate\Support\Facades\Facade;

Class SiteInfoFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'SiteInfo';
	}
}