<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100 border-2 mb-2">
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold underline text-gray-700">CURRENCY</h1>
        <h1 class="text-right text-xl font-bold text-gray-700 px-4 py-1 bg-yellow-400 rounded-md">Total = 2</h1>
    </div>
    <div id="currencyGrid" class="grid gap-4 w-full p-2" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
        @foreach($currency as $data)
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center w-full">
            <h3 class="text-xl font-semibold mb-2">{{ $data->Currency_name }}</h3>
            <p class="text-gray-500 text-lg">{{ $data->Currency_alias }}</p>
            <div class="mt-auto w-full flex justify-end space-x-2">
                <button class="bg-blue-500 text-white px-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-xs fa-edit"></i>
                </button>
                <button class="bg-red-500 text-white px-2 rounded-md hover:bg-red-600">
                    <i class="fas fa-xs fa-trash"></i>
                </button>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6 flex justify-end">
        <a href="#" id="createCurrencyButton" class="bg-primary text-primary-foreground py-2 px-4 rounded-md text-xs inline-block"><i class="fas fa-plus mr-2"></i>CREATE</a>
    </div>
</div>

<div id="createCurrencyModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
        <h2 class="text-2xl font-bold text-white">Create Currency</h2>
        </div>
        <form id="createCurrencyForm" class="p-6">
            <div class="mb-4">
                <label for="currencyType" class="block text-sm font-medium text-gray-900 mb-1">Type</label>
                <input type="text" id="currencyType" name="currencyType" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="currencyCountry" class="block text-sm font-medium text-gray-900 mb-1">Country</label>
                <input type="text" id="currencyCountry" name="currencyCountry" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs">Save</button>
                <button type="button" id="closeCreateCurrencyPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-3 py-2 rounded-md focus:outline-none text-xs">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('createCurrencyButton').addEventListener('click', function() {
        document.getElementById('createCurrencyModal').classList.remove('hidden');
    });

    document.getElementById('closeCreateCurrencyPopup').addEventListener('click', function() {
        document.getElementById('createCurrencyModal').classList.add('hidden');
    });

    document.getElementById('createCurrencyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>