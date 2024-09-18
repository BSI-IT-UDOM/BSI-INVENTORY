<img src="{{ Auth::user()->U_photo ? asset('storage/' . Auth::user()->U_photo) : asset('images/user.jpg') }}"  alt="Admin Profile" class="h-10 w-10 rounded-full mr-5 cursor-pointer" id="profileDropdownToggle">
<div id="profileDropdown" class="hidden absolute right-1 mt-2 w-52 bg-white rounded-md shadow-lg border-2 border-bsicolor z-10">
    <div class="py-0">
        <a href="dashboard" class="block px-4 py-2 text-sm md:text-lg text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-md">DASHBOARD</a>
        <a href="#" class="block px-5 py-3 text-sm md:text-lg text-gray-700 hover:bg-gray-100 hover:text-gray-900 rounded-md" id="editProfile">PROFILE</a>
        <a href="setting" class="block px-4 py-2 text-sm md:text-lg text-gray-700 hover:bg-gray-100 hover:text-gray-900 border-b-2 border-bsicolor rounded-md">SETTING</a>
        <a class="block px-4 py-2 text-sm md:text-lg text-gray-700 hover:bg-gray-100 hover:text-gray-900" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            {{ __('LOG OUT') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileDropdownToggle = document.getElementById('profileDropdownToggle');
        const profileDropdown = document.getElementById('profileDropdown');
  
        profileDropdownToggle.addEventListener('click', function () {
            profileDropdown.classList.toggle('hidden');
        });
        document.addEventListener('click', function (event) {
            if (!profileDropdownToggle.contains(event.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    });
  </script>

<style>
    #logout-form{
   margin-top: -15px;
  }
</style>
