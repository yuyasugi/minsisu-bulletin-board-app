<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('投稿詳細') }}
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($editPosts as $index => $Post)
                    <form class="edit_post" action="{{ route('update', $Post->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <p>タイトル</p>
                            <textarea class="form-control mb-3" name="title" cols="30" rows="1">{{$Post->title}}</textarea>
                            <p>解説</p>
                            <textarea class="form-control mb-3" name="comment" cols="30" rows="5">{{$Post->comment}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="{{ $Post->id }}">
                        <button type="submit" class="btn btn-outline-info">更新</button>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
