<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿詳細') }}
        </h2>
    </x-slot>

    <div class="py-12">
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
                                <a class="btn btn-outline-info" href="{{ route('edit', $Post->id) }}" role="button">編集</a>
                                <input type="hidden" name="id" value="{{ $Post->id }}">
                                <button type="submit" class="btn btn-outline-info">削除</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="comment mt-3">
                        @foreach ($Post->comments as $Comment)
                        <div class="text-muted small mb-2 w-75 mt-4">{{$Comment->user->name}}のコメント</div>
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <p>{{Str::limit($Comment->comment,100,'・・・')}}</p>
                                @if (Auth::user()->id == $Comment->user_id)
                                <form action="{{ route('destroy_comment', $Comment->id) }}" method="POST">
                                @csrf
                                <a class="btn btn-outline-info" href="{{ route('edit_comment', $Comment->id) }}" role="button">編集</a>
                                <input type="hidden" name="id" value="{{ $Comment->id }}">
                                <button type="submit" class="btn btn-outline-info">削除</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        <div class="text-right mt-5">
                            <div>
                                <a class="btn btn-outline-info mr-1" href="{{ route('create_comment', $Post->id) }}" role="button">返信する</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
