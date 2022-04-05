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

        $request->validate([
            'order_id'=>'required',
            'type_owner'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);

        $orderId = $request->order_id;
        $type_owner = $request->type_owner;
        $email = $request->email;
        $phone = $request->phone;

        if ($type_owner == '1') {
            $name = $request->last_name . ' ' . $request->first_name . ' ' . $request->patronymic;
        } else {
            $name = $request->org_name;
        }

        $clientId = env('YK_ID_TEST');
        $clientSecret = env('YK_KEY_TEST');

        $client = new Client();
        $client->setAuth($clientId, $clientSecret);

        $payment = $client->createPayment([
            'amount' => [
                'value' => env('PRICE'),
                'currency' => 'RUB',
            ],
            'description' => 'Заказ #' . $orderId . '. Оформление ЭПТС.',
            'capture' => false,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('pay.callback'),
            ],
            'metadata' => [
                'order_id' => $orderId,
            ],
            'receipt' => [
                'customer' => [
                    'full_name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                ],
                'items' => [
                    [
                        'description' => 'Заказ #' . $orderId . '. Оформление ЭПТС.',
                        'quantity' => '1.00',
                        'amount' => [
                            'value' => 5000,
                            'currency' => 'RUB'
                        ],
                        'vat_code' => '3',
                    ]
                ]
            ]
        ], uniqid('', true));

        return response()->json([
            'status' => true,
            'url' => $payment->getConfirmation()->getConfirmationUrl()
        ]);

    }


    public function payCallback(Request $request)
    {
        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return redirect('https://reg.gospts.ru/#/finish');
    }
}
