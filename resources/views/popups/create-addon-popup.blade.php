<div id="popupcreate" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW ADD-ONS</h2>
        </div>
        <form id="AddonForm" action="{{ route('add-on.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="Addons_name" class="block text-sm font-medium text-gray-900 mb-1">NAME</label>
                <input type="text" id="Addons_name" name="Addons_name" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('Addons_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-4">
                <label for="Percentage" class="block text-sm font-medium text-gray-900 mb-1">PERCENTAGE</label>
                <input type="text" id="Percentage" name="Percentage" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('Percentage')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-4">
                <label for="Qty" class="block text-sm font-medium text-gray-900 mb-1">QTY</label>
                <input type="text" id="Qty" name="Qty" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" >
                @error('Qty')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
            <div class="mb-6">
                <label for="UOM_id" class="block text-sm font-medium text-gray-900 mb-1">UNIT OF MEASURE</label>
                <select id="UOM_id" name="UOM_id" class="text-center text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    <option value="" disabled selected>-- UOM --</option>
                    <option value="createUOM">++ CREATE NEW ++</option>
                    @foreach ($uom as $data)
                    <option value="{{ $data->UOM_id }}">
                        {{ $data->UOM_name }}
                    </option>
                    @endforeach
                </select>
                @error('UOM_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">SAVE</button>
                <button type="button" id="cancelCre" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">CANCEL</button>
            </div>
        </form>
    </div>
</div>
<script>
    document.getElementById('cancelCre').addEventListener('click', function() {
        document.getElementById('popupcreate').classList.add('hidden');
        document.getElementById('AddonForm').reset();    
        const invalidFields = document.querySelectorAll('.is-invalid');
        invalidFields.forEach(field => field.classList.remove('is-invalid'));
        const errorMessages = document.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(message => message.textContent = '');
    });

    // Display the popup if validation errors are present
    if ("{{ $errors->any() }}") {
        document.getElementById('popupcreate').classList.remove('hidden');
        const firstInvalid = document.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.focus({ preventScroll: true });
        }
    }
</script>

<style>
    .is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
</style>
