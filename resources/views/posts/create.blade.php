<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('posts') }}">
                        @csrf
                        <h3 class="text-4xl semibold mt-4 mb-8">Create Post</h3>
                        <div class="mt-4">
                            <label for="title">Title</label>
                            <input type="text" id="title" name="title" class="w-full mt-1 py-1 px-3 rounded border border-gray-200">
                            @error('title')
                                <span class="text-red-500 text-xs italic" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                          <label for="body">Body</label>
                          <textarea id="body" name="body" class="w-full mt-1 py-1 px-3 rounded border border-gray-200"></textarea>
                            @error('body')
                                <span class="text-red-500 text-xs italic" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <x-honeypot />

                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 rounded-lg text-white py-1 px-4 focus:outline-none">
                            Create Post
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
