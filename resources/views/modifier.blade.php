
    <h1>Modifier la pizza "{{ $pizza->nom }}"</h1>

    <form method="POST" action="{{ route('pizzas.update', ['pizza' => $pizza->id]) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Nom :</label>
            <input type="text" name="nom" id="name" value="{{ $pizza->nom }}" required>
        </div>

        <div>
            <label for="description">Description :</label>
            <textarea name="description" id="description" required>{{ $pizza->description }}</textarea>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
