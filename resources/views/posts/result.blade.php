<x-app-layout>
    <x-slot name="header">
        <h1 class="text-4xl font-semibold">{{ $result->prefecture }}で聖地巡礼！</h1>
    </x-slot>
    <div class="p-6">
        <div class="mt-4">
        <form method="GET" action="{{ route('search') }}" class="flex items-center border overflow-hidden">
            @csrf
            <select class="form-control" id="pref" name="pref">
                @foreach($prefectures as $pref)
                <option value="{{ $pref->id }}">{{ $pref->prefecture }}</option>
                @endforeach
            </select>
            <input class="form-control" name="search" type="text" placeholder="検索..." aria-label="Search">
            <button class="input-group-text border-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
    <div>
        @foreach($result->posts as $post)
        <div class="mb-6 p-4 border rounded-lg shadow-md">
            <a class="text-xl text-indigo-600 hover:underline" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            <div class="mt-2">
                @foreach($post->images as $image)
                <img src="{{ $image->image_path }}" alt="{{ $post->title }}" class="w-32 h-32 object-cover rounded-lg shadow-md inline-block mr-4 mb-4">
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

</x-app-layout>
