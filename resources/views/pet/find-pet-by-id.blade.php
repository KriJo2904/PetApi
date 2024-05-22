@extends('layout')

@section('content')
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if($pet)
    <div>
        <p>Id: {{ $pet['id'] ?? 'brak'  }}</p>
        <p>Nazwa: {{ $pet['name']}}</p>
        <p>Kategoria: {{ $pet['category']['name'] ?? 'brak' }}</p>
        <p>Status: {{ $pet['status'] }}</p>
        <p>Tagi:</p>
        <ul>
            @if(isset($pet['tags']))
                @foreach($pet['tags'] as $tag)
                    <li>{{ $tag['name'] }}</li>
                @endforeach
            @else
                <li>Brak tagów</li>
            @endif
        </ul>
        <p>Zdjęcia:</p>
        @if(isset($pet['photoUrls']))
            <ul>
                @foreach($pet['photoUrls'] as $photoUrl)
                    <li>
                        <a href="{{ $photoUrl }}">

                        <img src="{{ $photoUrl }}"/>
                    </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p>Brak zdjęć</p>
        @endif
    </div>
    @endif

    @if($error)
        <h2>{{ $error['message'] }}</h2>
    @endif
@endsection
