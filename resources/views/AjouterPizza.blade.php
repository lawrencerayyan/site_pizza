<form method="POST" action="{{ route('pizzas.store') }}">
    @csrf
    <label for="nom">Nom de la pizza:</label>
    <input type="text" name="nom" id="nom" required>

    <label for="description">Description:</label>
    <textarea name="description" id="description" required></textarea>

    <label for="prix">Prix:</label>
    <input type="number" name="prix" id="prix" required>

    <button type="submit">Ajouter une pizza</button>
</form>

