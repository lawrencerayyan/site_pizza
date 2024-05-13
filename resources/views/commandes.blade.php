@extends('modele.main')

@section('contents')
    <div class="header">
        <h1>Liste des commandes non-traitées</h1>
        <button class="button"><a href="/logout">Logout</a></button>
    </div>

    <table class="commandes-table">
        <thead>
        <tr>
            <th>Numéro de commande</th>
            <th>Heure d'arrivée</th>
            <th>updated_at</th>
            <th>Statut</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($commandes as $commande)
            @if ($commande->statut === 'envoye')
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->created_at }}</td>
                    <td>{{ $commande->updated_at }}</td>
                    <td>{{ $commande->statut }}</td>
                   {{-- <td>{{ $commande->user->name }}</td> --}}
                    <td><a class="buttonde" href="{{ route('commandes.showdetail', ['id' => $commande->id]) }}">Détails
                        </a>
                    </td>

                </tr>
            @endif
        @endforeach
        </tbody>
    </table>

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
        .buttonde {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 4px 20px;
            margin-left: 10px;
        }
        .button {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 10px;
        }

        .button:hover {
            background-color: lightblue;

        }

        a {
            color: white;
            text-decoration: none;
        }

        .commandes-table {
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
    </style>
@endsection
