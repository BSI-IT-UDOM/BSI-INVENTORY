<!-- Assuming your popup markup remains the same -->
<div id="editPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg w-1/2">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2">EDIT MENU</h2>
        </div>
   
        <form id="editMenuPopup"  action="" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PATCH')
            <input type="hidden" id="editMenu_id" name="Menu_id" value="{{ $data->Menu_id }}">
            <div class="mb-4">
                <label for="editMenu_name_eng" class="block text-sm font-medium text-gray-900 mb-1">NAME IN ENGLISH</label>
                <input type="text" id="editMenu_name_eng" name="Menu_name_eng" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="editMenu_name_kh" class="block text-sm font-medium text-gray-900 mb-1">NAME IN KHMER</label>
                <input type="text" id="editMenu_name_kh" name="Menu_name_kh" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="editCate_Khname" class="block text-sm font-medium text-gray-900 mb-1">CATEGORY</label>
                <select id="editCate_Khname" name="Menu_Cate_id" class="text-center text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="" disabled selected>-- CATEGORY --</option>
                    <option value="createMenuCat">++ CREATE NEW ++</option>
                    @foreach ($MenuCate as $data)
                    <option value="{{ $data->Menu_Cate_id }}" data-uom-name="{{ $data->Cate_Khname }}">
                        {{ $data->Cate_Khname . '   ' . $data->Cate_Engname}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="editimage" class="block text-sm font-medium text-gray-900 mb-1">IMAGE</label>
                <div>
                    <button type="button" class="select-logo" onclick="document.getElementById('editimage').click()">BROWSE</button>
                    <input type="file" id="editimage" name="image" style="display:none">
                </div>
                <img id="imagePreview" src="" alt="Image Preview" class="h-20 w-24 rounded hidden mt-2">
              </div>
            <div class="text-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">UPDATE</button>
                <button type="button" id="cancelEdit" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none" onclick="window.location.reload();">CANCEL</button>
            </div>
        </form>
    </div>
</div>
