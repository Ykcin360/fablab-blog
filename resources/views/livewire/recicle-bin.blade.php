<?php use App\Models\User; ?>
<div>
    <div class="mb-4 flex justify-around h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
        <a class="px-3 cursor-pointer hover:text-sky-400 {{ $selectedTable == 'User' ? 'text-sky-400' : '' }}"
            wire:click.delay="showUserTable()">Users</a>
        <a class="px-3 cursor-pointer hover:text-sky-400 {{ $selectedTable == 'Post' ? 'text-sky-400' : '' }}"
            wire:click.delay="showPostTable()">Posts</a>
        <a class="px-3 cursor-pointer hover:text-sky-400 {{ $selectedTable == 'Comment' ? 'text-sky-400' : '' }}"
            wire:click.delay="showCommentTable()">Comments</a>
        <a class="px-3 cursor-pointer hover:text-sky-400 {{ $selectedTable == 'Message' ? 'text-sky-400' : '' }}"
            wire:click.delay="showMessageTable()">Messages</a>
    </div>

    {{-- Table --}}
    @if ($selectedTable == 'User')
    <div class="flex justify-around h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
        <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
            <div class="relative overflow-auto rounded-xl">
                <div class="mt-2 overflow-hidden shadow-sm">
                    <table class="w-full table-fixed border-collapse text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Id</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('data.table.name') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 text-slate-500 dark:bg-gray-600 dark:text-gray-200">
                            @foreach ($users as $user)
                            <tr>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $user->id }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $user->name }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    <button class="text-sky-800 dark:text-sky-300" wire:click.delay="restoreUser({{ $user }})">{{
                                        __('content.restore') }}</button>
                                    <button class="ml-6 text-red-600 dark:text-red-400" wire:click.delay="deleteUser({{ $user }})">{{
                                        __('content.delete') }} !</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @elseif ($selectedTable == 'Post')
    <div class="flex justify-around h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
        <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
            <div class="relative overflow-auto rounded-xl">
                <div class="mt-2 overflow-hidden shadow-sm">
                    <table class="w-full table-fixed border-collapse text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Id</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('content.post-title') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('data.table.owner') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 text-slate-500 dark:bg-gray-600 dark:text-gray-200">
                            @foreach ($posts as $post)
                            <tr>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $post->id }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $post->title }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $post->user->name }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    <button class="text-sky-800 dark:text-sky-300" wire:click.delay="restorePost({{ $post }})">{{
                                        __('content.restore') }}</button>
                                    <button class="ml-6 text-red-600 dark:text-red-400" wire:click.delay="deletePost({{ $post }})">{{
                                        __('content.delete') }} !</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @elseif ($selectedTable == 'Comment')
    <div class="flex justify-around h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
        <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
            <div class="relative overflow-auto rounded-xl">
                <div class="mt-2 overflow-hidden shadow-sm">
                    <table class="w-full table-fixed border-collapse text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Id</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('content.comment-section') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('content.post-title') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 text-slate-500 dark:bg-gray-600 dark:text-gray-200">
                            @foreach ($comments as $comment)
                            <tr>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $comment->id }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    "{{ Str::limit($comment->content, 45) }}"</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $comment->post->title }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    <button class="text-sky-800 dark:text-sky-300" wire:click.delay="restoreComment({{ $comment }})">{{
                                        __('content.restore') }}</button>
                                    <button class="ml-6 text-red-600 dark:text-red-400" wire:click.delay="deleteComment({{ $comment }})">{{
                                        __('content.delete') }} !</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @elseif ($selectedTable == 'Message')
    <div class="flex justify-around h-full w-full rounded-2xl bg-white p-4 shadow-lg dark:bg-gray-700">
        <div class="relative overflow-hidden rounded-xl bg-gray-200 dark:bg-gray-800">
            <div class="relative overflow-auto rounded-xl">
                <div class="mt-2 overflow-hidden shadow-sm">
                    <table class="w-full table-fixed border-collapse text-sm">
                        <thead>
                            <tr>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Id</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('navigation.chat') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    {{ __('data.table.owner') }}</th>
                                <th
                                    class="border-b border-gray-300 p-4 pl-8 pt-0 pb-3 text-left font-medium text-gray-900 dark:border-slate-700 dark:text-gray-200">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-100 text-slate-500 dark:bg-gray-600 dark:text-gray-200">
                            @foreach ($messages as $message)
                            <tr>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ $message->id }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    "{{ Str::limit($message->body, 45) }}"</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700 capitalize">
                                    {{ User::find($message->from_id)->name }}</td>
                                <td class="border-b border-slate-100 p-4 pl-8 dark:border-slate-700">
                                    <button class="text-sky-800 dark:text-sky-300" wire:click.delay="restoreMessage({{ $message }})">{{
                                        __('content.restore') }}</button>
                                    <button class="ml-6 text-red-600 dark:text-red-400" wire:click.delay="deleteMessage({{ $message }})">{{
                                        __('content.delete') }} !</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>