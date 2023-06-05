<div>
    <!-- Comments -->
    <div class="flex flex-col my-6 mx-auto md:max-w-5xl md:py-6 md:flex-row items-start rounded-xl bg-white dark:bg-gray-800">
        <!-- Create a comments section here -->
        <form wire:submit.prevent="addComment" class="flex w-full">
            @csrf
            <div class="flex flex-col w-full justify-center items-start p-6">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-gray-200">{{ __('content.comment-section') }}
                </h1>
                <div class="flex flex-col md:flex-row md:space-y-1 space-y-6 w-full justify-between">
                    <x-textarea id="content" placeholder="{{ __('content.comment-placeholder') }}" class="block mt-1 py-2 w-full h-11" name="content" wire:model.defer="content" :value="old('content')" :content=" old('content') " autofocus required/>
                    <x-primary-button class="md:ml-6 h-9">
                        {{ __('content.create-comment') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>

    <!-- List of comments -->
    @forelse ($comments as $comment)
    <div class="flex flex-col my-6 mx-auto md:max-w-5xl md:py-6 md:flex-row items-start rounded-xl bg-white dark:bg-gray-800 dark:text-gray-200">

        <!-- User's comments -->
        
        <div class="px-6 w-full border-b-2 pb-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center mb-6">
                    <img src="{{ asset('storage/users-avatar/'.$comment->user->avatar) }}" alt="img" class="w-6 h-6 rounded-full object-cover">
                    <div class="ml-6 flex items-center">
                        <div>{{ $comment->user->name }} |</div>
                        <div class=" ms-2 text-xs italic text-gray-500 dark:text-gray-400 text-center"> 
                            {{ $comment->created_at->diffForHumans() }} 
                            <i class="fi fi-rr-time-quarter-to"></i>
                        </div>
                    </div>
                </div>
                @if (Auth::user()->id == $comment->user->id)
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="pb-2 font-bold text-lg items-center">. . .</div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Delete Comment -->
                        <x-dropdown-link class="cursor-pointer" wire:click="deleteComment({{ $comment->id }})">
                            {{ __('content.delete') }}
                        </x-dropdown-link>
                        <!-- Edit Comment -->
                        <x-dropdown-link class="cursor-pointer" wire:click="editComment({{ $comment->id }})">
                            {{ __('content.edit') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endif
            </div>

            <!-- Edit Comment -->
            @if ($editingCommentId == $comment->id)
                <form wire:submit.prevent="updateComment" class="fixed top-1/3 md:top-[40vh] md:left-[45vh] h-auto md:max-h-80 md:w-1/2 w-[90vw] bg-gray-100 py-5 px-4 rounded-md dark:bg-gray-700 dark:text-gray-200 drop-shadow-lg shadow-gray-800">
                    @csrf
                    <h1 class="text-3xl my-6 font-bold">{{ __('content.edit-comment') }}</h1>
                    <x-textarea rows="3" id="newContent" class="bg-gray-100 block mt-1 w-full h-auto max-h-80 resize-none" name="newContent" wire:model.defer="newContent" :content="$newContent"></x-textarea>
                    <div class="mt-2 flex justify-between">
                        <x-primary-button>
                            {{ __('content.save-comment') }}
                        </x-primary-button>
                        <x-primary-button wire:click="cancelEdit()">
                            {{ __('content.cancel') }}
                        </x-primary-button>
                    </div>
                </form>
            @else
                <x-textarea rows="3" id="title" class="bg-gray-100 block mt-1 w-full h-auto max-h-80 resize-none dark:text-gray-400" :content="$comment->content" readonly></x-textarea>
            @endif
        </div>
        
    </div>
    @empty
        <div class="my-6 p-6 mx-auto md:max-w-5xl md:py-6 md:flex-row items-start rounded-xl bg-white dark:bg-gray-800 dark:text-gray-400">
            {{ __('content.no-comment') }}
        </div>
    @endforelse

    <!-- Pagination -->
    <div class="my-6 p-6 mx-auto md:max-w-5xl md:py-6 md:flex-row items-start rounded-xl bg-white dark:bg-gray-800 dark:text-gray-200">
        {{ $comments->links() }}
    </div>
</div>
