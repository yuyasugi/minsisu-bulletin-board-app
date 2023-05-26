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
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>{{$Post->title}}</p>
                    <p>{{$Post->comment}}</p>
                </div>
            </div>
            @endforeach
            <div class="text-right">
                <a class="btn btn-info mt-4 " href="/create" role="button">新規投稿</a>
            </div>
        </div>
    </div>
</x-app-layout>
