<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('コメント編集') }}
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

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200 justify-content-between">
                    <div class="text-muted small mb-4">{{$showPost->user->name}}</div>
                    <div class="w-100 border-bottom">
                        <div class="post border-bottom">
                            <div>
                                <div class="mb-2">
                                    <p>{{$showPost->title}}</p>
                                </div>
                                <div class="w-100 mt-4 mb-4">
                                    <p>{{$showPost->comment}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment mt-3">
                        @foreach ($showPost->comments as $Comment)
                        <div class="text-muted small mb-2 w-75 mt-4">{{$Comment->user->name}}のコメント</div>
                        <div class="w-100">
                            <div>
                                <p>{{Str::limit($Comment->comment,100,'・・・')}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="edit_post" action="{{ route('update_comment', $editComment->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <p class="mb-3">コメント編集</p>
                            <textarea class="form-control mb-3" name="comment" cols="30" rows="1">{{$editComment->comment}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $editComment->id }}">
                        <button type="submit" class="btn btn-outline-info">更新</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
