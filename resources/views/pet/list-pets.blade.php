@extends('layout')

@section('content')

<div>
    <h1>Lista zwierząt</h1>
    <form method="GET">
        <label for="status">Status:</label><br>
        <select id="status" name="status">
            <option value selected disabled>Wybierz status</option>
            @foreach ($statuses as $status)
                <option value="{{$status}}" @if($status == $oldStatus || $status == old('status')) selected @endif>{{$status}}</option>
            @endforeach
        </select><br>
        <button type="submit">Znajdź</button>
    </form>
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <h4 class="error">{{$errors->first()}}</h4>
    @endif
    @if(count($pets) > 0)
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nazwa</th>
                <th>Status</th>
                <th>Pokaż</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pets as $pet)
            <tr>
                <td>{{ $pet['id'] ?? '' }}</td>
                <td>{{ $pet['name'] ?? ''}}</td>
                <td>{{ $pet['status'] ?? ''}}</td>

                <td>
                    <a href="{{ route('pet.findPetById', ['id' => $pet['id']]) }}">Pokaż</a>
                </td>
                <td>
                    <a href="{{ route('pet.updatePet', ['id' => $pet['id']]) }}">Edytuj</a>
                </td>
                <td>
                    <form action="{{ route('pet.deletePet', ['id' => $pet['id']]) }}" method="POST">
                        @csrf
                        <button type="submit">Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h2>Brak zwierząt</h2>
    @endif
</div>
@endsection
