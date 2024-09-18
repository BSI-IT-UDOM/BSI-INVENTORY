<!-- Popup container -->
<div id="popupMaterial" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }} z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW MATERIAL</h2>
        </div>
        <form id="materialForm" action="{{ route('material.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="Material_Khname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN KHMER</label>
                <input type="text" id="Material_Khname" name="Material_Khname" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Material_Khname') is-invalid @enderror" value="{{ old('Material_Khname') }}">
                @error('Material_Khname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Material_Engname" class="block text-sm font-medium text-gray-900 mb-1">NAME IN ENGLISH</label>
                <input type="text" id="Material_Engname" name="Material_Engname" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Material_Engname') is-invalid @enderror" value="{{ old('Material_Engname') }}">
                @error('Material_Engname')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Material_Cate_id" class="block text-sm font-medium text-gray-900 mb-1">CATEGORY</label>
                <select id="Material_Cate_id" name="Material_Cate_id" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Material_Cate_id') is-invalid @enderror">
                    <option value="" disabled selected>-- CATEGORY --</option>
                    <option value="createMaterialCat">++ CREATE NEW ++</option>
                    @foreach ($categories as $data)
                        <option value="{{ $data->Material_Cate_id }}" {{ old('Material_Cate_id') == $data->Material_Cate_id ? 'selected' : '' }}>
                            {{ $data->Material_Cate_Khname . '      ' . $data->Material_Cate_Engname}}
                        </option>
                    @endforeach
                </select>
                @error('Material_Cate_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="Expiry_date" class="block text-sm font-medium text-gray-900 mb-1">EXPIRY DATE</label>
                <input type="date" id="Expiry_date" name="Expiry_date" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Expiry_date') is-invalid @enderror" value="{{ old('Expiry_date') }}">
                @error('Expiry_date')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-900 mb-1">IMAGE</label>
                <div>
                    <button type="button" class="select-logo" onclick="document.getElementById('image').click()">BROWSE</button>
                    <input type="file" id="image" name="image" class="hidden">
                </div>
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">SAVE</button>
                <button type="button" id="closeMaterialPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('closeMaterialPopup').addEventListener('click', function() {
        // Hide the popup
        document.getElementById('popupMaterial').classList.add('hidden');
        
        // Clear the form data
        document.getElementById('materialForm').reset();
        
        // Clear file input
        document.getElementById('image').value = '';
    });

    // Display the popup if validation errors are present
    if ("{{ $errors->any() }}") {
        document.getElementById('popupMaterial').classList.remove('hidden');
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
