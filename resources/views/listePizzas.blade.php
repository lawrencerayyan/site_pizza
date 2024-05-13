@extends('modele.main')

@section('contents')
    <div class="header">
        <h1>Bienvenue sur notre site</h1>
        <button class="logout-button"><a href="/logout">Logout</a></button>
    </div>

    @unless(empty($pizzas))
        <table class="pizza-table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                @if(auth()->user() && auth()->user()->type === 'admin')
                    <th>Action</th>
                @else
                    <th>Quantité</th>
                    <th>Action</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td>{{ $pizza->nom }}</td>
                    <td>{{ $pizza->description }}</td>
                    <td>{{ $pizza->prix }} €</td>
                    @if(auth()->user() && auth()->user()->type === 'admin')
                        <td>
                            <a href="{{ route('pizzas.edit', $pizza->id) }}" class="add-pizza-linkk">Modifier</a>

                        </td>
                    @else
                        <td>
                            <input type="number" name="qte" value="1" min="1">
                            <form method="POST" action="{{ route('cart.add', $pizza->id) }}">
                                @csrf
                                <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
                                <button class="add-to-cart-button" type="submit">Ajouter au panier</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>

        @if(auth()->user() && auth()->user()->type === 'admin')
        <a href="{{ route('pizzas.create') }}" class="add-pizza-link">Ajouter une pizza</a>
        @endif

        <button class="view-cart-button"><a href="{{ route('cart.view') }}">Voir le panier</a></button>
    @endunless
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
        .add-pizza-linkk{
            background-color: red;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 4px 20px;
            margin-left: 10px;
        }
        .logout-button,
        .add-to-cart-button,
        .view-cart-button,
        .add-pizza-link {
            background-color: blue;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 10px;
        }

        .logout-button:hover,
        .add-to-cart-button:hover,
        .view-cart-button:hover,
        .add-pizza-link:hover {
            background-color: lightblue;
        }

        a {
            color: white;
            text-decoration: none;
        }

        .pizza-table {
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
