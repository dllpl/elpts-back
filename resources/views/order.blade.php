<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Заявка #{{$order->id}}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="font-bold mb-5">Основная информация</div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Юр лицо/физ
                    лицо</label>
                <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{$order->type_owner}}" disabled>
                <div class="font-bold mt-5 mb-5" style="font-size: 28px">Изменить статус заявки</div>
                <label for="countries" class="block mb-5 font-medium text-gray-900 dark:text-gray-400">
                    Текущий статус заявки:&nbsp
                    @switch($order->status)
                        @case(0)
                        <span class="p-2 rounded-full relative"
                              style="background-color: yellow; font-weight: bold">В обработке</span>
                        @break
                        @case(1)
                        <span class="p-2 rounded-full"
                              style="background-color: green; font-weight: bold; color: white">Исполнен</span>
                        @break
                        @case(2)
                        <span class="p-2 rounded-full"
                              style="background-color: red; font-weight: bold; color: white">Отклонен</span>
                        @break
                    @endswitch
                </label>
                <form action="{{route('status_edit',$order->id)}}" method="POST">
                    @csrf
                    <select id="countries" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @switch($order->status)
                            @case(0)
                            <option value="1">Исполнен</option>
                            <option value="2">Отклонен</option>
                            @break
                            @case(1)
                            <option value="0">В обработке</option>
                            <option value="2">Отклонен</option>
                            @break
                            @case(2)
                            <option value="0">В обработке</option>
                            <option value="1">Исполнен</option>
                            @break
                        @endswitch
                    </select>
                    <button type="submit"
                            class="mt-5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Сохранить
                    </button>
                </form>

            </div>
            @if($order->type_owner === 'Физическое лицо')
                <div class="grid xl:grid-cols-3 xl:gap-4">
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Фамилия</label>
                        <input value="{{$order->last_name}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Имя</label>
                        <input value="{{$order->first_name}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Отчество</label>
                        <input value="{{$order->patronymic}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            @endif

            @if($order->type_owner === 'Юридическое лицо')
                <div class="grid xl:grid-cols-3 xl:gap-4">
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Организация</label>
                        <input value="{{$order->org_name}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">ИНН</label>
                        <input value="{{$order->inn}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">КПП</label>
                        <input value="{{$order->kpp}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            @endif
            <div class="font-bold mt-5 mb-5">Контакты</div>
            <div class="grid xl:grid-cols-6 xl:gap-6">
                <div class="mb-4">
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Почта</label>
                    <input value="{{$order->email}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Телефон</label>
                    <input value="{{$order->phone}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Адрес</label>
                <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{$order->address}}" disabled>
            </div>
            @if($order->type_owner === 'Физическое лицо')
                <div class="font-bold mt-5 mb-5">Паспортные данные</div>
                <div class="grid xl:grid-cols-4 xl:gap-4">
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Серия</label>
                        <input value="{{$order->pass_serial}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Номер</label>
                        <input value="{{$order->pass_number}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">ИНН</label>
                        <input value="{{$order->inn}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">СНИЛС</label>
                        <input value="{{$order->snils}}" disabled
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            @endif
            <div class="font-bold mt-5 mb-5">Сведения о транспортном средстве</div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Марка и
                    модификация</label>
                <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{$order->car_mark}}" disabled>
            </div>
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Коммерческое
                    наименование</label>
                <input
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{$order->commercial_name}}" disabled>
            </div>
            <div class="grid xl:grid-cols-4 xl:gap-4">
                <div class="mb-4">
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Тип</label>
                    <input value="{{$order->car_type}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Цвет
                        кузова</label>
                    <input value="{{$order->car_color}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Идентификационный
                        номер</label>
                    <input value="{{$order->car_id}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Привод
                        ТС</label>
                    <input value="{{$order->drive_ts}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="font-bold mt-5 mb-5">Иноформация о двигателе</div>
            <div class="grid xl:grid-cols-5 xl:gap-5">
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Модель
                        двигателя</label>
                    <input value="{{$order->engine_model}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Номер
                        двигателя</label>
                    <input value="{{$order->engine_number}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Мощность</label>
                    <input value="{{$order->engine_power}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-3">
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Объем</label>
                    <input value="{{$order->engine_volume}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-3">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Топливо</label>
                    <input value="{{$order->fuel}}" disabled
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
            </div>
            <div class="font-bold mt-5 mb-5">Изображения</div>
            <div id="default-carousel" data-carousel="static" class="relative">

                <!-- Carousel wrapper -->
                <div class="overflow-hidden relative h-56 rounded-lg" style="height: 100vh">

                    <!-- Item 1 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото СТС
                            (лицевая)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->sts_front)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                    <!-- Item 2 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото СТС
                            (обратная)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->sts_back)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                    <!-- Item 3 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото ТС
                            (спереди)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->ts_front)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                    <!-- Item 4 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото ТС
                            (сзади)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->ts_back)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>

                    <!-- Item 5 -->
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото ТС
                            (справа)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->ts_right)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото ТС
                            (слева)
                        </div>
                        <img src="{{asset('/storage/'.$order->image->ts_left)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото
                            VIN-таблички у водительской двери
                        </div>
                        <img src="{{asset('/storage/'.$order->image->vin_door)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="">
                        <div class="absolute z-50 left-3 top-3 bg-gray-500 rounded text-white font-bold p-2">Фото
                            VIN-таблички на лобовом стекле
                        </div>
                        <img src="{{asset('/storage/'.$order->image->vin_glass)}}"
                             class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
                    </div>
                </div>

                <!-- Slider controls -->
                <button type="button"
                        class="flex absolute top-0 left-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                        data-carousel-prev>
            <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden">Previous</span>
            </span>
                </button>
                <button type="button"
                        class="flex absolute top-0 right-0 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                        data-carousel-next>
            <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round"
                                                                                  stroke-linejoin="round"
                                                                                  stroke-width="2"
                                                                                  d="M9 5l7 7-7 7"></path></svg>
                <span class="hidden">Next</span>
            </span>
                </button>
            </div>
        </div>
    </div>
</x-app-layout>
