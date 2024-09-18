@extends('layouts.app-nav')
@section('content')
<div class="flex justify-center items-center mt-4">
    <div id="dashboard" class="p-2 grid grid-cols-1 md:grid-cols-2 gap-8 w-full mb-14 mt-1 md:w-4/5 lg:w-4/5">
        <!-- DAILY SALE & TOP Menu SECTIONS -->
        <div class="w-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-2 border-yellow-500 rounded-lg p-14 text-center shadow-lg">
                    <h2 class="text-xl font-bold mb-2">DAILY SALE</h2>
                    <div class="border-t-2 border-yellow-500 my-6 mt-1"></div>
                    <p class="text-xl font-bold">{{ number_format($totalDailySales, 2) . '  USD' }}</p>
                </div>
                <div class="border-2 border-yellow-500 rounded-lg p-14 text-center shadow-lg">
                    <h2 class="text-xl font-bold">TOP MENU</h2>
                    <div class="border-t-2 border-yellow-500 my-6 mt-1"></div>
                    @if ($topMenu)
                        <p class="text-xl font-bold">{{ $topMenu->Menu_name_eng }}: {{ $topMenu->total_qty }}</p>
                    @else
                        <p class="text-xl font-bold">Not yet have sale transaction today</p>
                    @endif
                </div>
            </div>

            <!-- STOCK ON HAND SECTION -->
            <div class="border-2 border-yellow-500 rounded-lg p-10 w-full shadow-lg bg-white mt-4">
                <h2 class="text-xl font-bold text-center mb-4 text-yellow-600">STOCK IN HAND</h2>
                <div class="border-t-2 border-yellow-500 my-6"></div>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 text-center">
                    @foreach ($invView as $data)
                    <div class="border border-yellow-500 rounded-lg p-4 bg-gray-100">
                        <p class="text-sm font-bold mb-2">{{ $data->Item_Name }}</p>
                        <p class="text-xs text-gray-700">
                            @if($data->Total_In_Hand >= 1000 && $data->UOM =='g')
                                {{ $data->Total_In_Hand / 1000 }} kg
                            @elseif($data->Total_In_Hand < 1000 && $data->UOM =='g')
                                {{ $data->Total_In_Hand }} g
                            @elseif($data->Total_In_Hand >= 1000 && $data->UOM== 'ml')
                            {{ $data->Total_In_Hand / 1000 }} L
                            @elseif($data->Total_In_Hand < 1000 && $data->UOM =='ml')
                            {{ $data->Total_In_Hand }} ml
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
                <div class="border-t-2 border-yellow-500 my-6"></div>
            </div>
            
          
        </div>
        
        <!-- Menu LIST SECTION -->
        <div class="border-2 border-yellow-500 rounded-lg p-3 bg-white shadow-lg w-full">
            <h2 class="text-2xl font-bold text-center mb-4">MENU LIST</h2>
            <div class="border-t-2 border-yellow-500 my-4 " ></div>
            
            <!-- Scrollable container for the table -->
            <div class="overflow-auto" style="max-height: 650px;">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border border-yellow-500 p-4 bg-blue-900 text-white">NAME IN ENGLISH</th>
                            <th class="border border-yellow-500 p-4 bg-blue-900 text-white">NAME IN KHMER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Menu as $data)
                        <tr>
                            <td class="border border-yellow-500 p-4 bg-zinc-300">{{$data->Menu_name_eng}}</td>
                            <td class="border border-yellow-500 p-4 bg-zinc-300">{{$data->Menu_name_kh}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>      
</div>
@endsection
