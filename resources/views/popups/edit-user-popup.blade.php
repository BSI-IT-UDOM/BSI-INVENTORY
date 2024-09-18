<!-- Overlay -->
<div class="edit-popup-overlay hidden fixed inset-0 bg-black bg-opacity-50 z-50"></div>

<!-- Popup -->
<div class="edit-popup hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-lg max-h-screen overflow-y-auto">
        <div class="bg-gradient-to-b from-blue-500 to-blue-400 rounded-t-lg px-6 py-4">
            <h2 class="text-2xl font-bold text-white">EDIT USER</h2>
        </div>
        <form id="edit-user-form" action="{{ route('updateUser', ['U_id' => $data->U_id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4 px-6 py-2">
            @csrf
            @method('PATCH')

            <div class="relative text-center">
                <input type="hidden" id="U_id" name="U_id" value="{{ $data->U_id }}">

                <label for="profile-pic" class="block mb-1 font-semibold">PHOTO :</label>
                <div class="relative mt-2 h-64 w-64 mx-auto group">
                    <img id="profile-pic-preview" src="{{ $data->U_photo ? asset('storage/' . $data->U_photo) : 'images/user.png' }}" class="h-64 w-64 rounded-full" alt="Profile Picture Preview">
                    <input type="file" id="profile-pic" name="U_photo" class="hidden">
                    <div class="absolute bottom-0 left-0 right-0 h-64 w-64 bg-gray-900 bg-opacity-50 rounded-full flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer" onclick="document.getElementById('profile-pic').click();">
                        <i class="fas fa-edit text-white"></i>
                    </div>
                </div>
            </div>
            
            <div class="flex px-4">
                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="name" class="block mb-1">USERNAME :</label>
                        <input type="text" id="name" name="U_name" value="{{ $data->U_name }}" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="R_id" class="block mb-1">ROLE :</label>
                        <select id="R_id" name="R_id" class="text-center border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            <option value="" disabled selected>-- ROLE --</option>
                            <option value="createRole">++ CREATE NEW ++</option>
                            @foreach ($role as $role)
                            <option value="{{ $role->R_id }}" {{ $role->R_id == old('R_id', $data->R_id) ? 'selected' : '' }}>
                                {{ $role->R_type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="sys_name" class="block mb-1">SYSTEM NAME :</label>
                        <input type="text" id="sys_name" name="sys_name" value="{{ $data->sys_name }}" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="U_contact" class="block mb-1">CONTACT:</label>
                        <input type="text" id="U_contact" name="U_contact" value="{{ $data->U_contact }}" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
                <div class="p-2 w-full">
                    <div class="mb-4">
                        <label for="password" class="block mb-1">OLD PASSWORD :</label>
                        <input type="password" id="password" name="password" value="{{ $data->password }}" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label for="newpassword" class="block mb-1">NEW PASSWORD :</label>
                        <input type="password" id="newpassword" name="newpassword" class="text-center w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">UPDATE</button>
                <button type="button" id="close-popup" class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 transition">CANCEL</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const editPopup = document.querySelector('.edit-popup');
    const overlay = document.querySelector('.edit-popup-overlay');
    const closeBtn = document.getElementById('close-popup');
    const fileInput = document.getElementById('profile-pic');
    const previewImage = document.getElementById('profile-pic-preview');
    const form = document.getElementById('edit-user-form');

    document.querySelectorAll('.edit-button-user').forEach(button => {
        button.addEventListener('click', () => {
            const userId = button.dataset.u_id;  // Note: dataset property names are case-insensitive and converted to lowercase.
            console.log(userId); // Debugging: Check if this logs the correct user ID
            const userName = button.dataset.name || '';
            const roleId = button.dataset.role || '';
            const sysName = button.dataset.sysName || '';
            const userContact = button.dataset.contact || '';
            const userPhoto = button.dataset.photo ? `{{ asset('storage/') }}/${button.dataset.photo}` : `{{ asset('images/user.png') }}`;

            // Set form action dynamically
            form.action = `/user/${userId}`;
            
            // Populate form fields
            document.getElementById('U_id').value = userId;
            document.getElementById('name').value = userName;
            document.getElementById('R_id').value = roleId;
            document.getElementById('sys_name').value = sysName;
            document.getElementById('U_contact').value = userContact;

            // Set the preview image
            previewImage.src = userPhoto;

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
