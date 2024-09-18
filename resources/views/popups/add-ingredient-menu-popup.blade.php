<!-- Popup container -->

<div id="popupAddMenuIngr" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden">

    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">

        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">

            <h2 class="text-2xl font-bold text-white mb-2">ADD MORE INGREDIENT</h2>

        </div>

        <form action="{{ route('addIng') }}" method="POST" enctype="multipart/form-data" class="p-6">

            @csrf

            <input type="hidden" id="Menu_id" name="Menu_id" value="">

            <div class="mb-4">

                <label for="Material_Engname" class="block text-sm font-medium text-gray-900 mb-1">INGREDIENT</label>

                <select id="IIQ_id" name="IIQ_id" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="handleSelect(event)">

                    <option value="" disabled selected>-- INGREDIENT NAME --</option>

                    <option value="createINGR">++ CREATE NEW ++</option>

                    @foreach ($ingredientQty as $data)

                        <option value="{{ $data->IIQ_id }}">{{ $data->IIQ_name }}</option> 

                    @endforeach

                </select>

            </div>

            <div class="text-end">

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">ADD</button>

                <button type="button" id="closePopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none" onclick="window.location.reload();">CANCEL</button>

            </div>

        </form>

    </div>

</div>

@include('popups.create-menuIngr')



<script>

    

function handleSelect(event) {
    var selectedValue = event.target.value;

    if (selectedValue === 'createINGR') {

        togglePopup('popupCreateMenuIngr');

    }

}

function togglePopup(popupId) {

    const popup = document.getElementById(popupId);

    if (popup) {

        popup.classList.toggle('hidden');

    }

}

</script>