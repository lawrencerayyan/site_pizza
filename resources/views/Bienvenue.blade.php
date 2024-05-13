<!DOCTYPE html>
<html>
<style>
    .bouton {

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
<head>
    <title>Bienvenue sur notre site</title>

</head>
<body>
<div style="display: flex; justify-content: space-between; align-items: center;">
    <h1 style="margin: 0;">Bienvenue sur notre site</h1>
    <button type="button" class="bouton"><a href="/logout">Logout</a></button>
</div>

@if( session()->has('etat'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session()->get('etat')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(auth()->user() && auth()->user()->type === 'cook')
    <button class="bouton">  <a href="{{ route('commandes.show') }}">Liste des commandes non traitées</a> </button>
@endif

<button class="bouton">  <a href="{{ route('pizzas.index') }}">Liste des pizzas</a> </button>
<button class="bouton">   <a href="{{ route('changer-mot-de-passe.edit') }}">Changer votre mot de passe</a></button>




</body>
</html>
