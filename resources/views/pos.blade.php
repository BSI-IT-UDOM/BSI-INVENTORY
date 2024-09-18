@extends('layouts.app-nav')

@section('content')
<div class="relative flex items-center justify-center w-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-5xl w-full -mt-32">
        <!-- Display success or error messages -->
        <h2 class="text-2xl font-bold mb-6 text-center">SUBMIT SALE TRANSACTION</h2>
        <form id="posForm" action="{{ route('pos.store') }}" method="POST" class="grid grid-cols-1 gap-4">
            @csrf
        
            <div class="flex flex-wrap gap-4">
        
                <!-- Shop Select -->
                <select name="shop" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>SELECT SHOP</option>
                    <option value="BSI">BSI</option>
                </select>
        
                <!-- Location Select -->
                <select name="location" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>SELECT LOCATION</option>
                    <option value="BSI">BSI</option>
                </select>
        
                <!-- Product Select -->
                <select id="menuid" name="menuid" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>MENU</option>
                    @foreach ($menus as $data)
                        <option value="{{ $data->Menu_id }}" data-name="{{ $data->Menu_name_eng }}">
                            {{ $data->Menu_name_eng }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" id="menuname" name="menuname" value="">
        
                <!-- Add-On Select -->
                <select id="addon_id" name="addon_id" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>SELECT ADD-ON</option>
                    @foreach ($addons as $data)
                        <option value="{{ $data->Addons_id }}" data-name="{{ $data->Addons_name }}">
                            {{ $data->Addons_name }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" id="addon_name" name="addon_name" value="">
        
                <!-- Quantity Input -->
                <div class="flex-1 min-w-[150px]">
                    <input type="number" id="quantity" name="quantity" min="1" step="1" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Enter Quantity">
                </div>
        
                <!-- Price Input -->
                <div class="flex-1 min-w-[150px]">
                    <input type="number" id="price" name="price" min="0" step="0.01" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required placeholder="Enter Price">
                </div>
        
                <!-- Currency Select -->
                <select name="currency" class="py-2 px-4 bg-gray-100 rounded-lg border border-gray-300 flex-1 min-w-[150px]" required>
                    <option value="" disabled selected>SELECT CURRENCY</option>
                    <option value="KHR">Riel(s)</option>
                    <option value="USD">USD</option>
                </select>
            </div>
        
            <!-- Hidden Date Input -->
            <input type="hidden" name="date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
        
            <!-- Submit Button -->
            <div class="text-end mt-8">
                <button type="submit" class="py-2 px-6 bg-primary text-white rounded-lg hover:bg-blue-700">SUBMIT</button>
            </div>
        </form>        
    </div>
</div>

<script>
document.getElementById('menuid').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var menuName = selectedOption.getAttribute('data-name');
    document.getElementById('menuname').value = menuName;
});

document.getElementById('addon_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var addonName = selectedOption.getAttribute('data-name');
    document.getElementById('addon_name').value = addonName;
});
</script>
@endsection
