<div>
  <audio id="react">
    <source src="{{ asset('sounds/reaction/React.wav') }}" type="audio/mpeg">
  </audio>

  <audio id="unreact">
    <source src="{{ asset('sounds/reaction/Unreact.wav') }}" type="audio/mpeg">
  </audio>

  <div class="flex w-full justify-around text-xl md:w-1/2 my-2">
    <!-- Like Reaction -->
    <div class="flex items-center justify-center gap-1" title="Like">
      <button wire:click="react('like')" class="text-blue-500 transition-all delay-75 ease-in-out hover:scale-125" 
      onclick="document.getElementById('react').play()">
        <i class="fi fi-rr-social-network @if ($isLikeReacted) hidden @endif"></i>
      </button>
      <button wire:click="unreact('like')"
        class="@if (!$isLikeReacted) hidden @endif transition-all delay-75 ease-in-out hover:scale-125">
        <i class="fi fi-rr-social-network text-white bg-blue-500 rounded-full px-2 py-1" 
        onclick="document.getElementById('unreact').play()"></i>
      </button>
      <span class="ms-1 text-lg dark:text-gray-200">{{ $this->getReactionCount('like') }}</span>
    </div>

    <!-- Heart Reaction -->
    <div class="flex items-center justify-center gap-1" title="Heart">
      <button wire:click="react('heart')" class="text-red-500 transition-all delay-75 ease-in-out hover:scale-125" 
      onclick="document.getElementById('react').play()">
        <i class="fi fi-rr-heart @if ($isHeartReacted) hidden @endif"></i>
      </button>
      <button wire:click="unreact('heart')"
        class="@if (!$isHeartReacted) hidden @endif text-red-500 transition-all delay-75 ease-in-out hover:scale-125">
        <i class="fi fi-rr-heart text-white bg-red-500 rounded-full px-2 py-1" 
        onclick="document.getElementById('unreact').play()"></i>
      </button>
      <span class="ms-1 text-lg dark:text-gray-200">{{ $this->getReactionCount('heart') }}</span>
    </div>

    <!-- Heart Reaction -->
    <div class="flex items-center justify-center gap-1" title="Fire">
      <button wire:click="react('fire')" class="text-orange-500 transition-all delay-75 ease-in-out hover:scale-125" 
      onclick="document.getElementById('react').play()">
        <i class="fi fi-rr-flame @if ($isFireReacted) hidden @endif"></i>
      </button>
      <button wire:click="unreact('fire')"
        class="@if (!$isFireReacted) hidden @endif text-orange-500 transition-all delay-75 ease-in-out hover:scale-125" 
        onclick="document.getElementById('unreact').play()">
        <i class="fi fi-rr-flame text-white bg-orange-500 rounded-full px-2 py-1"></i>
      </button>
      <span class="ms-1 text-lg dark:text-gray-200">{{ $this->getReactionCount('fire') }}</span>
    </div>
  </div>

</div>
