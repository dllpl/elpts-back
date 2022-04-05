<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationFactory;
use YooKassa\Model\NotificationEventType;

class PaymentController extends Controller
{
    public function payCreate(Request $request)
    {

        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        $orderId = $request->order_id;

        $clientId = env('YK_ID_TEST');
        $clientSecret = env('YK_KEY_TEST');

        $client = new Client();
        $client->setAuth($clientId, $clientSecret);

        $payment = $client->createPayment([
            'amount' => [
                'value' => env('PRICE'),
                'currency' => 'RUB',
            ],
            'description' => 'Оформление ЭПТС. Заказ №' . $orderId,
            'capture' => false,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('pay.callback'),
            ],
            'metadata' => [
                'order_id' => $orderId,
            ],
        ], uniqid('', true));

        return response()->json([
            'status'=>true,
            'url'=>$payment->getConfirmation()->getConfirmationUrl()
        ]);

    }


    public function payCallback(Request $request)
    {
        return redirect('https://reg.gospts.ru/#/finish');
    }
}
