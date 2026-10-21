{{ include('layouts/header.php', {title: 'Modifier un livre'}) }}
    <form method="post">
        <h2>Modifier un livre</h2>
        <label>Titre
            <input type="text" name="titre" value="{{ livre.titre }}">
        </label>
        {% if errors.titre is defined %}
            <span class="error">{{ errors.titre }}</span>
        {% endif %}
        <label>Prix
            <input type="number" name="prix" step="0.01" min="0" value="{{ livre.prix }}">
        </label>
        {% if errors.prix is defined %}
            <span class="error">{{ errors.prix }}</span>
        {% endif %}
        <label>Stock
            <input type="number" name="stock" min="0" value="{{ livre.stock }}">
        </label>
        {% if errors.stock is defined %}
            <span class="error">{{ errors.stock }}</span>
        {% endif %}
        <label>Auteur
            <select name="auteur_id">
                <option value="">Choisir un auteur</option>
                {% for auteur in auteurs %}
                <option value="{{auteur.id}}" {% if auteur.id == livre.auteur_id %}selected{% endif %}>{{ auteur.prenom }} {{ auteur.nom }}</option>
                {% endfor %}
            </select>
        </label>
        {% if errors.auteur_id is defined %}
            <span class="error">{{ errors.auteur_id }}</span>
        {% endif %}
        <input type="submit" class="btn" value="Enregistrer">
    </form>
{{ include('layouts/footer.php') }}