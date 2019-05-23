<?php
namespace App\Helpers\Messandger\Realisation;
use App\hm_info as info;

Class Messandger
{
	public $token;
	public $chat;
	public $proxy;

	public function __construct($type = 'telegram')
	{
		switch ($type){
			case 'telegram':
				$option = info::select('tg_token','tg_chat','tg_proxy')->first();
				$this->token = $option->tg_token;
				$this->chat = $option->tg_chat;
				$this->proxy = $option->tg_proxy;
				break;

			default:
				return false;
		}		
	}

	private function telegram($message)
	{
		if (function_exists('curl_init')) 
		{
	        $ch = curl_init();
	        curl_setopt_array(
	            $ch,
	            array(
	                CURLOPT_URL => 'https://api.telegram.org/bot' . $this->token . '/sendMessage',
	                CURLOPT_POST => TRUE,
	                CURLOPT_RETURNTRANSFER => TRUE,
	                CURLOPT_TIMEOUT => 10,
	                CURLOPT_POSTFIELDS => array(
	                    'chat_id' => $this->chat,
	                    'text' => $message,
	                ),
	                CURLOPT_PROXY => $this->proxy,
	                CURLOPT_PROXYUSERPWD => 'sensey:sensey',
	                CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
	                CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
	            )
	        );
	        curl_exec($ch);
	    }
	    else 
	    {
	    		
	    }
	}

	public function serviceMsg($data)
	{
		$str = '';
		if(is_array($data))
		{
			$str .= 'Клиент хочет записаться на сервис.';
			$str .= "Имя клиента: {$data['name']}; тел.: {$data['phone']}; время записи: {$data['date']} : {$data['time']}; комметнарий: {$data['comment']}";
		}
		else
			$str = $data;
		$this->telegram($str);
	}

	public function orderMsg($data)
	{
		if(is_string($data))
			$this->telegram($data);
	}
}