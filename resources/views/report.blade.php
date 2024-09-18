@extends('layouts.app-nav')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="w-4/5 mx-auto">
        <div class="text-center">
            <div class="border-b border-gray-300 mb-12">
                <nav class="flex justify-center space-x-8">
                    <a href="#sale-detail" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Detail
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-summary" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Summary
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-add-ons" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Add-ons
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                    <a href="#sale-discount" class="tab py-4 px-8 text-gray-700 font-semibold text-lg hover:text-blue-600 transition-colors duration-300 ease-in-out relative">
                        Sale Discount
                        <span class="absolute inset-x-0 bottom-0 h-0.5 bg-blue-500 rounded-md scale-x-0 transition-transform duration-300 ease-in-out"></span>
                    </a>
                </nav>
            </div>
            
            <div class="flex justify-center mt-6">
              <form method="GET" action="{{ route('report.index') }}" class="flex items-center space-x-4">
                <select id="brand-dropdown" name="Lcation" class="block px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                  <option value="" disabled selected>-- BRANCH --</option>
                  <option value="All">All</option>
                  @foreach ($locations as $location)
                      <option value="{{ $location->Location }}" {{ request('Location') == $location->Location ? 'selected' : '' }}>
                          {{ $location->Location }}
                      </option>
                  @endforeach
              </select>
                  <div class="flex items-center space-x-1">
                    <label for="start-date" class="text-gray-700 text-sm">From:</label>
                    <input type="date" id="start-date" name="start_date" value="{{ request('start_date') }}" class="block px-4 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex items-center space-x-2">
                    <label for="end-date" class="text-gray-700 text-sm">To:</label>
                    <input type="date" id="end-date" name="end_date" value="{{ request('end_date') }}" class="block px-4 py-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                  <button type="submit" class="px-4 py-1 bg-blue-500 text-white rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                      Filter
                  </button>
                  <button class="px-4 py-1 bg-green-500 text-white rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring focus:ring-green-500 focus:border-green-500 sm:text-sm">
                      Export
                  </button>
              </form>
          </div>
          
          
        </div>

        <div id="sale-detail" class="mt-6">
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-4">Sale Detail</h2>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600">No.</th>
                            <th class="py-2 px-4 text-left text-gray-600">SHOP</th>
                            <th class="py-2 px-4 text-left text-gray-600">LOCATION</th>
                            <th class="py-2 px-4 text-left text-gray-600">MENU</th>
                            <th class="py-2 px-4 text-left text-gray-600">ADD-ON</th>
                            <th class="py-2 px-4 text-left text-gray-600">QTY</th>
                            <th class="py-2 px-4 text-left text-gray-600">PRICE</th>
                            <th class="py-2 px-4 text-left text-gray-600">CURRENCY</th>
                            <th class="py-2 px-4 text-left text-gray-600">DATE</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      @foreach ($report as $data) 
                        <tr>
                            <td class="py-2 px-4">{{$data->ID}}</td>
                            <td class="py-2 px-4">{{$data->Shop_Name}}</td>
                            <td class="py-2 px-4">{{$data->Location}}</td>
                            <td class="py-2 px-4">{{$data->Menu_Name}}</td>
                            <td class="py-2 px-4">{{$data->Addon}}</td>
                            <td class="py-2 px-4">{{$data->Qty}}</td>
                            <td class="py-2 px-4">{{$data->Price}}</td>
                            <td class="py-2 px-4">{{$data->Currency}}</td>
                            <td class="py-2 px-4">{{$data->Sale_date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="sale-summary" class="mt-6 hidden"></div>
        <div id="sale-add-ons" class="mt-6 hidden"></div>
        <div id="sale-discount" class="mt-6 hidden"></div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const defaultTab = document.querySelector('nav a[href="#sale-detail"]');
        const defaultSection = document.querySelector('#sale-detail');

        if (defaultTab && defaultSection) {
            defaultTab.classList.add('text-blue-600');
            defaultTab.querySelector('span').classList.add('scale-x-100');
            defaultSection.classList.remove('hidden');
        }

        document.querySelectorAll('nav a').forEach(tab => {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('div[id^="sale-"]').forEach(section => {
                    section.classList.add('hidden');
                });
                document.querySelector(this.getAttribute('href')).classList.remove('hidden');
                
                document.querySelectorAll('nav a').forEach(a => {
                    a.classList.remove('text-blue-600');
                    a.querySelector('span').classList.remove('scale-x-100');
                });
                
                this.classList.add('text-blue-600');
                this.querySelector('span').classList.add('scale-x-100');
            });
        });
    });
    window.addEventListener('DOMContentLoaded', function() {
        if (window.location.search.length > 0) {
            const newUrl = window.location.origin + window.location.pathname;
            window.history.replaceState({}, document.title, newUrl);
        }
    });
</script>
@endsection
