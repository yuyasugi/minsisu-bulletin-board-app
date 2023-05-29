<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿一覧') }}
        </h2>
    </x-slot>

    {{-- フラッシュメッセージ始まり --}}
    {{-- 成功の時 --}}
    @if (session('successMessage'))
    <div class="alert alert-success text-center">
    {{ session('successMessage') }}
    </div>
    @endif
    {{-- 失敗の時 --}}
    @if (session('errorMessage'))
    <div class="alert alert-danger text-center">
    {{ session('errorMessage') }}
    </div>
    @endif
    {{-- フラッシュメッセージ終わり --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($Posts as $Post)
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200 justify-content-between">
                    <div class="text-muted small mb-4">{{$Post->user->name}}</div>
                    <div class="w-100 border-bottom">
                        <div class="post border-bottom d-flex justify-content-between">
                            <div>
                                <div class="mb-2">
                                    <a href="{{ route('show', $Post->id) }}"><p>{{$Post->title}}</p></a>
                                </div>
                                <div class="w-100 mb-4">
                                    <p>{{Str::limit($Post->comment,100,'・・・')}}</p>
                                </div>
                            </div>
                            <div class="mt-4">
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
                        @if ($loop->first)
                        <div class="text-muted small mb-2 w-75 mt-4">{{$Comment->user->name}}のコメント</div>
                        <div class="w-100">
                            <p>{{Str::limit($Comment->comment,100,'・・・')}}</p>
                            <div class="mt-3 d-flex justify-content-between">
                                <div>
                                    <p class="text-muted small">他返信{{$Post->comments->count()-1}}件</p>
                                </div>
                                <div>
                                    <a class="btn btn-info mr-1" href="{{ route('create_comment', $Post->id) }}" role="button">返信する</a>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            <div class="text-right">
                <a class="btn btn-info mt-4 " href="/create" role="button">新規投稿</a>
            </div>
        </div>
    </div>
</x-app-layout>
