@extends('modele.main')

@section('contents')
    <div class="header">
        <h1>Détails de la commande</h1>
        <button class="logout-button"><a href="/logout">Logout</a></button>
    </div>

    <table class="commande-details-table">
        <thead>
        <tr>
            <th>Nom de la pizza</th>
            <th>Description</th>
            <th>Prix unitaire</th>
            <th>Quantité</th>
            <th>Prix total</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($commande) && $commande->pizzas != null)
            @foreach ($commande-> pizzas as $pizza)
            <tr>
                <td>{{ $pizza->nom }}</td>
                <td>{{ $pizza->description }}</td>
                <td>{{ $pizza->prix }} €</td>
                <td>{{ $pizza->pivot->quantite }}</td>
                <td>{{ $pizza->pivot->quantite * $pizza->prix }} €</td>
            </tr>
        @endforeach
        @endif
        </tbody>
        <tfoot>
        <tr>
            <td colspan="4">Total</td>
            <td>{{ $commande->total }} €</td>
        </tr>
        </tfoot>
    </table>
    <div class="commande-details-actions">
        @if ($commande->status === 'envoye')
            <form method="POST" action="{{ route('commandes.update', ['id' => $commande->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="en traitement">
                <button type="submit">Mettre en traitement</button>
            </form>
        @elseif ($commande->status === 'en traitement')
            <form method="POST" action="{{ route('commandes.update', ['id' => $commande->id]) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="prete">
                <button type="submit">Mettre prête</button>
            </form>
        @elseif ($commande->status === 'prete')
            <form method="POST" action="{{ route('commandes.update', ['id' => $commande->id])}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="recuperee">
                <button type="submit">Mettre récupérée</button>
            </form>
        @endif
    </div>

    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
        }

        .logout-button,
        button[type="submit"] {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 10px;
        }

        .logout-button:hover,
        button[type="submit"]:hover {
            background-color: lightblue;
        }

        a {
            color: white;
            text-decoration: none;
        }

        .commande-details-table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: blue;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .commande-details-actions {
            display: flex;
            justify-content: flex-end;
        }
    </style>

@endsection
