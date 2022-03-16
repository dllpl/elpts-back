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
                        <div class="bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full table-auto">
                                <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">ID</th>
                                    <th class="py-3 px-6 text-left">Тип</th>
                                    <th class="py-3 px-6 text-left">Марка</th>
                                    <th class="py-3 px-6 text-left">Почта</th>
                                    <th class="py-3 px-6 text-left">Телефон</th>
                                    <th class="py-3 px-6 text-left">Дата</th>
                                    <th class="py-3 px-6 text-left">Статус</th>
                                    <th class="py-3 px-6 text-left">Действия</th>
                                </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm font-light">
                                @foreach($orders as $order)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="font-medium">{{$order->id}}</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <span>{{$order->car_type}}</span>
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
                                                        В обработке
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
                                                    Отклонен
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
