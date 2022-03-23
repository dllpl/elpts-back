<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto">

            <!-- component -->
            <div class="overflow-x-auto">
                <div
                        class="min-w-screen min-h-screen bg-gray-100 flex justify-center bg-gray-100 font-sans overflow-hidden">
                    <div class="w-full lg:w-5/6">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ФИО/ИМЯ ОРГ.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        МАРКА
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ПОЧТА
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ТЕЛЕФОН
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        ДАТА
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        СТАТУС
                                    </th>
                                    <th scope="col" class="px-6 py-3">

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{$order->id}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">

                                            <div class="flex items-center">
                                                @if($order->type_owner === 1)
                                                    <span>{{$order->last_name}}&nbsp;{{$order->first_name}}&nbsp;</span>
                                                @else
                                                    <span>{{$order->org_name}}&nbsp;</span>
                                                @endif
                                            </div>

                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                {{$order->car_mark}}
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <a href="mailto:{{$order->email}}">
                                                    {{$order->email}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <a href="tel:{{$order->phone}}">
                                                    {{$order->phone}}
                                                </a>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                {{($order->created_at)->format('d-m-Y H:i:s')}}
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            @if($order->status === 0)
                                                <span class="p-2 rounded-full text-xs relative"
                                                      style="background-color: yellow; font-weight: bold">
                                                       Обработка
                                                    </span>
                                            @endif
                                            @if($order->status === 1)
                                                <span class="p-2 rounded-full text-xs"
                                                      style="background-color: green; font-weight: bold; color: white">
                                                    Исполнен
                                                </span>
                                            @endif
                                            @if($order->status === 2)
                                                <span class="p-2 rounded-full text-xs"
                                                      style="background-color: red; font-weight: bold; color: white">
                                                    Отказ
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-left font-bold">
                                            <div class="flex items-start">
                                                <a href="{{route('order_show',$order->id)}}">
                                                    <button type="button"
                                                            class="w-7 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                    </button>
                                                </a>
                                                {{--                                                <div--}}
                                                {{--                                                    class="w-5 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">--}}
                                                {{--                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
                                                {{--                                                         viewBox="0 0 24 24" stroke="currentColor">--}}
                                                {{--                                                        <path stroke-linecap="round" stroke-linejoin="round"--}}
                                                {{--                                                              stroke-width="2"--}}
                                                {{--                                                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>--}}
                                                {{--                                                    </svg>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
