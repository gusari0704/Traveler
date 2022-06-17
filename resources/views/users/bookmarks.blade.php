@extends('layouts.app')

@section('content')

@foreach ($favorites as $favorite)
    <div class="favorite-control">
        @if (!Auth::user()->is_bookmark($favorite->id))
        <form action="{{ route('bookmark.store', $favorite) }}" method="post">
            @csrf
            <button>お気に入り登録</button>
        </form>
        @else
        <form action="{{ route('bookmark.destroy', $favorite) }}" method="post">
            @csrf
            @method('delete')
            <button>お気に入り解除</button>
        </form>
        @endif
    </div>
@endforeach

@endsection