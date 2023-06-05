<section>
    <header>
        <a href="{{ route('profile.index', $user->id) }}" title="back"><i class="fas fa-chevron-left"></i></a>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('content.profile-info') }}
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data" onsubmit="return validateBirthdateForm()" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div class="mt-4">
            <x-input-label for="avatar" :value="__('content.profile-pic')" />
            <x-file-input id="avatar" class="block mt-1 w-full" name="avatar" accept="image/*" style="padding: 1em" />
        </div>

        <!-- Profile Description -->
        <div>
            <x-input-label for="profile_description" :value="__('content.profile-describe')" />
            <x-textarea id="profile_description" class="block mt-1 w-full" name="profile_description" :content="$user->profile_description" autofocus/>
            <x-input-error class="mt-2" :messages="$errors->get('profile_description')" />
        </div>

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('data.table.fname')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('data.table.lname')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('data.table.email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('content.unverified-email') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Address -->
        <div>
            <x-input-label for="address" :value="__('data.table.address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->address)" autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('data.table.phone')" />
            <x-text-input id="phone_number" name="phone_number" type="text" maxlength="13" oninput="formatInput()" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <!-- Birthdate -->
        <div>
            <x-input-label for="birthdate" :value="__('data.table.birthdate')" />
            <x-text-input id="birthdate" name="birthdate" type="date" max="" class="mt-1 block w-full" :value="old('birthdate', $user->birthdate)" autofocus autocomplete="birthdate"/>
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label :value="__('data.table.gender')" />
            <select id="gender_id" class='border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full mt-1 py-2 px-4' name="gender_id">
                <option value="" disabled selected>{{ __('content.profile-gender') }}</option>
                @foreach ($genders as $gender)
                    <option class="!py-4" value="{{ $gender->id }}" {{ $user->gender == $gender ? 'selected' : '' }}>{{ $gender->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('gender_id')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('content.save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>

    <script>
        // Récupérer tous les inputs de type date avec la classe "birthdate-input"
        const birthdateInputs = document.querySelectorAll('.birthdate-input');
        
        // Pour chaque input, ajouter un écouteur d'événement "change"
        birthdateInputs.forEach(input => {
            input.addEventListener('change', e => {
            // Récupérer la date au format "yyyy-mm-dd"
            const date = e.target.value;
            
            // Convertir la date en format "dd/mm/yyyy"
            const parts = date.split('-');
            const newDate = `${parts[2]}/${parts[1]}/${parts[0]}`;
            
            // Modifier la valeur de l'input avec la nouvelle date
            e.target.value = newDate;
            });
        });

        function formatInput() {
            const input = document.getElementById('phone_number');
            let phone = input.value.replace(/\D/g,''); // garder seulement les chiffres

            // Ajouter les espaces selon la position souhaitée
            if (phone.length > 3) {
                phone = phone.slice(0, 3) + ' ' + phone.slice(3);
            }

            if (phone.length > 6) {
                phone = phone.slice(0, 6) + ' ' + phone.slice(6);
            }

            if (phone.length > 10) {
                phone = phone.slice(0, 10) + ' ' + phone.slice(10);
            }

            input.value = phone;
        }

        function validateBirthdateForm() {
            const input = document.getElementById('birthdate');
            const birthdate = new Date(input.value);
            const current = new Date();
            const minAge = 10; // âge minimum autorisé
            const maxAge = 100; // âge maximum autorisé

            // Calculer l'âge en millisecondes
            const ageInMs = current - birthdate;

            // Convertir en années (arrondi à 2 décimales)
            const ageInYears = parseFloat((ageInMs / 31556952000).toFixed(2));

            // Vérifier si la date est acceptable (inférieure à aujourd'hui et âgée d'au moins 10 ans et au plus 100 ans)
            if (birthdate >= current || ageInYears < minAge || ageInYears > maxAge) {
                const alertMessage = "Please enter a valid birthdate.";
                // alert(alertMessage);
                const alertBox = document.getElementsByClassName('alert')[0];
                alertBox.innerHTML = alertMessage;
                alertBox.style.display = 'block';
                return false;
            } else {
                return true;
            }
        }

        // Définir la date maximale comme étant la date actuelle
        document.getElementById('birthdate').max = new Date().toISOString().split("T")[0];
    </script>

    <style>
        .alert {
            position: fixed;
            top: 1em;
            right: 40%;
            background-color: #c925197c;
            backdrop-filter: blur(10px);
            color: white;
            padding: 20px;
            border-radius: 10px;
            z-index: 1;
            display: none;
            text-align: center;
        }
    </style>

    <div class="alert"></div>

</section>
