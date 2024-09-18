@extends('layouts.setting')

@section('content')
<div class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-center text-3xl font-bold mb-4">DETAIL INGREDIENT INFORMATION</h1>
        <div class="relative flex w-full md:w-auto">
            <form id="searchForm" method="GET" class="w-full md:w-auto flex items-center relative">
                <input id="searchInput" type="text" placeholder="Search..." class="border border-input rounded-full py-1 px-4 pl-10 w-full md:w-auto focus:outline-none focus:ring-2 focus:ring-primary" required />
                <button type="submit" class="bg-gray-200 rounded-full py-1 px-4 absolute right-0 top-0 mt-1 mr-2 flex items-center justify-center" aria-label="Search">
                    <i class="fas fa-search text-gray-500"></i>
                </button>
            </form>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 gap-4 mt-2">
            <!-- Loop through menus -->
            @foreach ($menuIngredients as $menuId => $ingredients)
            <div class="bg-white p-2 rounded-lg shadow-md flex flex-col">
                <img src="images/shop.jpg" alt="menu Image" class="w-full h-20 object-cover rounded-t-lg">
                <div class="p-2 flex-grow">
                    <h2 class="text-sm text-gray-800 mb-1 font-semibold">{{ $ingredients->first()->Menu_ENGName }}</h2>
                    <h3 class="text-sm text-gray-900 mb-2 font-semibold"><u>Ingredients</u></h3>
                    <!-- Loop through ingredient details -->
                    @foreach ($ingredients as $data)
                        <div class="mb-2">
                            <h3 class="text-sm text-gray-700">{{ $data->Material_ENGName . '    ' . $data->Qty . '    ' . $data->UOM}}</h3>
                        </div>
                    @endforeach
                </div>
                <div class="mt-auto flex justify-between p-2">
                    <div class="relative group">
                        <button class="edit-ingredient-btn bg-blue-500 text-white px-3 py-1 rounded cursor-pointer transition duration-300 hover:bg-blue-600"
                            data-menu-id="{{ $menuId }}"
                            data-menu-name="{{ $ingredients->first()->Menu_ENGName }}"
                            data-ingredients='@json($ingredients)'>
                            <i class="fas fa-edit fa-sm"></i>
                            <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Edit</span>
                        </button>
                    </div>
                    <div class="relative group">
                        <button class="add-ingredient-btn bg-green-500 text-white px-3 py-1 rounded cursor-pointer transition duration-300 hover:bg-green-600"
                            data-menu-id="{{ $menuId }}">
                            <i class="fas fa-plus-circle fa-sm"></i> 
                            <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Add</span>
                        </button>
                    </div>
                    <div class="relative group">
                        <button class="toggle-button px-3 py-1 rounded cursor-pointer transition duration-300" 
                            onclick="toggleActive(this)"
                            onmouseover="setHover(this, true)"
                            onmouseout="setHover(this, false)"
                            style="background-color: #008000; color: white;">
                            <i class="fas fa-toggle-on fa-sm"></i>
                            <span class="absolute left-1/2 transform -translate-x-1/2 bottom-full mb-2 text-xs text-white bg-gray-600 px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Active</span>
                        </button>
                    </div>
                </div>                
            </div>
            @endforeach
        </div>
        <div class="mt-4">
            {{ $invMenu->links() }}
        </div>
        @include('popups.edit-ingredient-menu-popup')
        @include('popups.add-ingredient-menu-popup')
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editIngredientPopup = document.getElementById('EditIngredientPopup');
    const closeEditIngredientPopup = document.getElementById('closeEditIngredientPopup');

    document.querySelectorAll('.edit-ingredient-btn').forEach(button => {
        button.addEventListener('click', () => {
            const menuName = button.getAttribute('data-menu-name');
            const ingredients = JSON.parse(button.getAttribute('data-ingredients'));
            const menuId = button.getAttribute('data-menu-id');

            // Update the popup
            const popupLabel = editIngredientPopup.querySelector('h2');
            if (popupLabel) {
                popupLabel.textContent = ` ${menuName}`;
            }

            const form = editIngredientPopup.querySelector('form');
            if (form) {
                form.action = `/ingredient/edit/${menuId}`;
                form.querySelector('input[name="Menu_id"]').value = menuId;
            }

            const ingredientsContainer = document.getElementById('ingredientsContainer');
            ingredientsContainer.innerHTML = '';

            ingredients.forEach(ingredient => {
                const formHTML = `
                <div class="mb-4">
                    <label class="block text-md font-semibold text-gray-900 mb-1">INGREDIENT</label>
                    <select id="IIQ_name" name="IIQ_id[]" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 mb-1" onchange="handleSelect(event)">
                        <option value="" disabled selected>-- INGREDIENT NAME --</option>
                        <option value="createINGR">++ CREATE NEW ++</option>
                        ${ingredientOptions(ingredient.IIQ_id)}
                    </select>
                </div>
                `;
                
                ingredientsContainer.insertAdjacentHTML('beforeend', formHTML);
            });

            editIngredientPopup.classList.remove('hidden');
        });
    });

    closeEditIngredientPopup.addEventListener('click', () => {
        editIngredientPopup.classList.add('hidden');
    });
});

// Helper function to generate options
function ingredientOptions(selectedId) {
    let options = '';
    @foreach ($ingredientQty as $data)
        options += `<option value="{{ $data->IIQ_id }}" ${selectedId === '{{ $data->IIQ_id }}' ? 'selected' : ''}>
                        {{ $data->IIQ_name }}
                    </option>`;
    @endforeach
    return options;
}

function toggleActive(button) {
    const icon = button.querySelector('i');
    const activeText = button.querySelector('span');
    
    if (icon.classList.contains('fa-toggle-on')) {
        icon.classList.remove('fa-toggle-on');
        icon.classList.add('fa-toggle-off');
        activeText.textContent = 'Inactive';
        button.style.backgroundColor = '#f00';
    } else {
        icon.classList.remove('fa-toggle-off');
        icon.classList.add('fa-toggle-on');
        activeText.textContent = 'Active';
        button.style.backgroundColor = '#008000';
    }
}

function setHover(button, isHover) {
    if (button.querySelector('i').classList.contains('fa-toggle-on')) {
        button.style.backgroundColor = isHover ? '#006400' : '#008000';
    } else {
        button.style.backgroundColor = isHover ? '#a11' : '#f00';
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const addIngredientPopup = document.getElementById('popupAddMenuIngr');
    const closeAddIngredientPopup = document.getElementById('closePopup');

    document.querySelectorAll('.add-ingredient-btn').forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            const menuId = button.getAttribute('data-menu-id');

            // Update the popup form with the selected Menu_id
            const menuIdInput = addIngredientPopup.querySelector('input[name="Menu_id"]');
            if (menuIdInput) {
                menuIdInput.value = menuId;
            }

            // Show the popup
            addIngredientPopup.classList.remove('hidden');
        });
    });

    closeAddIngredientPopup.addEventListener('click', () => {
        addIngredientPopup.classList.add('hidden');
    });
});
function handleSelect(event) {

var selectedValue = event.target.value;

if (selectedValue === 'createINGR') {

    togglePopup('popupCreateMenuIngr');

}

}

</script>

@endsection