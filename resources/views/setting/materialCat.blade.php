@extends('layouts.setting')

@section('content')

<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100">
    <!-- Page Header -->
    <h1 class="text-xl md:text-2xl font-bold mb-6">MATERIAL CATEGORY</h1>

    <!-- Create New Category Button -->
    <div class="flex justify-end mb-4">
        <a href="#" id="CreateMaterialCat" class="bg-green-500 text-white font-bold py-1 px-4 md:py-2 md:px-6 rounded flex items-center text-sm md:text-base">
            <i class="fas fa-plus mr-2"></i> CREATE NEW CATEGORY
        </a>
    </div>

    <!-- Table Wrapper for Scroll -->
    <div class="overflow-x-auto w-full">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-200">
                <tr class="text-sm md:text-lg">
                    <th class="py-2 px-3 md:py-3 md:px-6 border-b text-left">ID</th>
                    <th class="py-2 px-3 md:py-3 md:px-6 border-b text-left">KHMER NAME</th>
                    <th class="py-2 px-3 md:py-3 md:px-6 border-b text-left">ENGLISH NAME</th>
                    <th class="py-2 px-3 md:py-3 md:px-6 border-b text-left">TYPE</th>
                    <th class="py-2 px-3 md:py-3 md:px-6 border-b text-right">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materialcat as $category)
                <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
                    <td class="py-2 px-3 md:py-3 md:px-6 border-b">{{ $category->Material_Cate_id }}</td>
                    <td class="py-2 px-3 md:py-3 md:px-6 border-b">{{ $category->Material_Cate_Khname }}</td>
                    <td class="py-2 px-3 md:py-3 md:px-6 border-b">{{ $category->Material_Cate_Engname }}</td>
                    <td class="py-2 px-3 md:py-3 md:px-6 border-b">{{ $category->status }}</td>
                    <td class="py-2 px-3 md:py-3 md:px-6 border-b text-right flex justify-end space-x-2">
                        <a href="#" class="bg-blue-500 text-white p-1 md:p-2 rounded-full hover:bg-blue-600 flex justify-center items-center" title="Edit">
                            <i class="fas fa-edit text-xs md:text-base"></i>
                        </a>
                        <a href="#" class="bg-red-500 text-white p-1 md:p-2 rounded-full hover:bg-red-600 flex justify-center items-center" title="Delete">
                            <i class="fas fa-trash text-xs md:text-base"></i>
                        </a>
                        <a href="#" class="bg-green-500 text-white p-1 md:p-2 rounded-full hover:bg-green-600 flex justify-center items-center" title="Activate">
                            <i class="fas fa-toggle-on text-xs md:text-base"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 flex flex-col md:flex-row justify-between items-center">
        <span class="text-sm text-gray-600 mb-2 md:mb-0">Showing 1 to 10 of 50 entries</span>
        <div class="inline-flex">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 md:py-2 md:px-4 rounded-l">
                Prev
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-1 px-3 md:py-2 md:px-4 rounded-r">
                Next
            </button>
        </div>
    </div>
</div>

@include('popups.create-material-cat-popup')

<script>
    // Get the elements
    const openPopupBtn = document.getElementById('CreateItemCat');
    const closePopupBtn = document.getElementById('closeCreateItemCatPopup');
    const popup = document.getElementById('createItemCatPopup');

    // Open the popup
    openPopupBtn.addEventListener('click', function(event) {
        event.preventDefault();
        popup.classList.remove('hidden');
    });

    // Close the popup
    closePopupBtn.addEventListener('click', function() {
        popup.classList.add('hidden');
    });

    // Close the popup when clicking outside the form
    window.addEventListener('click', function(e) {
        if (e.target === popup) {
            popup.classList.add('hidden');
        }
    });
</script>

@endsection
