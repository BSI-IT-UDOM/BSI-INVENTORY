<!-- Popup form -->
@php
use App\Models\OrderInfor;

$date = date('Y-m-d');

// Retrieve the latest order number for the current date
$latestOrder = OrderInfor::whereDate('order_date', '=', $date)
                         ->orderBy('order_date', 'desc')
                         ->orderBy('Order_number', 'desc')
                         ->first();

if ($latestOrder) {
    $lastOrderNumber = $latestOrder->Order_number;
    // Extract the sequence number from the last order number
    $parts = explode('_', $lastOrderNumber);
    $sequence = (int) end($parts) + 1;
} else {
    $sequence = 1;
}

$orderNumber = 'inv_' . str_replace('/', '-', $date) . '_' . str_pad($sequence, 3, '0', STR_PAD_LEFT);
@endphp
<div id="popupOrder" class="fixed inset-0 bg-black bg-opacity-60 flex justify-center items-center hidden z-20">
    <div class="bg-white rounded-lg shadow-lg max-w-5xl w-full mx-4 max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white mb-2 sm:text-2xl">NEW ORDER</h2>
        </div>
        <form class="p-6 sm:p-6" method="POST" action="{{ route('order.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-wrap -mx-2 mb-4">
                <h3 class="w-full text-lg font-bold text-gray-800 mb-2"> ORDER INFORMATION</h3>
                <div class="w-full h-0.5 bg-bsicolor rounded-sm mb-4"></div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="Order_number" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">ORDER NUMBER</label>
                    <input type="text" id="Order_number" name="Order_number" value="{{ $orderNumber ?? '' }}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" readonly >
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="Reciept_image" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">RECIEPT IMAGE</label>
                    <input type="file" id="Reciept_image" name="Reciept_image" class="text-sm border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="Total_Price" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">TOTAL PRICE</label>
                    <input type="number" id="Total_Price" name="Total_Price" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" step="any">
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="Sup_id" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">SUPPLIER</label>
                    <select id="Sup_id" name="Sup_id" class="text-center text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="handleSelect(event)" required>
                       <option value="" disabled selected>-- SUPPLIER --</option>
                        <option value="createnewSUPPLIER">++ CREATE NEW ++</option>
                        @foreach ($Supplier as $data)
                        <option value="{{ $data->Sup_id }}">
                            {{ $data->Sup_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="inc_VAT" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1"> VAT</label>
                    <input type="checkbox" id="inc_VAT" name="inc_VAT" class="h-6 w-6 ml-10 border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                    <label for="order_date" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">ORDER DATE</label>
                    <input type="date" id="order_date" name="order_date" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="Currency_id" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">CURRENCY</label>
                    <select id="Currency_id" name="Currency_id" class="text-center text-sm sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled selected>-- CURRENCY --</option>
                        @foreach ($currency as $data)
                        <option value="{{ $data->Currency_id }}">
                            {{ $data->Currency_name }}
                        </option>
                        @endforeach
                    </select>
                </div>                         
                <div class="flex flex-col items-center w-full sm:w-1/2 md:w-1/5 px-2 mb-4">
                    <label for="selectnum" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">QTY OF MATERIAL</label>
                    <select id="selectnum" name="selectnum" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="0" disabled selected>-- QOM --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <h3 class="w-full text-xl font-bold text-gray-800 mb-2">MATERIAL LIST</h3>
            <div class="w-full h-0.5 bg-bsicolor rounded-sm mb-4"></div>
            <div id="itemsContainer" class="flex flex-wrap -mx-2 mb-2">
                <!-- Material rows will be appended here -->
            </div>

            <div class="w-full flex justify-start mb-4 space-x-1">
                <button type="button" id="subtractRowBtn" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-4 rounded focus:outline-none focus:ring-2 focus:ring-red-400 hidden"><i class="fas fa-minus-circle"></i></button>
                <button type="button" id="addMoreRowBtn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-4 rounded focus:outline-none focus:ring-2 focus:ring-green-400 hidden"><i class="fas fa-plus-circle"></i></button>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-400 mr-2">SAVE</button>
                <button type="button" id="closeOrderPopup" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-gray-400">CANCEL</button>
            </div>
        </form>
    </div>
</div>

@include('popups.create-material-popup')
@include('popups.create-supplier-popup')
<!-- JavaScript to handle showing/hiding rows based on selection and calculating total price -->
<script>
    document.getElementById('selectnum').addEventListener('change', function() {
    var itemsContainer = document.getElementById('itemsContainer');
    itemsContainer.innerHTML = '';
    var selectedValue = parseInt(this.value);

    if (selectedValue > 0) {
        addMoreRowBtn.classList.remove('hidden');
        subtractRowBtn.classList.remove('hidden');
    } else {
        addMoreRowBtn.classList.add('hidden');
        subtractRowBtn.classList.add('hidden');
    }

    for (var i = 0; i < selectedValue; i++) {
        addItemRow(i + 1);
    }
});

document.getElementById('addMoreRowBtn').addEventListener('click', function() {
    var itemsContainer = document.getElementById('itemsContainer');
    var currentRowCount = itemsContainer.children.length;
    var newOption = document.createElement('option');
    addItemRow(currentRowCount + 1);

    if ( document.getElementById('selectnum').text = 6){
        document.getElementById('selectnum').value =+ currentRowCount + 1;
        document.getElementById('selectnum').text =+ currentRowCount + 1;
        newOption.value = document.getElementById('selectnum').text;
        newOption.innerText = currentRowCount + 1;
        document.getElementById('selectnum').appendChild(newOption);
        document.getElementById('selectnum').value = newOption.value;
    }else{
        document.getElementById('selectnum').value =+ currentRowCount + 1;
        document.getElementById('selectnum').text =+ currentRowCount + 1;
    }
});

document.getElementById('subtractRowBtn').addEventListener('click', function() {
    var itemsContainer = document.getElementById('itemsContainer');
    if (itemsContainer.children.length > 0) {
        itemsContainer.removeChild(itemsContainer.lastElementChild);
        document.getElementById('selectnum').value =+ itemsContainer.children.length;
    }
});

function addItemRow(index) {
    var itemRow = `
        <div class="item-row w-full flex">
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-6">
                <label for="inputSelectMaterial${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">MATERIAL</label>
                <select id="inputSelectMaterial${index}" name="inputSelectMaterial${index}" class="text-center text-lg sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="handleSelect(event)">
                    <option value="" disabled selected>-- MATERIAL --</option>
                    <option value="createnewITEM">++ CREATE NEW ++</option>
                    @foreach ($materials as $data)
                    <option value="{{ $data->Material_id }}">
                        {{ $data->Material_Engname . ' ' . $data->Material_Khname}}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                <label for="QtyMaterial${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">NET WEIGHT</label>
                <input type="number" id="QtyIMaterial${index}" name="QtyMaterial${index}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                <label for="inputSelectUOM${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">UOM</label>
                <select id="inputSelectUOM${index}" name="inputSelectUOM${index}" class="text-center text-lg sm:text-sm font-medium border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected>-- UOM --</option>
                    @foreach ($uom as $data)
                    <option value="{{ $data->UOM_id }}">
                        {{ $data->UOM_name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                <label for="Material_Qty${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">QTY</label>
                <input type="number" id="Material_Qty${index}" name="Material_Qty${index}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="updateTotalPrice()">
            </div>
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                <label for="price${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">PRICE</label>
                <input type="number" id="price${index}" name="price${index}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" step="any" oninput="updateTotalPrice()">
            </div>
            <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                <label for="sub_total${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">SUB TOTAL</label>
                <input type="number" id="sub_total${index}" name="sub_total${index}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" step="any" oninput="updateTotalPrice()">
            </div>
                <div class="flex flex-col items-center w-full sm:w-1/5 px-2 mb-8">
                    <label for="expired_Date${index}" class="block text-lg sm:text-sm font-medium text-gray-900 mb-1">EXPIRY DATE</label>
                    <input type="date" id="expired_Date${index}" name="expired_Date${index}" class="text-center border border-gray-300 rounded-md px-3 py-1 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
        </div>
    `;
    document.getElementById('itemsContainer').insertAdjacentHTML('beforeend', itemRow);
}
var orderDateField = document.getElementById('order_date');
    var today = new Date().toISOString().split('T')[0];
    orderDateField.value = today;

var today = new Date().toISOString().split('T')[0];
var orderNumberField = document.getElementById('Order_number');
orderNumberField.value = $orderNumber;
function updateTotalPrice() {
    var totalPriceField = document.getElementById('Total_Price');
    var itemsContainer = document.getElementById('itemsContainer');
    var priceInputs = itemsContainer.querySelectorAll('input[id^="price"]');
    var qtyInputs = itemsContainer.querySelectorAll('input[id^="Material_Qty"]');
    var subTotalInputs = itemsContainer.querySelectorAll('input[id^="sub_total"]');
    var totalPrice = 0;

    // Iterate over each item row
    priceInputs.forEach(function(input, index) {
        var price = parseFloat(input.value) || 0;
        var qty = parseFloat(qtyInputs[index].value) || 0;
        var subTotal = price * qty;
        subTotalInputs[index].value = subTotal.toFixed(2);
        totalPrice += subTotal;
    });
    totalPriceField.value = totalPrice.toFixed(2);
}

// Attach the updateTotalPrice function to price and quantity input fields
document.addEventListener('input', function(event) {
    if (event.target.id.startsWith('price') || event.target.id.startsWith('Material_Qty')) {
        updateTotalPrice();
    }
});


function handleSelect(event) {
    var selectedValue = event.target.value;
    if (selectedValue === 'createnewITEM') {
        togglePopup('popupItem');
    }else if (selectedValue === 'createnewSUPPLIER') {
        togglePopup('popupSupplier');
    }
}

function togglePopup(popupId) {
        const popup = document.getElementById(popupId);
        popup.classList.toggle('hidden');
    }

document.getElementById('closeOrderPopup').addEventListener('click', function() {
    togglePopup('popupOrder');
});


</script>
