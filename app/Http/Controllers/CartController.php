<?php

namespace App\Http\Controllers;
use Session;
use Cart;
use Mail;
use Validator;
use App\hm_client as client;
use App\hm_order as order;
use App\hm_order_product as oproduct;
use Messandger;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function append(Request $request)
    {
    	if($request->has('id'))
    	{
    		Cart::add($request->id);
    		echo Cart::moveToClient($request->id);
    	}
    }
    public function take(Request $request)
    {
    	if($request->has('id')){
    		Cart::take($request->id);    		
    		echo Cart::moveToClient($request->id);
    	}
    }
    public function remove(Request $request)
    {
    	if($request->has('id'))
    	{
    		Cart::remove($request->id);
    		echo Cart::moveToClient($request->id);
    	}
    }

    public function show(Request $request)
    {
        if($request->has('val'))
        {
            $res = Cart::getCartByParam($request->val);
            echo json_encode($res);
            return;
        }

    	$array = [
    		'cart'=>Cart::getCart(),
    		'total_price'=>Cart::totalPrice()
    	];
    	echo json_encode($array);
    }

    public function cartIndikator()
    {
        echo Cart::cartIndikator();
    }

    public function order(Request $request)
    {
        $messages = [
          'name.required'    => 'Вы не указали своё имя.',
          'phone.min:8' => 'Длина номера телефона должна быть больше 8 символов',
          'phone.required'    => 'Вы не указали свой телефон.',
          'mail.required' => 'Вы не указали свой e-mail',
          'mail.email' => 'Это не может быть адресом электронной почты',
          'personal.required'      => 'Вы не подтвердили согласие об обработке персональных данных.',
        ];

        $validator = Validator::make($request->all(),
            array(
                'name' => 'required',
                'phone' => 'required|min:8',
                'mail' => 'required|email',
                'personal'=>'required',
            ),
            $messages
        );

        if($validator->fails())
        {
            echo ($validator->messages());
            return;
        }

        $clientPhone = str_replace(array(' ', '(', ')', '-'), '', $request->phone);
        
        $client = client::where('phone', $clientPhone)->first();
        if(!isset($client->id))
        {
            $client = new client();
            $client->fill($request->all());
            $client->phone = $clientPhone;
            $client->save();
        }

        $cart = Cart::getCart();
        if(count($cart)<1)
        {
            echo json_encode(['error'=>['Корзина пуста']]);
            return;
        }

        $order = order::create([
            'client_id'=>$client->id,
            'status'=>1,
            'type'=>1
        ]);

        if(isset($order->id))
        {
            foreach ($cart as $key => $prod) {
                oproduct::create([
                    'order_id'=>$order->id,
                    'product_id'=>$prod->id,
                    'count'=>$prod->count,
                    'saleprice'=>$prod->price
                ]);
            }
        }

        Cart::clearCart();

        echo json_encode(['result'=>['Ваш заказ принят.']]);

        if(isset($order->id) && !(empty($order->id)))
            Messandger::orderMsg($order->created_at->format('d.m.Y').' новый заказ с сайта. Подробности в консоли сайта.');  
    }
}
