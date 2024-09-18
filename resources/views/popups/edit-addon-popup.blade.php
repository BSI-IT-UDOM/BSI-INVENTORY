<div id="editPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg w-1/2">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">EDIT ADD-ONS</h2>
        </div>
        <form id="editProductPopup" action="" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')
            <input type="hidden" id="editAddons_id" name="Addons_id">
            <div class="mb-4">
                <label for="editAddons_name" class="block text-sm font-medium text-gray-900 mb-1">NAME</label>
                <input type="text" id="editAddons_name" name="Addons_name" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="editPercentage" class="block text-sm font-medium text-gray-900 mb-1">PERCENTAGE</label>
                <input type="text" id="editPercentage" name="Percentage" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="editQty" class="block text-sm font-medium text-gray-900 mb-1">QTY</label>
                <input type="number" id="editQty" name="Qty" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="edituom" class="block text-sm font-medium text-gray-900 mb-1">UNIT OF MEASURE</label>
                <select id="edituom" name="UOM_id" class="text-center text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- UOM --</option>
                    <option value="createUOM">++ CREATE NEW ++</option>
                    @foreach ($uom as $data)
                    <option value="{{ $data->UOM_id }}" data-uom-name="{{ $data->UOM_name }}">
                        {{ $data->UOM_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">UPDATE</button>
                <button type="button" id="cancelEdit" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">CANCEL</button>
            </div>
        </form>
    </div>
</div>
