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

			if (isset($info->id))
				Session::put('info', $info);
			else
				Session::put('info', new info());
		}
	}

	public function getInfo()
	{
		return Session::get('info');
	}

	public function refresh()
	{
		Session::forget('info');
	}
}