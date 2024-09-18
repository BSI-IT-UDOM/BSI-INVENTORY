<!-- Overlay -->
<div class="create-popup-shop-overlay hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

<!-- Popup -->
<div class="create-popup-shop hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-[600px] max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white">NEW SHOP</h2>
        </div>
        <form  action="{{ route('createShop') }}" method="POST" enctype="multipart/form-data" id="create-shop-form" class="space-y-4 px-6 py-2">
            @csrf
            <div class="relative text-center">
                <label for="S_logo" class="block mb-1 font-semibold">LOGO:</label>
                <div class="relative inline-block">
                    <img id="logoPreview" src="images/shop.jpg" class="h-32 w-32 rounded-full" alt="Profile">
                    <div class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-full">
                        <div class="p-2 cursor-pointer hover:bg-opacity-75 transition rounded-full" onclick="document.getElementById('S_logo').click();">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                    </div>
                </div>
                <input type="file" id="S_logo" name="S_logo" class="hidden" onchange="previewImage(event)">
            </div>
           {{-- create shop --}}
            <div class="p-2 w-full text-start">
                <div class="mb-4">
                    <label for="S_name" class="block mb-1">NAME:</label>
                    <input type="text" id="S_name" name="S_name" class="w-full border border-gray-300 rounded-md p-2">
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">SAVE</button>
                <button type="button" id="close-create-shop-popup" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition" onclick="window.location.reload();">CANCEL</button>
            </div>
        </form>
    </div>
</div>
<script>
        function previewImage(event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById('logoPreview').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
</script>