<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新規投稿') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form class="create_post" action="{{ route('store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <p>タイトル</p>
                            <textarea class="form-control mb-3" name="title"></textarea>
                            <p>内容</p>
                            <textarea class="form-control mb-3" name="comment" rows="5"></textarea>
                        </div>
                        <button type="submit" class="btn btn-info">投稿する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
