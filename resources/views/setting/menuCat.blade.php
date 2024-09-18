@extends('layouts.setting')

@section('content')

<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100">
    <!-- Page Header -->
    <h1 class="text-xl md:text-2xl font-bold mb-4">MENU CATEGORY</h1>

    <!-- Create New Category Button -->
    <div class="flex justify-end mb-4">
        <a href="#" id="CreateMenuCat" class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm md:text-base flex items-center">
            <i class="fas fa-plus mr-2"></i> CREATE NEW CATEGORY
        </a>
    </div>

    <!-- Table Wrapper for Scroll -->
    <div class="overflow-x-auto w-full">
      <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-200">
          <tr>
            <th class="border px-2 py-1 md:px-4 md:py-2 text-left text-xs md:text-sm">ID</th>
            <th class="border px-2 py-1 md:px-4 md:py-2 text-left text-xs md:text-sm">KHMER NAME</th>
            <th class="border px-2 py-1 md:px-4 md:py-2 text-left text-xs md:text-sm">ENGLISH NAME</th>
            <th class="border px-2 py-1 md:px-4 md:py-2 text-right text-xs md:text-sm">ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach($menu_category as $category)
          <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
            <td class="border px-2 py-1 md:px-4 md:py-2">{{ $category->Menu_Cate_id }}</td>
            <td class="border px-2 py-1 md:px-4 md:py-2">{{ $category->Cate_Khname }}</td>
            <td class="border px-2 py-1 md:px-4 md:py-2">{{ $category->Cate_Engname }}</td>
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

@include('popups.create-menu-cat-popup')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createMenuCatPopup = document.getElementById('createMenuCatPopup');
        const createMenuCatBtn = document.getElementById('CreateMenuCat');
        const closeMenuCatBtn = document.getElementById('closeCreateMenuCatPopup');
    
        // Show the popup
        createMenuCatBtn.addEventListener('click', function (event) {
            event.preventDefault();
            createMenuCatPopup.classList.remove('hidden');
        });
    
        // Hide the popup
        closeMenuCatBtn.addEventListener('click', function () {
            createMenuCatPopup.classList.add('hidden');
        });
    
        // Hide the popup when clicking outside of it
        window.addEventListener('click', function (event) {
            if (event.target === createMenuCatPopup) {
                createMenuCatPopup.classList.add('hidden');
            }
        });
    });
</script>

@endsection
