@extends('layout')

@section('content')
    @if(isset($pet['id']))
        <h1>Edit Pet</h1>
        <form method="POST" action="{{route('pet.updatePet', ['id' => $pet['id']])}}">
            @csrf
            <label for="name">Nazwa:</label><br>
            <input type="text" id="name" name="name" value="{{old('name') ?? $pet['name']}}"><br>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <label for="status">Status:</label><br>
            <select id="status" name="status">
                @foreach ($statuses as $status)
                    <option value="{{$status}}" @if($pet['status'] == $status || $status == old('status')) selected @endif>{{$status}}</option>
                @endforeach
            </select><br>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror

            <button type="submit">Zapisz</button>
        </form>
    @else
        <h2>Brak zwierzaka do edycji</h2>
    @endif
@endsection
