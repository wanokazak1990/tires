<?php

namespace App\Http\Controllers;
use Session;
use Cart;
use Mail;
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
        
        $cart = Cart::getCart();
        $messages = [
          'required' => "Field :attribute is required",
          'email' => "Field :attribute must be an email"  
        ];
        $this->validate($request, [
            'name' => 'required|max:255',
            'mail' => 'required|email',
            'phone' => 'required'
        ], $messages);

        $data = $request->all();

        $to= "Mary <wanokazak@gmail.com>";

        /* тема/subject */
        $subject = "Новый заказ";

        /* сообщение */
        $message = '';
        foreach ($cart as $key => $value) {
            $message.=$value->name.' '.$value->count.'штук '.$value->price;
        }

        /* Для отправки HTML-почты вы можете установить шапку Content-type. */
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

        /* дополнительные шапки */
        $headers .= "From: ORDER <birthday@example.com>\r\n";
        $headers .= "Cc: birthdayarchive@example.com\r\n";
        $headers .= "Bcc: birthdaycheck@example.com\r\n";

        /* и теперь отправим из */
        echo mail($to, $subject, $message, $headers);
    }
}
