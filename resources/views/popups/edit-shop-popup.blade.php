<!-- Overlay -->
<div class="edit-popup-shop-overlay hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

<!-- Popup -->
<div class="edit-popup-shop hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-[600px] max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-4 py-3">
            <h2 class="text-2xl font-bold text-white">EDIT SHOP</h2>
        </div>
        <form id="editshopForm" class="space-y-3 px-6 py-2" method="POST" enctype="multipart/form-data">
            @csrf <!-- Laravel CSRF token -->
            <input type="hidden" name="_method" value="PATCH"> <!-- Method Spoofing -->
            
            <label class="block mb-1 font-semibold text-center text-lg">LOGO :</label>
            <div class="relative">
                <img src="images/shop.jpg" id="shop-pic-preview" class="mt-2 h-48 w-full rounded-md mx-auto object-cover shadow-lg" alt="Shop Picture Preview">
                <input type="file" id="shop-pic" class="hidden" name="S_logo">
                <div class="absolute inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 rounded-md opacity-0 transition-opacity duration-300 hover:opacity-100 cursor-pointer" onclick="document.getElementById('shop-pic').click();">
                    <i class="fas fa-edit text-white text-3xl"></i>
                </div>
            </div>
            <div class="py-2 w-full text-start">
                <div class="mb-3">
                    <label for="shop-name" class="block mb-1">NAME :</label>
                    <input type="text" id="shop-name" name="S_name" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-between space-x-3 mb-3">
                    <div class="flex-1">
                        <label for="location-name1" class="block mb-1">Address 1:</label>
                        <textarea id="location-name1" name="" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                    </div>
                    <div class="flex-1">
                        <label for="location-name2" class="block mb-1">Address 2:</label>
                        <textarea id="location-name2" name="" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3"></textarea>
                    </div>
                </div>
            </div>            
            <div class="flex justify-end mt-3">
                <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded-md hover:bg-blue-600 transition">UPDATE</button>
                <button type="button" id="close-popup-shop" class="ml-2 bg-gray-300 text-gray-700 px-3 py-2 rounded-md hover:bg-gray-400 transition">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editPopup = document.querySelector('.edit-popup-shop');
    const overlay = document.querySelector('.edit-popup-shop-overlay');
    const closeBtn = document.getElementById('close-popup-shop');
    const fileInput = document.getElementById('shop-pic');
    const previewImage = document.getElementById('shop-pic-preview');
    const form = document.getElementById('editshopForm');

    document.querySelectorAll('.edit-button-shop').forEach(button => {
        button.addEventListener('click', () => {
            const shopId = button.dataset.s_id;
            const shopName = button.dataset.shopName || '';
            const locationName1 = button.dataset.locationName1 || '';
            const locationName2 = button.dataset.locationName2 || '';
            const shopImage = button.dataset.shopImage || 'images/shop.jpg'; // Use default image if none provided

            // Set form action dynamically
            form.action = `/setting/${shopId}`;
            
            // Populate form fields
            document.getElementById('shop-name').value = shopName;
            document.getElementById('location-name1').value = locationName1;
            document.getElementById('location-name2').value = locationName2;
            if (!locationName1) {
                document.getElementById('location-name1').parentElement.classList.add('hidden');
            } else {
                document.getElementById('location-name1').parentElement.classList.remove('hidden');
            }

            if (!locationName2) {
                document.getElementById('location-name2').parentElement.classList.add('hidden');
            } else {
                document.getElementById('location-name2').parentElement.classList.remove('hidden');
            }
            // Set the preview image
            previewImage.src = shopImage;

            // Show the edit popup
            editPopup.classList.remove('hidden');
            overlay.classList.remove('hidden');
        });
    });

    closeBtn.addEventListener('click', () => {
        editPopup.classList.add('hidden');
        overlay.classList.add('hidden');
    });

    fileInput.addEventListener('change', event => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => previewImage.src = reader.result;
            reader.readAsDataURL(file);
        }
    });

    form.addEventListener('submit', () => {
        editPopup.classList.add('hidden');
        overlay.classList.add('hidden');
    });
});

</script>
