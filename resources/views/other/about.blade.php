<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('footer.about') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("Fablab Solidaire Mamiratra") }}
        </h1>
        <img src="{{ asset('img/FSM.png') }}" alt="SOSCV" class="object-contain mb-6">
        <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          {{ __('content.about-content') }}
        </p>
        <div class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          <span class="font-bold">Personne en charge:</span>
          <ul>
            <li>Nom: RANDRIAMBOLOLONA</li>
            <li>Prénom: Yves Eric</li>
            <li>Fonction: FabManager</li>
            <li>Téléphone: +(261) 20 22 418 27</li>
            <li>Mobile: +(261) 32 05 704 40</li>
            <li>E-mail: yves.randriambololona@vesosmad.org</li>
          </ul>
        </div>
        <div class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          <span class="font-bold">Les machines présentes dans un Fablab:</span>
          <ul>
            <li>> Découpeuse Laser (TROTEC) : Une machine permettant des découpes et des gravures laser de grande précision sur tous
            types de supports;</li>
            <li>> Petite Fraiseuse numérique (SRM20) : Elle est destinée l'usinage de petite piece. Cette machine est surtout utilisée
            en électronique pour la conception des cartes imprimées support et conducteur électrique des composants électroniques;</li>
            <li>> Imprimante 3D : C'est une imprimante capable d'exécuter des impressions des pieces en 3 dimensions;</li>
            <li>> Fraiseuse numérique (ShopBot) : C'est une fraiseuse numérique destinée à la conception de grande piece (surtout utilisé
            en menuiserie);</li>
            <li>> Découpeuse Vinyle : C'est une machine destinée la confection de divers autocollants;</li>
            <li>> Matériels électroniques : Ce sont des matériels destinés à la pratique de l'électronique.</li>
          </ul>
        </div>
        <div class="px-8 pb-6 text-gray-700 dark:text-gray-400">
          <span class="font-bold">Coordonnées:</span> SOS Villages d’Enfants Madagascar Près Hotel Panorama - Andrainarivo 101 ANTANANARIVO
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-12">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("SOS Villages d'Enfants") }}
        </h1>
        <div class="">
          <img src="{{ asset('img/SOSVE.png') }}" alt="SOSCV" class="object-contain mb-6">
          <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
            {{ __('content.about-page.sosve') }}
          </p>
        </div>
        <a type="button" data-te-ripple-init data-te-ripple-color="light"
          href="https://vesosmad.org/" target="_blank"
          class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-6">
          <p>{{ __('content.about-page.visit') }} SOS
          Villages d'enfants Website</p>
        </a>
      </div>

      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <h1 class=" font-bold p-6 text-gray-900 dark:text-gray-100 text-xl">
          {{ __("Orange Madagascar") }}
        </h1>
        <div class="">
          <img src="{{ asset('img/FO.jpg') }}" alt="FO" class="object-contain w-full mb-6">
          <p class="px-8 pb-6 text-gray-700 dark:text-gray-400">
            {{ __("content.about-page.orange") }}
          </p>
        </div>
        <a type="button" data-te-ripple-init data-te-ripple-color="light"
          href="https://www.orange.mg/" target="_blank"
          class="w-full bg-sky-600 text-white font-bold text-sm normal-case rounded hover:bg-sky-700 flex items-center justify-center px-2 py-3 mt-6">
          <p>{{ __('content.about-page.visit') }} Orange Madagascar Website</p>
        </a>
      </div>
    </div>
  </div>

  @include('post.partials.footer')
</x-app-layout>