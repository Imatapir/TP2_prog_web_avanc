{{ include('layouts/header.php', {title: 'Modifier un auteur'}) }}
    <form method="post">
        <h2>Modifier un auteur</h2>
        <label>Nom
            <input type="text" name="nom" value="{{ auteur.nom }}">
        </label>
        {% if errors.nom is defined %}
            <span class="error">{{ errors.nom }}</span>
        {% endif %}
        <label>Prenom
            <input type="text" name="prenom" value="{{ auteur.prenom }}">
        </label>
        {% if errors.prenom is defined %}
            <span class="error">{{ errors.prenom }}</span>
        {% endif %}
        <input type="submit" class="btn" value="Enregistrer">
    </form>
{{ include('layouts/footer.php') }}