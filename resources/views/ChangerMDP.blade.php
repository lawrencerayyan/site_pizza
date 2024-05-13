
    <h1>Changer le mot de passe</h1>

    <form method="POST" action="{{ route('changer-mot-de-passe.update') }}">
        @csrf
        @method('PUT')

        <div>
            <label for="mdp_actuel">Mot de passe actuel</label>
            <input type="password" name="mdp_actuel" id="mdp_actuel" required>
        </div>

        <div>
            <label for="mdp">Nouveau mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>

        <div>
            <label for="mdp_confirmation">Confirmation du nouveau mot de passe</label>
            <input type="password" name="mdp_confirmation" id="mdp_confirmation" required>
        </div>

        <div>
            <button type="submit">Changer le mot de passe</button>
        </div>
        <div class="text-end">
            <button type="button"  class="btn btn-outline-primary me-2" ><a href="/logout">Logout</a></button>
        </div>
    </form>

