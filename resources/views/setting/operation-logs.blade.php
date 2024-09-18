@extends('layouts.setting')

@section('content')

<div class="bg-gray-100 p-6">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Operation Logs</h2>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Log ID</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Table Name</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Operation Name</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Column Name</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Old Value (String)</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Old Value (Number)</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">New Value (String)</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">New Value (Number)</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Log Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="py-2 px-4 border-b">1</td>
                    <td class="py-2 px-4 border-b">users</td>
                    <td class="py-2 px-4 border-b">UPDATE</td>
                    <td class="py-2 px-4 border-b">email</td>
                    <td class="py-2 px-4 border-b">old@example.com</td>
                    <td class="py-2 px-4 border-b">N/A</td>
                    <td class="py-2 px-4 border-b">new@example.com</td>
                    <td class="py-2 px-4 border-b">N/A</td>
                    <td class="py-2 px-4 border-b">2024-09-10 10:00:00</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4 flex justify-between items-center">
            <span class="text-sm text-gray-600">Showing 1 to 10 of 100 entries</span>
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
</div>

@endsection