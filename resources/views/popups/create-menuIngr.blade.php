<!-- Popup container -->

<div id="popupCreateMenuIngr" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center {{ $errors->any() ? '' : 'hidden' }} z-20">

    <div class="bg-white rounded-lg shadow-lg max-w-xl w-full max-h-screen overflow-y-auto">

        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">

            <h2 class="text-2xl font-bold text-white mb-2">NEW INGREDIENT</h2>

        </div>

        <form id="materialForm" action="{{ route('createIng') }}" method="POST" enctype="multipart/form-data" class="p-6">

            @csrf

            <div class="mb-4">

                <label for="Material_Engname" class="block text-sm font-medium text-gray-900 mb-1">MATERIAL</label>

                <select id="Material_Engname" name="Material_id" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="" disabled selected>-- MATERIAL --</option>

                    <option value="createnewING">++ CREATE NEW ++</option>

                    @foreach ($material as $data)

                        <option value="{{ $data->Material_id }}">{{ $data->Material_Engname }}</option> 

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label for="Qty" class="block text-sm font-medium text-gray-900 mb-1">QTY</label>

                <input type="text" id="Qty" name="Qty" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 @error('Item_Engname') is-invalid @enderror"  oninput="updateTotalPrice()">

                @error('Qty')

                    <span class="invalid-feedback">{{ $message }}</span>

                @enderror

            </div>



            <div class="mb-4">

                <label for="UOM_abb" class="block text-sm font-medium text-gray-900 mb-1">UNIT OF MEASURE</label>

                <select id="UOM_abb" name="UOM_id" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="" disabled selected>-- UOM --</option>
                    <option value="createUOM">++ UOM ++</option>

                    @foreach ($uom as $data)

                        <option value="{{ $data->UOM_id }}">{{ $data->UOM_abb }}</option> 

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label for="price" class="block text-sm font-medium text-gray-900 mb-1">FULL NAME</label>

                <input type="text" id="price" name="IIQ_name" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" readonly>

            </div>

            <div class="text-end">

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">ADD</button>

                <button type="button" id="closeItemPopup" class="bg-gray-300 hover:bg-gray-400 text-gray-900 px-4 py-2 rounded-md ml-2 focus:outline-none">CANCEL</button>

            </div>

        </form>

    </div>

</div>



<!-- Your HTML content -->



<script>

function updateTotalPrice() {

    var qtyElement = document.getElementById('Qty');

    var qtyValue = qtyElement.value || 0;



    var itemElement = document.getElementById('Material_Engname');

    var selectedItem = itemElement.options[itemElement.selectedIndex].text;



    var uomElement = document.getElementById('UOM_abb');

    var selectedUOM = uomElement.options[uomElement.selectedIndex].text;



    // Combine the fields into the desired format: "Item Name Qty UOM"

    var combinedString = selectedItem + " " + qtyValue + " " + selectedUOM;



    var priceElement = document.getElementById('price');

    priceElement.value = combinedString;

}



// Update the combined string whenever quantity, item, or UOM changes

document.getElementById('Qty').addEventListener('input', updateTotalPrice);

document.getElementById('Material_Engname').addEventListener('change', updateTotalPrice);

document.getElementById('UOM_abb').addEventListener('change', updateTotalPrice);



// Initialize the form with the correct combined string

document.addEventListener('DOMContentLoaded', function() {

    updateTotalPrice();

});

function generatePriceString(qty, item) {

    // Example logic to generate a string (replace with your actual logic)

    var price = qty * 10; // Example: each unit costs $10

    return  price.toFixed(2) + qty + " " + item;

}



    document.getElementById('closeItemPopup').addEventListener('click', function() {

        // Hide the popup

        document.getElementById('popupCreateMenuIngr').classList.add('hidden');

        

        // Clear the form data

        document.getElementById('materialForm').reset();

    });



    // Display the popup if validation errors are present

    if ("{{ $errors->any() }}") {

        document.getElementById('popupCreateMenuIngr').classList.remove('hidden');

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

