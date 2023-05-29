<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿にコメント') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($showPosts as $index => $Post)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200 justify-content-between">
                    <div class="text-muted small mb-4">{{$Post->user->name}}</div>
                    <div class="w-100 border-bottom">
                        <div class="post border-bottom">
                            <div>
                                <div class="mb-2">
                                    <p>{{$Post->title}}</p>
                                </div>
                                <div class="w-100 mt-4 mb-4">
                                    <p>{{$Post->comment}}</p>
                                </div>
                            </div>
                            <div class="mt-4 mb-4 text-right">
                                @if (Auth::user()->id == $Post->user_id)
                                <form action="{{ route('destroy', $Post->id) }}" method="POST">
                                @csrf
                                <a class="btn btn-info" href="{{ route('edit', $Post->id) }}" role="button">編集</a>
                                <input type="hidden" name="id" value="{{ $Post->id }}">
                                <button type="submit" class="btn btn-info">削除</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="comment mt-3">
                        @foreach ($Post->comments as $Comment)
                        <div class="text-muted small mb-2 w-75 mt-4">{{$Comment->user->name}}のコメント</div>
                        <div class="w-100">
                            <p>{{$Comment->comment}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="create_post" action="{{ route('store_comment') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <p>コメント</p>
                            <textarea class="form-control mb-3" name="comment" rows="5"></textarea>
                        </div>
                        <input type="hidden" name="post_id" value="{{ $Post->id }}">
                        <button class="btn btn-info" type="submit">返信する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
