<!-- Navbar -->
<nav class="fixed top-0 bg-white bg-opacity-75 backdrop-filter backdrop-blur-lg w-full z-50 md:block hidden">
  <div class="max-w-6xl mx-auto px-4">
      <div class="flex justify-between">
          <div class="flex w-full">
              <div>
                  <!-- Logo Website -->
                  <a href="/Beranda" class="flex items-center py-4">
                      <img src="/imgs/logo-ThreadLoop2-warna-hitam.svg" alt="Logo" class="w-48 h-12">
                  </a>
              </div>
              <!-- Menu Utama -->
              <div class="hidden md:flex lg:flex lg:justify-center md:justify-center -ml-32 w-full items-center space-x-5">
                  {{-- Home --}}
                  <a href="{{ url('/Beranda') }}" class="py-4 px-2 {{ Request::is('Beranda') ? 'border-b-4 border-abu-tua text-abu-tua' : 'text-abu-muda' }} font-semibold hover:text-abu-tua transition duration-300">
                      <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                      </svg>
                  </a>
                  {{-- Cari --}}
                  <a href="{{ url('/search') }}" class="py-4 px-2 {{ Request::is('search') ? 'border-b-4 border-abu-tua text-abu-tua' : 'text-abu-muda' }} font-semibold hover:text-abu-tua transition duration-300">
                      <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                          <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                      </svg>
                  </a>
                  {{-- Create --}}
                  <a data-modal-target="modal-login" data-modal-toggle="modal-login" class="py-4 px-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-abu-muda font-semibold hover:text-abu-tua transition duration-300" viewBox="0 0 24 24" fill="currentColor"><path d="M16.7574 2.99677L14.7574 4.99677H5V18.9968H19V9.23941L21 7.23941V19.9968C21 20.5491 20.5523 20.9968 20 20.9968H4C3.44772 20.9968 3 20.5491 3 19.9968V3.99677C3 3.44448 3.44772 2.99677 4 2.99677H16.7574ZM20.4853 2.09727L21.8995 3.51149L12.7071 12.7039L11.2954 12.7063L11.2929 11.2897L20.4853 2.09727Z"></path></svg>
                  </a>
                  {{-- Suka --}}
                  <a data-modal-target="modal-login" data-modal-toggle="modal-login" class="py-4 px-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-abu-muda font-semibold hover:text-abu-tua transition duration-300" viewBox="0 0 24 24" fill="currentColor"><path d="M16.5 3C19.5376 3 22 5.5 22 9C22 16 14.5 20 12 21.5C9.5 20 2 16 2 9C2 5.5 4.5 3 7.5 3C9.35997 3 11 4 12 5C13 4 14.64 3 16.5 3ZM12.9339 18.6038C13.8155 18.0485 14.61 17.4955 15.3549 16.9029C18.3337 14.533 20 11.9435 20 9C20 6.64076 18.463 5 16.5 5C15.4241 5 14.2593 5.56911 13.4142 6.41421L12 7.82843L10.5858 6.41421C9.74068 5.56911 8.5759 5 7.5 5C5.55906 5 4 6.6565 4 9C4 11.9435 5.66627 14.533 8.64514 16.9029C9.39 17.4955 10.1845 18.0485 11.0661 18.6038C11.3646 18.7919 11.6611 18.9729 12 19.1752C12.3389 18.9729 12.6354 18.7919 12.9339 18.6038Z"></path></svg>
                  </a>
                  {{-- Profile --}}
                  <a data-modal-target="modal-login" data-modal-toggle="modal-login" class="py-4 px-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-abu-muda font-semibold hover:text-abu-tua transition duration-300" viewBox="0 0 24 24" fill="currentColor"><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H18C18 18.6863 15.3137 16 12 16C8.68629 16 6 18.6863 6 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11Z"></path></svg>
                  </a>
              </div>
          </div>
          <!-- Tombol Login -->
          <div class="hidden md:flex items-center space-x-3 ">
              <a href="/login" class="py-2 px-5 font-medium text-white bg-abu-tua rounded-full hover:bg-abu-muda hover:text-white transition duration-300">Login</a>
          </div>
      </div>
  </div>
</nav>

{{-- navbar mobile --}}
<div class="fixed md:hidden lg:hidden z-40 inset-x-0 bottom-0 bg-white shadow-md">
  <div class="flex justify-around items-center py-2">
    <a href="/Beranda" class="flex flex-col items-center {{ request()->is('Beranda') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
     <ion-icon class="w-7 h-7 font-bold" name="home-outline"></ion-icon>
      <span class="text-xs">Home</span>
    </a>
    <a href="/search" class="flex flex-col items-center {{ request()->is('search') ? 'text-black' : 'text-gray-600' }} dark:text-white hover:text-black dark:hover:bg-gray-700">
     <ion-icon class="w-7 h-7 font-bold" name="search-outline"></ion-icon>
      <span class="text-xs">Cari</span>
    </a>
    <a data-modal-toggle="modal-login" data-modal-target="modal-login" class="flex flex-col items-center text-black">
     <ion-icon class="w-7 h-7 font-bold" name="cloud-upload-outline"></ion-icon>
      <span class="text-xs">Posting</span>
    </a>
    <a data-modal-target="modal-login" data-modal-toggle="modal-login" class="flex flex-col items-center relative text-gray-600 dark:text-white hover:text-black dark:hover:bg-gray-700">
     <div class="relative">
       <ion-icon class="w-7 h-7 font-bold" name="heart-outline"></ion-icon>
     </div>
     <span class="text-xs">Activity</span>
   </a>    
    <a data-modal-target="modal-login" data-modal-toggle="modal-login" class="flex flex-col items-center text-gray-600 dark:text-white hover:text-black dark:hover:bg-gray-700">
     <ion-icon class="w-7 h-7 font-bold" name="person-circle-outline"></ion-icon>
      <span class="text-xs">Profile</span>
    </a>
  </div>
</div>

  {{-- modal login --}}
  @include('guest.modal-login')