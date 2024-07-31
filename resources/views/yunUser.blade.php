<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto p-4">
            <form action="{{ Route('yunUser.rank') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">URL</label>
                    <input type="text" id="url" name="url" value="@if(!empty($url)){{$url}} @endif"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Submit
                </button>
            </form>
        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                @if(!empty($saveRes))
<!--                    --><?php //var_dump($comments) ?>
                    <div class="container mx-auto p-4">
                        {{$saveRes['total']}}条
                    </div>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>

