<x-app-layout>
    <div id="myModal" class="modal transition-all">
        <span class="close hover:scale-110 transition-all ease-in-out delay-100">&times;</span>
        <div class="">
            <img src="" alt="avatar" 
                class="modal-content h-screen object-contain mx-auto">
        </div>
    </div>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('navigation.edit-profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Profile Photo -->
            <div id="pic" class="w-full flex justify-center">
                <a href="#pic" class="avatar-link">                
                    <img src="{{ asset('storage/users-avatar/'.Auth::user()->avatar) }}" alt="avatar" class="w-40 h-40 rounded-full hover:scale-105 transition-all ease-in-out delay-100 object-cover border-8 border-gray-200 dark:border-gray-800">
                </a>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
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
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.9);
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
    var imgLink = document.querySelector('.avatar-link');

    // Lorsque l'utilisateur clique sur le lien, ouvrir la modale avec l'image agrandie
    imgLink.onclick = function() {
    var modal = document.getElementById("myModal");
    var modalImg = document.querySelector(".modal-content");

    // Récupérer l'url de la photo de profil et l'afficher dans la fenêtre modale
    modal.style.display = "block";
    modalImg.src = "{{ asset('storage/users-avatar/'.Auth::user()->avatar) }}";
    }

    // Obtenir l'élément bouton fermer (x)
    var closeBtn = document.querySelector('.close');

    // Lorsque l'utilisateur clique sur le bouton fermer, fermer la fenêtre modale
    closeBtn.onclick = function() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    }
</script>