<!-- Popup form -->
<div id="createExpensePopup" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden z-60">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW EXPENSE</h2>
        </div>
        <form id="createExpenseForm" action="{{ route('createExpense') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">SAVE</button>
                <button type="button" id="closeCreateExpenseCatPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none" onclick="window.location.reload();">CANCEL</button>
            </div>
        </form>
    </div>
  </div>
