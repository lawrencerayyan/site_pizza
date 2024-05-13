@extends('modele.main')

@section('contents')
    <h1>Validation de la commande </h1>
    <form action="{{ route('cart.valider')}}" method="POST">
        @csrf
        <label for="status">Statut de la commande :</label>
        <p>Commande validé </p>

        <button type="submit"><a href="{{ url('/bienvenue') }}">A bientôt</a></button>
    </form>
@endsection
