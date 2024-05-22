@extends('layout')

@section('content')
    <form method="POST" action="{{route('pet.addPet')}}">
        @csrf
        <label for="name">Nazwa:</label><br>
        <input type="text" id="name" name="name" value="{{old('name')}}"><br>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="type">Kategoria:</label><br>
        <select id="category" name="category">
            @foreach ($categories as $category)
            <option value="{{$category}}" @if(old("category") == $category ) selected @endif>{{$category}}</option>
            @endforeach
        </select><br>
        @error('category')
            <div class="error">{{ $message }}</div>
        @enderror
        <labe+l for="">Linki do zdjęć oddziel przecinkiem</labe+l>
        <label for="photoUrls">Link do zdjęć:</label><br>
        <textarea id="photoUrls" name="photoUrls" placeholder="Linik do zdjęć">{{old('photoUrls')}}</textarea><br>
        @error('photoUrls')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="tags">Tagi:</label><br>
        <textarea id="tags" name="tags" placeholder="Tagi">{{old('tags')}}</textarea><br>
        @error('tags')
            <div class="error">{{ $message }}</div>
        @enderror
        <label for="status">Status:</label><br>
        <select id="status" name="status">
            @foreach ($statuses as $status)
                <option value="{{$status}}" @if(old("status") == $status) selected @endif>{{$status}}</option>
            @endforeach
        </select><br>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror


        <button type="submit">Zapisz</button>

    </form>
@endsection
