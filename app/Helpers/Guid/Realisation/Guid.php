<?php
namespace App\Helpers\Guid\Realisation;

use File;
use Storage;

Class Guid{
	
	private $count;
	public $guids = [];

	private function makeGuid()
	{
		mt_srand( (double)microtime() * 10000 );
        $charid = strtoupper( md5(uniqid(rand(), true)) );
        $hyphen = chr( 45 );
        $uuid = 
            substr( $charid, 0, 8 ) . $hyphen
            . substr( $charid, 8, 4 ) . $hyphen
            . substr( $charid, 12, 4 ) . $hyphen
            . substr( $charid, 16, 4 ) . $hyphen
            . substr( $charid, 20, 12 );
        $this->guids[] = $uuid;
        $this->writeLog();
	}

	public function getGuid($data)
	{
		$this->count = $data;
		for($i=1;$i<=$this->count;$i++)
		{
			$this->makeGuid();
		}
		return $this->guids;
	}

	private function writeLog()
	{
		$date = date('d.m.Y h:m');
		Storage::disk()->append('/public/tz/file.log', $date.'     '.request()->ip().'     '.end($this->guids));
	}
}