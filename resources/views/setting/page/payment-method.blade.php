<div class="max-w-screen-lg mx-auto p-6 space-y-4 bg-gray-100 border-2">
    <div class="flex justify-between">
        <h1 class="text-xl font-bold underline text-gray-700">PAYMENT METHODS</h1>
        <h1 class="text-right text-xl font-bold text-gray-700 px-4 py-1 bg-yellow-400 rounded-md">Total = 3</h1>
    </div>
    <div id="paymentMethodsGrid" class="grid gap-4 w-full p-2" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
            <h3 class="text-xl font-semibold mb-2">ABA</h3>
            <p class="text-gray-500 text-lg">ABA</p>
            <div class="mt-auto flex justify-end w-full space-x-2">
                <button class="bg-blue-500 text-white px-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-xs fa-edit"></i>
                </button>
                <button class="bg-red-500 text-white px-2 rounded-md hover:bg-red-600">
                    <i class="fas fa-xs fa-trash"></i>
                </button>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
            <h3 class="text-xl font-semibold mb-2">ACLEDA</h3>
            <p class="text-gray-500 text-lg">ACLEDA</p>
            <div class="mt-auto flex justify-end w-full space-x-2">
                <button class="bg-blue-500 text-white px-2 rounded-md hover:bg-blue-600">
                    <i class="fas fa-xs fa-edit"></i>
                </button>
                <button class="bg-red-500 text-white px-2 rounded-md hover:bg-red-600">
                    <i class="fas fa-xs fa-trash"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="mt-6 flex justify-end">
        <a href="#" id="createPaymentMethodButton" class="bg-primary text-primary-foreground py-2 px-4 rounded-md text-xs inline-block"><i class="fas fa-plus mr-2"></i>CREATE</a>
    </div>
</div>

<div id="createPaymentMethodModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
        <h2 class="text-2xl font-bold text-white">Create New Payment Method</h2>
        </div>
        <form id="createPaymentMethodForm" class="p-6">
            <div class="mb-4">
                <label for="paymentMethodName" class="block text-sm font-medium text-gray-900 mb-1">Payment Method Name</label>
                <input type="text" id="paymentMethodName" name="paymentMethodName" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="Abbreviation" class="block text-sm font-medium text-gray-900 mb-1">Abbreviation</label>
                <input type="text" id="Abbreviation" name="Abbreviation" class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-xs">Save</button>
                <button type="button" id="closeCreatePaymentMethodPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-3 py-2 rounded-md focus:outline-none text-xs">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('createPaymentMethodButton').addEventListener('click', function() {
        document.getElementById('createPaymentMethodModal').classList.remove('hidden');
    });

    document.getElementById('closeCreatePaymentMethodPopup').addEventListener('click', function() {
        document.getElementById('createPaymentMethodModal').classList.add('hidden');
    });

    document.getElementById('createPaymentMethodModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });
</script>
