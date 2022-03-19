<?php

namespace App\Http\Controllers;


use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders= Order::all()->sortDesc();


        return view('dashboard', ['orders'=>$orders]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        header('Access-Control-Allow-Origin', '*');
        header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        $request->validate([
            'type_owner'=>'required'
        ]);

        if ($request->type_owner == '1') {
            $request->validate([
                'last_name'=>'required',
                'first_name'=>'required',
                'patronymic'=>'required',
                'city'=>'required',
                'street'=>'required',
                'home'=>'required',
                'flat'=>'required',

                'pass_serial'=>'required',
                'pass_number'=>'required',

                'inn'=>'required',
                'snils'=>'required',

                'phone'=>'required',
                'email'=>'required|email',

                'car_mark'=>'required',
                'commercial_name'=>'required',
                'car_type'=>'required',
                'car_id'=>'required',
                'car_color'=>'required',
                'drive_ts'=>'required',
                'engine_model'=>'required',
                'engine_number'=>'required',
                'engine_power'=>'required',
                'engine_volume'=>'required',
                'fuel'=>'required',

                'sts_front'=>'required|file|image',
                'sts_back'=>'required|file|image',
                'ts_front'=>'required|file|image',
                'ts_back'=>'required|file|image',
                'ts_right'=>'required|file|image',
                'ts_left'=>'required|file|image',
                'vin_door'=>'required|file|image',
                'vin_glass'=>'required|file|image',

                'price'=>'required',
                'pay_method'=>'required',
                'pay_success'=>'required',
            ]);

            $sts_front = $request->sts_front->store('uploads','public_html');
            $sts_back = $request->sts_back->store('uploads','public_html');
            $ts_front = $request->ts_front->store('uploads','public_html');
            $ts_back = $request->ts_back->store('uploads','public_html');
            $ts_right = $request->ts_right->store('uploads','public_html');
            $ts_left = $request->ts_left->store('uploads','public_html');
            $vin_door = $request->vin_door->store('uploads','public_html');
            $vin_glass = $request->vin_glass->store('uploads','public_html');

            $order = Order::create([
                'last_name'=>$request->last_name,
                'first_name'=>$request->first_name,
                'patronymic'=>$request->patronymic,
                'city'=>$request->city,
                'street'=>$request->street,
                'home'=>$request->home,
                'flat'=>$request->flat,

                'pass_serial'=>$request->pass_serial,
                'pass_number'=>$request->pass_number,

                'inn'=>$request->inn,
                'snils'=>$request->snils,

                'phone'=>$request->phone,
                'email'=>$request->email,

                'car_mark'=>$request->car_mark,
                'commercial_name' => $request->commercial_name,
                'car_type'=>$request->car_type,
                'car_id'=>$request->car_id,
                'car_color'=>$request->car_color,
                'drive_ts'=>$request->drive_ts,
                'engine_model'=>$request->engine_model,
                'engine_number'=>$request->engine_number,
                'engine_power'=>$request->engine_power,
                'engine_volume'=>$request->engine_volume,
                'fuel'=>$request->fuel,

                'price'=>$request->price,
                'pay_method'=>$request->pay_method,
            ]);

            $order->image()->create([
                'sts_front'=>$sts_front,
                'sts_back'=>$sts_back,
                'ts_front'=>$ts_front,
                'ts_back'=>$ts_back,
                'ts_right'=>$ts_right,
                'ts_left'=>$ts_left,
                'vin_door'=>$vin_door,
                'vin_glass'=>$vin_glass,
            ]);

             return response()->json([
                'status'=>'success',
                'message'=>'Данные физ. лица успешно сохранены'
             ]);
        } else if ($request->type_owner == '2'){
            $request->validate([
                'org_name'=>'required',
                'inn'=>'required',
                'kpp'=>'required',
                'ogrn'=>'required',
                'city'=>'required',
                'street'=>'required',
                'home'=>'required',
                'flat'=>'required',
                'phone'=>'required',
                'email'=>'required',

                'car_mark'=>'required',
                'commercial_name'=>'required',
                'car_type'=>'required',
                'car_id'=>'required',
                'car_color'=>'required',
                'drive_ts'=>'required',
                'engine_model'=>'required',
                'engine_number'=>'required',
                'engine_power'=>'required',
                'engine_volume'=>'required',
                'fuel'=>'required',

                'sts_front'=>'required|file|image',
                'sts_back'=>'required|file|image',
                'ts_front'=>'required|file|image',
                'ts_back'=>'required|file|image',
                'ts_right'=>'required|file|image',
                'ts_left'=>'required|file|image',
                'vin_door'=>'required|file|image',
                'vin_glass'=>'required|file|image',

                'price'=>'required',
                'pay_method'=>'required',
                'pay_success'=>'required',
            ]);

            $sts_front = $request->sts_front->store('uploads','public');
            $sts_back = $request->sts_back->store('uploads','public');
            $ts_front = $request->ts_front->store('uploads','public');
            $ts_back = $request->ts_back->store('uploads','public');
            $ts_right = $request->ts_right->store('uploads','public');
            $ts_left = $request->ts_left->store('uploads','public');
            $vin_door = $request->vin_door->store('uploads','public');
            $vin_glass = $request->vin_glass->store('uploads','public');


            $order = Order::create([
                'org_name'=>$request->org_name,
                'inn'=>$request->inn,
                'kpp'=>$request->kpp,
                'ogrn'=>$request->ogrn,
                'city'=>$request->city,
                'street'=>$request->street,
                'home'=>$request->home,
                'flat'=>$request->flat,
                'phone'=>$request->phone,
                'email'=>$request->email,

                'car_mark'=>$request->car_mark,
                'commercial_name' => $request->commercial_name,
                'car_type'=>$request->car_type,
                'car_id'=>$request->car_id,
                'car_color'=>$request->car_color,
                'drive_ts'=>$request->drive_ts,
                'engine_model'=>$request->engine_model,
                'engine_number'=>$request->engine_number,
                'engine_power'=>$request->engine_power,
                'engine_volume'=>$request->engine_volume,
                'fuel'=>$request->fuel,

                'price'=>$request->price,
                'pay_method'=>$request->pay_method,
            ]);

            $order->image()->create([
                'sts_front'=>$sts_front,
                'sts_back'=>$sts_back,
                'ts_front'=>$ts_front,
                'ts_back'=>$ts_back,
                'ts_right'=>$ts_right,
                'ts_left'=>$ts_left,
                'vin_door'=>$vin_door,
                'vin_glass'=>$vin_glass,
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'Данные юр. лица успешно сохранены'
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);

        if ($order->type_owner === 1) {
            $order->type_owner = 'Физическое лицо';
        } else {
            $order->type_owner = 'Юридическое лицо';
        }


        $order->address = $order->city.', '.$order->street.', дом '.$order->home.', кв '.$order->flat;


        return view('order',['order'=>$order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
           'status'=>'required|min:0|max:2'
        ]);

        Order::where('id',$id)->update([
            'status'=>$request->status
        ]);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
