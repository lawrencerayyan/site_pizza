@extends('modele.main')

@section('content')
    <h1>Créer un compte</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name">Nom :</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            @error('name')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            @error('email')
            <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>

        <div>
            <label for="mdp_confirmation">Confirmation du mot de passe</label>
            <input type="password" name="mdp_confirmation" id="mdp_confirmation" required>
        </div>

        <div>
            <button type="submit">Inscription</button>
        </div>
    </form>
@endsection
