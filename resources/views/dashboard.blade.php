<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            <div>
                <h2 class="text-xl font-bold pt-8 pb-2">
                    Posts of: {{ Auth::user()->name }}
                </h2>
                @foreach(Auth::user()->posts as $post)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-2 text-gray-900 dark:text-gray-100">
                            <h3 class="text-lg font-bold">
                                {{ $post->title }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
