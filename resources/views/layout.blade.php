@include('partials.header')
<div>
    <h1>PetStore API</h1>
    <div>
        <a href="{{ route('pet.findPetByStatus') }}">Znajdź zwierzę</a>
        <a href="{{ route('pet.renderAddPet') }}">Dodaj zwierzę</a>

    </div>
    @yield('content')
</div>

@include('partials.footer')
