{{ include('layouts/header.php', { title: 'Auteur' }) }}
    <h1>{{ auteur.prenom }} {{ auteur.nom }}</h1>
    {% if error is defined %}
        <span class="error">{{ error }}</span>
    {% endif %}
    <h3>Livres</h3>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            {% for livre in livres %}
            <tr>
                <td><a href="{{base}}/livre/show?id={{livre.id}}">{{ livre.titre }}</a></td>
                <td>{{ livre.prix | number_format(2) }} $</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="2">Aucun livre pour cet auteur</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <div class="actions">
        <a href="{{base}}/auteur/edit?id={{auteur.id}}" class="btn">Modifier</a>
        <form method="post" action="{{base}}/auteur/delete" onsubmit="return confirm('Supprimer cet auteur ?')">
            <input type="hidden" name="id" value="{{auteur.id}}">
            <input type="submit" class="btn red" value="Supprimer">
        </form>
    </div>
{{ include('layouts/footer.php') }}