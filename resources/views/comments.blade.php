<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto p-4">
            <form action="{{ Route('comments.feed') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">主题URL</label>
                    <input type="text" id="feed_url" name="feed_url" value="@if(!empty($feedUrl)){{$feedUrl}} @endif"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">评论URL</label>
                    <input type="text" id="comment_url" name="comment_url"
                           value="@if(!empty($commentUrl)){{$commentUrl}} @endif"
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
                <div class="container mx-auto p-4">
                    @if(isset($feed) && !empty($feed))

                        <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                            <h2 class="text-2xl font-bold mb-2">{{$feed['topicContent']['title']}}</h2>
                            @if(!empty($feed['topicContent']['intro']))
                                <p class="text-gray-600">{{$feed['topicContent']['intro']}}</p>
                            @endif
                            @if(!empty($feed['topicContent']['richText']))
                                {{$feed['topicContent']['richText']}}
                            @endif
                            <p class="text-gray-600">{{$feed['topicContent']['content']}}</p>
                            @if(!empty($feed['topicContent']['imageOriginals']))
                                @foreach($feed['topicContent']['imageOriginals'] as $image)
                                    <img src="{{ $image }}" alt="Feed Image" class="mt-4" width="300px"
                                         style="float: left">
                                @endforeach
                            @endif

                            <div style=" clear: both;"></div>
                            <div class="container mx-auto p-4">
                                <div class="flex items-center mb-4">
                                    <div>
                                        <h2 class="text-2xl font-bold mb-2">{{ $feed['user']['userName'] }} </h2>
                                    </div>
                                    <img src="{{ $feed['user']['avatar'] }}" alt="{{ $feed['user']['userName'] }}"
                                         class="w-32 h-32 rounded-full">

                                </div>
                            </div>
                        </div>
                    @endif


                </div>

                @if(isset($comments))
                    <div class="container mx-auto p-4">
                        @foreach($comments as $comment)
                            <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                                <img src="{{ $comment['commentUser']['avatar'] }}" alt="{{ $comment['commentUser']['userName'] }}"
                                     class="w-32 h-32 rounded-full">
                                <p class="text-gray-800 font-bold">{{ $comment['commentUser']['userName'] }}</p>
                                <p class="text-gray-600">@if(!empty($comment['content'])){{ $comment['content'] }}@endif</p>
                                @if(!empty($comment['replyList']))
                                    <div class="mt-4">
                                        @foreach($comment['replyList'] as $reply)
                                            <div class="bg-gray-100 rounded-lg p-4 mb-2">

                                                <img src="{{ $reply['fromUser']['avatar'] }}" alt="{{ $reply['fromUser']['userName'] }}"
                                                     class="w-20 h-20 rounded-full" style="display: inline-block">
                                                <img src="{{ $reply['toUser']['avatar'] }}" alt="{{ $reply['toUser']['userName'] }}"
                                                     class="w-20 h-20 rounded-full" style="display: inline-block">

                                                <p class="text-gray-800 font-bold">{{ $reply['fromUser']['userName'] }}
                                                    <span
                                                        class="text-gray-600">回复</span> {{ $reply['toUser']['userName'] }}
                                                </p>
                                                <p class="text-gray-600">{{ $reply['content'] }}</p>
                                            </div>
                                        @endforeach

                                    </div>
                                @endif
                                @if(!empty($comment['imageOriginals']))
                                    @foreach($comment['imageOriginals'] as $image)
                                        <img src="{{ $image }}" alt="Feed Image" class="mt-4" width="300px">
                                    @endforeach
                                @endif

                            </div>
                        @endforeach
                    </div>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>

