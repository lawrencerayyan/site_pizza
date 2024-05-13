@extends('modele.main')

<style>
    .auth-dialog {
        width: 400px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .auth-header h2 {
        margin: 0;
        font-size: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input[type="text"],
    .form-group input[type="password"],
    .form-group input[type="submit"] {
        padding: 10px;
        font-size: 16px;
        line-height: 1.5;
        border: 1px solid #ced4da;
        border-radius: 5px;
        background-color: #fff;
        background-clip: padding-box;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }

    .form-group input[type="submit"] {
        background-color: #337ab7;
        border-color: #337ab7;
        color: #fff;
        cursor: pointer;
        font-weight: bold;
        text-transform: uppercase;
    }

    .form-group input[type="submit"]:hover {
        background-color: #265a88;
        border-color: #265a88;
    }

</style>
@section('contents')
    <div class="auth-dialog">
        <div class="auth-header">
            <h2>Enregistrement</h2>
        </div>

    <form method="post">

        <div class="form-group">
            <label for="login">Login:</label>
            <input type="text" name="login" value="{{old('login')}}">
        </div>
        <div class="form-group">
            <label for="mdp">MDP:</label>
            <input type="password" name="mdp">
        </div>
        <div class="form-group">
            <label for="mdp">Confirmation MDP:</label>
            <input type="password" name="mdp_confirmation">
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer">
        </div>
        @csrf
    </form>
    </div>
@endsection
