@extends('modele.main')
<style>
    .bouton {
        background-color: blue;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .bouton:hover {
        background-color: lightblue;
    }
    a {
        color: white;
        text-decoration: none;
    }
</style>

@section('contents')
    <div class="container mt-5 ">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1>Bienvenue sur notre site</h1>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-6 text-center">

                <button class="bouton">
                <a href="{{ route('login') }}">
                    Connexion
                </a>
                </button>

                <button class="bouton">
                <a href="{{ route('register') }}" >
                    Inscription
                </a>
                </button>
        </div>

    </div>
@endsection
