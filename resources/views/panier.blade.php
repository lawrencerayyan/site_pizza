@extends('modele.main')
@section('contents')
<h1>Contenu du panier</h1>


        <ul>
            @if (session('cart'))
            @foreach($panier as $pizza)
                <li>
                    {{ $pizza['nom'] }} :  {{ $pizza['qte'] }} x {{ $pizza['prix'] }} €


                    <form action="{{ route('cart.modifier', ['id' => $pizza['id']]) }}" method="POST">
                        @csrf
                    <input type="hidden" name="id" value="{{ $pizza['id'] }}">
                        <input type="number" name="qte" value="{{ $pizza['qte'] }}">
                        <button type="submit">Modifier</button>
                    </form>


                    <form action="{{ route('cart.supprimer', ['id' => $pizza['id']]) }}" method="POST">
                        @csrf
                    <input type="hidden" name="id" value="{{ $pizza['id'] }}">
                        <button type="submit">Supprimer</button>
                    </form>




                </li>
            @endforeach
                @else
                <p>Votre panier est vide.</p>
            @endif


        </ul>
        <p>Prix total : {{ $prixTotal }} €</p>

    <form action="{{ route('cart.valider') }}" method="POST">
     @csrf
     <input type="hidden" name="id"}}">
     <button type="submit">Valider </button>
        </form>

    <div class="text-end">
        <button type="button"  class="btn btn-outline-primary me-2" ><a href="/logout">Logout</a></button>
    </div>

@endsection

