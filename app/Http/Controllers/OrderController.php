<?php

namespace App\Http\Controllers;


use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::all()->sortDesc();


        return view('dashboard', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        header('Access-Control-Allow-Origin', '*');
//        header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
//        header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        $request->validate([
            'type_owner' => 'required'
        ]);

        if ($request->type_owner == '1') {
            $request->validate([
                'last_name' => 'required',
                'first_name' => 'required',
                'patronymic' => 'required',
                'city' => 'required',
                'street' => 'required',
                'home' => 'required',
                'flat' => 'required',

                'pass_serial' => 'required',
                'pass_number' => 'required',

                'inn' => 'required',
                'snils' => 'required',

                'phone' => 'required',
                'email' => 'required|email',

                'car_mark' => 'required',
                'commercial_name' => 'required',
                'car_type' => 'required',
                'car_id' => 'required',
                'car_color' => 'required',
                'drive_ts' => 'required',
                'engine_model' => 'required',
                'engine_number' => 'required',
                'engine_power' => 'required',
                'engine_volume' => 'required',
                'fuel' => 'required',

                'sts_front' => 'required|file|image',
                'sts_back' => 'required|file|image',
                'ts_front' => 'required|file|image',
                'ts_back' => 'required|file|image',
                'ts_right' => 'required|file|image',
                'ts_left' => 'required|file|image',
                'vin_door' => 'required|file|image',
                'vin_glass' => 'required|file|image',

                'price' => 'required',
                'pay_method' => 'required',
                'pay_success' => 'required',
            ]);

            $sts_front = $request->sts_front->store('uploads', 'public_html');
            $sts_back = $request->sts_back->store('uploads', 'public_html');
            $ts_front = $request->ts_front->store('uploads', 'public_html');
            $ts_back = $request->ts_back->store('uploads', 'public_html');
            $ts_right = $request->ts_right->store('uploads', 'public_html');
            $ts_left = $request->ts_left->store('uploads', 'public_html');
            $vin_door = $request->vin_door->store('uploads', 'public_html');
            $vin_glass = $request->vin_glass->store('uploads', 'public_html');

            $order = Order::create([
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'patronymic' => $request->patronymic,
                'city' => $request->city,
                'street' => $request->street,
                'home' => $request->home,
                'flat' => $request->flat,

                'pass_serial' => $request->pass_serial,
                'pass_number' => $request->pass_number,

                'inn' => $request->inn,
                'snils' => $request->snils,

                'phone' => $request->phone,
                'email' => $request->email,

                'car_mark' => $request->car_mark,
                'commercial_name' => $request->commercial_name,
                'car_type' => $request->car_type,
                'car_id' => $request->car_id,
                'car_color' => $request->car_color,
                'drive_ts' => $request->drive_ts,
                'engine_model' => $request->engine_model,
                'engine_number' => $request->engine_number,
                'engine_power' => $request->engine_power,
                'engine_volume' => $request->engine_volume,
                'fuel' => $request->fuel,

                'price' => $request->price,
                'pay_method' => $request->pay_method,
            ]);

            $order->image()->create([
                'sts_front' => $sts_front,
                'sts_back' => $sts_back,
                'ts_front' => $ts_front,
                'ts_back' => $ts_back,
                'ts_right' => $ts_right,
                'ts_left' => $ts_left,
                'vin_door' => $vin_door,
                'vin_glass' => $vin_glass,
            ]);

            $this->sendSms($order->id, $request->phone);

            return response()->json([
                'status' => 'success',
                'message' => 'Данные физ. лица успешно сохранены',
                'order_id' => $order->id
            ]);
        } else if ($request->type_owner == '2') {
            $request->validate([
                'type_owner' => 'required',
                'org_name' => 'required',
                'inn' => 'required',
                'kpp' => 'required',
                'ogrn' => 'required',
                'city' => 'required',
                'street' => 'required',
                'home' => 'required',
                'flat' => 'required',
                'phone' => 'required',
                'email' => 'required',

                'car_mark' => 'required',
                'commercial_name' => 'required',
                'car_type' => 'required',
                'car_id' => 'required',
                'car_color' => 'required',
                'drive_ts' => 'required',
                'engine_model' => 'required',
                'engine_number' => 'required',
                'engine_power' => 'required',
                'engine_volume' => 'required',
                'fuel' => 'required',

                'sts_front' => 'required|file|image',
                'sts_back' => 'required|file|image',
                'ts_front' => 'required|file|image',
                'ts_back' => 'required|file|image',
                'ts_right' => 'required|file|image',
                'ts_left' => 'required|file|image',
                'vin_door' => 'required|file|image',
                'vin_glass' => 'required|file|image',

                'price' => 'required',
                'pay_method' => 'required',
                'pay_success' => 'required',
            ]);

            $sts_front = $request->sts_front->store('uploads', 'public');
            $sts_back = $request->sts_back->store('uploads', 'public');
            $ts_front = $request->ts_front->store('uploads', 'public');
            $ts_back = $request->ts_back->store('uploads', 'public');
            $ts_right = $request->ts_right->store('uploads', 'public');
            $ts_left = $request->ts_left->store('uploads', 'public');
            $vin_door = $request->vin_door->store('uploads', 'public');
            $vin_glass = $request->vin_glass->store('uploads', 'public');


            $order = Order::create([
                'type_owner' => $request->type_owner,
                'org_name' => $request->org_name,
                'inn' => $request->inn,
                'kpp' => $request->kpp,
                'ogrn' => $request->ogrn,
                'city' => $request->city,
                'street' => $request->street,
                'home' => $request->home,
                'flat' => $request->flat,
                'phone' => $request->phone,
                'email' => $request->email,

                'car_mark' => $request->car_mark,
                'commercial_name' => $request->commercial_name,
                'car_type' => $request->car_type,
                'car_id' => $request->car_id,
                'car_color' => $request->car_color,
                'drive_ts' => $request->drive_ts,
                'engine_model' => $request->engine_model,
                'engine_number' => $request->engine_number,
                'engine_power' => $request->engine_power,
                'engine_volume' => $request->engine_volume,
                'fuel' => $request->fuel,

                'price' => $request->price,
                'pay_method' => $request->pay_method,
            ]);

            $order->image()->create([
                'sts_front' => $sts_front,
                'sts_back' => $sts_back,
                'ts_front' => $ts_front,
                'ts_back' => $ts_back,
                'ts_right' => $ts_right,
                'ts_left' => $ts_left,
                'vin_door' => $vin_door,
                'vin_glass' => $vin_glass,
            ]);

            $this->sendSms($order->id, $request->phone);

            return response()->json([
                'status' => 'success',
                'message' => 'Данные юр. лица успешно сохранены',
                'order_id' => $order->id
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if ($order->type_owner == '1') {
            $order->type_owner = 'Физическое лицо';
        } else {
            $order->type_owner = 'Юридическое лицо';
        }


        $order->address = $order->city . ', ' . $order->street . ', дом ' . $order->home . ', кв ' . $order->flat;


        return view('order', ['order' => $order]);
    }

    public function sendSms($order_id, $phone)
    {
        //telegram
        $url = 'https://api.telegram.org/bot';
        $t_token = '5129667492:AAEXJgEpqZIko4nAEk_kziAX9xlB98l8iKg';
        $chatid = '-1001734882908';
        $data = [
            'chat_id' => $chatid,
            'text' => 'Новая заявка на ПТС #' . $order_id . ', телефон клиента ' . $phone,
        ];
        file_get_contents($url . $t_token . "/sendMessage?" . http_build_query($data));

        //WhatsApp
        $messagewa = 'Спасибо! Ваша заявка на регистрацию ЭПТС принята. Номер заявки #' . $order_id;
        $w_token = 'YbUz0Z3mQnwMDd055a356297b3008a5cde8d204b079e6';
        $array = [
            [
                'chatId' => $this->phonewa_format($phone),
                'message' => $messagewa,
            ]
        ];

        $headers = ['Content-type' => 'application/json; charset=utf-8'];

        $client = new Client();
        $response = $client->request('POST', 'https://app.api-messenger.com/sendmessage?token=' . $w_token,
            ['headers' => $headers, 'json' => json_encode($array)]);
        $data = $response->getBody();
        Log::Info($data);
    }

    public function phonewa_format($phone)
    {
        $phone = trim($phone);
        $res = preg_replace(
            array(
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
            ),
            array(
                '7$2$3$4$5',
                '7$2$3$4$5',
                '7$2$3$4$5',
                '7$2$3$4$5',
                '7$2$3$4',
                '7$2$3$4',
            ),
            $phone
        );
        return $res;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|min:0|max:2'
        ]);

        Order::where('id', $id)->update([
            'status' => $request->status
        ]);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
