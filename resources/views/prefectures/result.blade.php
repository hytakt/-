<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{ $only_pref->prefecture }}で聖地巡礼！</h1>
    </x-slot>
    <div class="p-6">
        @foreach($only_pref->posts as $post)
        <div class="mb-6 p-4 border rounded-lg shadow-md">
            <a class="text-xl text-indigo-600 hover:underline" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            <div class="mt-2">
                @foreach($post->images as $test)
                <img src="{{ $test->image_path }}" alt="{{ $post->title }}" class="w-32 h-32 object-cover rounded-lg shadow-md inline-block mr-4 mb-4">
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>
