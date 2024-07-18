<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
       <a href="/Beranda" class="flex items-center ps-2.5 mb-5">
          <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" class=" w-full h-full" alt="ThreadLoop" />
       </a>
       <ul class="space-y-2 font-medium">
          <li>
             <a href="/Home" class="flex items-center p-4 {{ request()->is('Home') ? 'bg-black text-white' : 'text-gray-900' }} text-gray-900 rounded-lg dark:text-white hover:bg-black hover:text-white dark:hover:bg-gray-700 group">
              <ion-icon class="w-7 h-7 font-bold" name="home-outline"></ion-icon>
                <span class="ms-3">Beranda</span>
             </a>
             
          </li>
          <li>
             <a href="/cari" class="flex items-center p-4 {{ request()->is('cari') ? 'bg-black text-white' : 'text-gray-900' }} rounded-lg dark:text-white hover:bg-black hover:text-white dark:hover:bg-gray-700 group">
                <ion-icon class="w-7 h-7 font-bold" name="search-outline"></ion-icon>
                <span class="flex-1 ms-3 whitespace-nowrap">Cari</span>
             </a>
          </li>
          <li>
             <a data-modal-toggle="modalPosting" data-modal-target="modalPosting" class="flex items-center p-4 text-gray-900 rounded-lg dark:text-white hover:bg-black hover:text-white dark:hover:bg-gray-700 group">
                <ion-icon class="w-7 h-7 font-bold" name="cloud-upload-outline"></ion-icon>
                <span class="flex-1 ms-3 whitespace-nowrap">Posting</span>
             </a>
          </li>
          <li>
            <a href="/activity" class="relative flex items-center p-4 {{ request()->is('activity') ? 'bg-black text-white' : 'text-gray-900' }} text-gray-900 rounded-lg dark:text-white hover:bg-black hover:text-white dark:hover:bg-gray-700 group">
               <ion-icon class="w-7 h-7 font-bold" name="heart-outline"></ion-icon>
               @if(isset($hasNewActivities) && $hasNewActivities)
                   <span class="absolute top-0 right-0 mt-1 mr-1 bg-red-500 rounded-full w-2 h-2"></span>
               @endif
               <span class="flex-1 ms-3 whitespace-nowrap">Activity</span>
            </a>
          </li>
          <li>
            <a href="/profile-user" class="flex items-center p-4 {{ request()->is('profile-user') ? 'bg-black text-white' : 'text-gray-900' }} rounded-lg dark:text-white hover:bg-black hover:text-white dark:hover:bg-gray-700 group">
                    @if (auth()->user()->profile_image)
                        <img src="{{ asset('storage/'. auth()->user()->profile_image) }}" alt="{{ auth()->user()->username }}" class="w-7 h-7 rounded-full object-cover">
                    @else
                        <img src="/imgs/avatar.png" alt="{{ auth()->user()->username }}" class="w-7 h-7 rounded-full object-cover">
                    @endif
                <span class="flex-1 ms-3 whitespace-nowrap">Profil</span>
            </a>
          </li> 
       </ul>
   </div>
</aside>

{{-- mobile --}}
<div class="fixed md:hidden lg:hidden z-40 inset-x-0 bottom-0 bg-white shadow-md">
   <div class="flex justify-around items-center py-2">
     <a href="/Home" class="flex flex-col items-center {{ request()->is('Home') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
      <ion-icon class="w-7 h-7 font-bold" name="home-outline"></ion-icon>
       <span class="text-xs">Home</span>
     </a>
     <a href="/cari" class="flex flex-col items-center {{ request()->is('cari') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
      <ion-icon class="w-7 h-7 font-bold" name="search-outline"></ion-icon>
       <span class="text-xs">Cari</span>
     </a>
     <a data-modal-toggle="modalPosting" data-modal-target="modalPosting" class="flex flex-col items-center text-black">
      <ion-icon class="w-7 h-7 font-bold" name="cloud-upload-outline"></ion-icon>
       <span class="text-xs">Posting</span>
     </a>
     <a href="/activity" class="flex flex-col items-center relative {{ request()->is('activity') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
      <div class="relative">
        <ion-icon class="w-7 h-7 font-bold" name="heart-outline"></ion-icon>
        @if(isset($hasNewActivities) && $hasNewActivities)
          <span class="absolute top-0 right-0 mt-0.5 mr-0.5 bg-red-500 rounded-full w-2.5 h-2.5"></span>
        @endif
      </div>
      <span class="text-xs">Activity</span>
    </a>    
     <a href="/profile-user" class="flex flex-col items-center {{ request()->is('profile-user') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
      <ion-icon class="w-7 h-7 font-bold" name="person-circle-outline"></ion-icon>
       <span class="text-xs">Profile</span>
     </a>
   </div>
</div>

  {{-- modal posting --}}
  @include('user-login.modals.modal-posting')