<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use YooKassa\Client;
use YooKassa\Model\Notification\NotificationSucceeded;
use YooKassa\Model\Notification\NotificationWaitingForCapture;
use YooKassa\Model\NotificationEventType;

class PaymentController extends Controller
{
    public function payCreate(Request $request)
    {
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
            'description' => 'Оформление ЭПТС. Заказ №'.$orderId,
            'capture' => true,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => route('pay.callback'),
            ],
            'metadata' => [
                'order_id' => $orderId,
            ],
        ], uniqid('', true));

        return redirect( $payment->getConfirmation()->getConfirmationUrl() );

    }


    public function payCallback(Request $request)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);


        $notification = ($requestBody['event'] === NotificationEventType::PAYMENT_SUCCEEDED)
            ? new NotificationSucceeded($requestBody)
            : new NotificationWaitingForCapture($requestBody);
        $payment = $notification->getObject();


        if (isset($payment->status) && $payment->status==='succeeded') {
            if ($payment->paid === true) {
                info( json_encode($payment->object) );

                echo 'Успех #';
                echo $payment->metadata->order_id;

                 $order = Order::find($payment->metadata->order_id);
                    $order->pay_success = 1;
                    $order->save();
            }
        } else {
            echo 'Провал';
            # Запись ошибок в лог
            info( json_encode($request->object) );

            # Пример записи ответа в модель заказа
            // $order = Order::find($req->object['metadata']['order_id']);
            //    $order->payment = 'error';
            //    $order->payment_message = json_encode($req->object);
            //    $order->save();
        }

    }
}
