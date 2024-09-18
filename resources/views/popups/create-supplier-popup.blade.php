<!-- Popup container -->
<div id="popupSupplier" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }} z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">NEW SUPPLIER</h2>
        </div>
        <form id="supplierForm" action="{{ route('supplier.store') }}" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label for="Sup_name" class="block text-sm font-medium text-gray-900 mb-1">NAME</label>
                <input type="text" id="Sup_name" name="Sup_name" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Sup_name') is-invalid @enderror" value="{{ old('Sup_name') }}">
                @error('Sup_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="Sup_contact" class="block text-sm font-medium text-gray-900 mb-1">CONTACT</label>
                <input type="text" id="Sup_contact" name="Sup_contact" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Sup_contact') is-invalid @enderror" value="{{ old('Sup_contact') }}">
                @error('Sup_contact')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label for="Sup_address" class="block text-sm font-medium text-gray-900 mb-1">ADDRESS</label>
                <textarea id="Sup_address" name="Sup_address" rows="6" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Sup_address') is-invalid @enderror">{{ old('Sup_address') }}</textarea>
                @error('Sup_address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">SAVE</button>
                <button type="button" id="closeSupplierPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none transition duration-150">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('closeSupplierPopup').addEventListener('click', function() {
        // Hide the popup
        document.getElementById('popupSupplier').classList.add('hidden');
        
        // Clear the form data
        document.getElementById('supplierForm').reset();
    });

    // Focus the first invalid input if any errors are present
    if (document.querySelector('.is-invalid')) {
        document.getElementById('popupSupplier').classList.remove('hidden');
        document.querySelector('.is-invalid').focus({ preventScroll: true });
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
