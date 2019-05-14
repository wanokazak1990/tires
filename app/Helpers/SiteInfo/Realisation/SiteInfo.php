<?php
namespace App\Helpers\SiteInfo\Realisation;

use Session;
use App\hm_info as info;

Class SiteInfo
{
	public function test()
	{
		return 'test USPESHEN';
	}

	public function checkInfo()
	{
		if (!Session::has('info'))
		{
			$info = info::first();

			if (count($info) != 0)
				Session::put('info', $info);
			else
				Session::put('info', new info());
		}
	}

	public function getInfo()
	{
		return Session::get('info');
	}
}