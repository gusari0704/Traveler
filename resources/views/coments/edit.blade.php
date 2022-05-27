@extends('layouts.app')

@section('content')

  <h1>コメント編集</h1>
  <div>
    <form method="post" action="{{ route('coment.update') }}" enctype='multipart/form-data'>
      @csrf
      @method('PATCH')
      <input type="hidden" name="id" value="{{ $coment->id }}">
      <p>
        <label for="text">Comment: </label>
        <input type="text" name="text" id="text" value="{{ $coment->text }}{{ old('text') }}">
        @if ($errors->has('text'))
          <span class="error">{{ $errors->first('text') }}</span>
        @endif
      </p>
      <p>
        <input type="submit" value="更新">
      </p>
    </form>
  </div>

@endsection