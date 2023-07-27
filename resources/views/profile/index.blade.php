<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ $user->name }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <!-- Profile Photo -->
      <div id="pic" class="w-full flex justify-center">
        <a href="#pic" class="profile-photo-link">
          <img src="{{ asset('storage/users-avatar/'.$user->avatar) }}" alt="profile_photo"
            class="w-40 h-40 rounded-full hover:scale-105 transition-all ease-in-out delay-100 object-cover border-8 border-gray-200 dark:border-gray-800">
        </a>
      </div>

      <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-full">
          <div class="md:flex md:justify-between md:space-y-0 space-y-6">

            <div class=" flex justify-between items-center space-x-4">
              <!-- Role -->
              @if (Auth::user()->is_admin && Auth::user() != $user)
              <a x-data="" x-on:click.prevent="$dispatch('open-modal', 'change-user-role')"
                class="bg-sky-500 hover:bg-sky-600 py-1 px-3 text-gray-200 rounded cursor-pointer">{{
                $user->is_admin ? 'Admin' : __('content.member') }}</a>
              @else
              <div class="bg-sky-500 py-1 px-3 text-gray-200 rounded">{{ $user->is_admin ? 'Admin' : 'Member' }}
              </div>
              @endif

              <!-- Gender -->
              @if ($user->gender_id == 1)
              <div title="{{ __('content.male') }}" class="text-center font-extrabold text-gray-200 rounded-full h-7 w-7 bg-indigo-600">
                &#9794;</div>
              @elseif($user->gender_id == 2)
              <div title="{{ __('content.female') }}" class="text-center font-extrabold text-gray-200 rounded-full h-7 w-7 bg-pink-600">
                &#9792;</div>
              @else
              <div title="{{ __('content.uknown') }}" class="text-center text-gray-200 rounded-full h-7 w-7 bg-gray-600">?</div>
              @endif
            </div>
            @if ( Auth::user() == $user)
            <a href="{{ route('profile.edit') }}">
              <x-primary-button class="mt-6 md:m-0">{{ __('content.edit') }}</x-primary-button>
            </a>
            @endif

          </div>

          <!-- Profile Description -->
          <div class="mt-6">
            <x-input-label for="profile_description" :value="__('data.table.description')" />
            <x-textarea rows=5 id="profile_description" class="block mt-1 w-full resize-none" name="profile_description"
              :content="$user->profile_description" readonly />
          </div>

          <div class="mt-6 md:flex md:justify-between">
            <!-- First Name -->
            <div class="mt-6 w-full md:pe-6">
              <x-input-label for="first_name" :value="__('data.table.fname')" />
              <x-text-input id="first_name" name="first_name" type="text" class="block w-full"
                :value="old('first_name', $user->first_name)" readonly />
            </div>

            <!-- Last Name -->
            <div class="mt-6 w-full">
              <x-input-label for="last_name" :value="__('data.table.lname')" />
              <x-text-input id="last_name" name="last_name" type="text" class="block w-full"
                :value="old('last_name', $user->last_name)" readonly />
            </div>
          </div>

          <div class="mt-6 md:flex md:justify-between">
            <!-- Email -->
            <div class="mt-6 w-full md:pe-6">
              <x-input-label for="email" :value="__('data.table.email')" />
              <x-text-input id="email" name="email" type="text" class="block w-full" :value="old('email', $user->email)"
                readonly />
            </div>

            <!-- Address -->
            <div class="mt-6 w-full">
              <x-input-label for="address" :value="__('data.table.address')" />
              <x-text-input id="address" name="address" type="text" class="block w-full"
                :value="old('address', $user->address)" readonly />
            </div>
          </div>

          <div class="mt-6 md:flex md:justify-between">
            <!-- Phone Number -->
            <div class="mt-6 w-full md:pe-6">
              <x-input-label for="phone_number" :value="__('data.table.phone')" />
              <x-text-input id="phone_number" name="phone_number" type="text" class="block w-full"
                :value="old('phone_number', $user->phone_number)" readonly />
            </div>

            <!-- Birthdate -->
            <div class="mt-6 w-full">
              <x-input-label for="birthdate" :value="__('data.table.birthdate')" />
              <x-text-input id="birthdate" name="birthdate" type="text" class="block w-full"
                :value="old('birthdate', $user->birthdate)" readonly pattern="\d{2}/\d{2}/\d{4}" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal transition-all">
    <span class="close hover:scale-110 transition-all ease-in-out delay-100">&times;</span>
    <img src="" alt="profile_photo" class="modal-content h-screen object-contain mx-auto">
  </div>

  <x-modal name="change-user-role" :show="$errors->userChange->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.role', $user) }}" class="p-6">
      @csrf
      @method('patch')

      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ $user->is_admin ? __('content.role-member') : __('content.role-admin') }}
      </h2>

      <div class="mt-6 flex justify-end">
        <x-secondary-button x-on:click="$dispatch('close')">
          {{ __('content.cancel') }}
        </x-secondary-button>

        <x-primary-button class="ml-3">
          {{ __('content.yes') }}
        </x-primary-button>
      </div>
    </form>
  </x-modal>

  @include('post.partials.footer')

</x-app-layout>

<style>
  /* Cacher la fenetre modale par default */
  .modal {
    display: none;
    position: fixed;
    z-index: 9999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.9);
  }

  /* Style pour le bouton fermer */
  .close {
    color: white;
    font-size: 40px;
    font-weight: bold;
    position: absolute;
    top: 20px;
    right: 30px;
    cursor: pointer;
  }
</style>

<script>
  // Obtenir l'élément a de votre photo de profil
    var imgLink = document.querySelector('.profile-photo-link');

    // Lorsque l'utilisateur clique sur le lien, ouvrir la modale avec l'image agrandie
    imgLink.onclick = function() {
    var modal = document.getElementById("myModal");
    var modalImg = document.querySelector(".modal-content");

    // Récupérer l'url de la photo de profil et l'afficher dans la fenêtre modale
    modal.style.display = "block";
    modalImg.src = "{{ asset('storage/users-avatar/'.$user->avatar) }}";
    }

    // Obtenir l'élément bouton fermer (x)
    var closeBtn = document.querySelector('.close');

    // Lorsque l'utilisateur clique sur le bouton fermer, fermer la fenêtre modale
    closeBtn.onclick = function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    }
</script>