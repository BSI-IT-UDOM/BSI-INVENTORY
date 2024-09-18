@isset($data)
<div id="editPopup" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <form id="editSupplierForm" action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg w-1/2">
    @csrf
    @method('PATCH')
    <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
      <h2 class="text-2xl font-bold text-white mb-2">EDIT SUPPLIER</h2>
    </div>
    <div class="p-6">
      <input type="hidden" id="editSupId" name="Sup_id" value="{{ $data->Sup_id }}">
      <div class="mb-4">
        <label for="editSupName" class="block text-sm font-medium text-gray-900">NAME</label>
        <input type="text" id="editSupName" name="Sup_name" value="{{ $data->Sup_name }}" class="text-center mt-1 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div class="mb-4">
        <label for="editSupContact" class="block text-sm font-medium text-gray-900">CONTACCT</label>
        <input type="text" id="editSupContact" name="Sup_contact" value="{{ $data->Sup_contact }}" class="text-center mt-1 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div class="mb-4">
        <label for="editSupAddress" class="block text-sm font-medium text-gray-900">ADDRESS</label>
        <input type="text" id="editSupAddress" name="Sup_address" value="{{ $data->Sup_address }}" class="text-center mt-1 p-2 border border-gray-300 rounded-md w-full">
      </div>
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md focus:outline-none mr-2">UPDATE</button>
        <button type="button" id="cancelEdit" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-md focus:outline-none">CANCEL</button>
      </div>
    </div>
  </form>
</div>
@endisset

