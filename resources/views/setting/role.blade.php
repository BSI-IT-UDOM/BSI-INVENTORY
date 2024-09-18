@extends('layouts.setting')

@section('content')

<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100">
    <h1 class="text-xl font-bold mb-4">ROLE MANAGEMENT</h1>
    <div class="flex justify-end mb-4">
      <a href="#" class="px-4 py-1 bg-green-600 text-white rounded-lg"><i class="fas fa-plus mr-2"></i>Add New Role</a>
    </div>
      <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-200">
          <tr>
            <th class="border px-4 py-2 text-left">ID</th>
            <th class="border px-4 py-2 text-left">ROLE TYPE</th>
            <th class="border px-4 py-2 text-left">STATUS</th>
            <th class="border px-4 py-2 text-right">ACTION</th>
          </tr>
        </thead>
        <tbody>
          @foreach($roles as $role)
          <tr class="{{ $loop->even ? 'bg-gray-100' : 'bg-white' }}">
            <td class="border px-4 py-2">{{ $role->R_id }}</td>
            <td class="border px-4 py-2">{{ $role->R_type }}</td>
            <td class="border px-4 py-2">{{ $role->status }}</td>
            <td class="py-3 px-6 border-b text-right flex justify-end space-x-2">
              <a href="#" class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 flex justify-center items-center" title="Edit">
                  <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 flex justify-center items-center" title="Delete">
                  <i class="fas fa-trash"></i>
              </a>
              <a href="#" class="bg-green-500 text-white p-2 rounded-full hover:bg-green-600 flex justify-center items-center" title="Activate">
                  <i class="fas fa-toggle-on"></i>
              </a>
          </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="mt-4 flex justify-between items-center">
        <span class="text-sm text-gray-600">Showing 1 to 10 of 50 entries</span>
        <div class="inline-flex">
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                Prev
            </button>
            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                Next
            </button>
        </div>
    </div>
  </div>
@endsection