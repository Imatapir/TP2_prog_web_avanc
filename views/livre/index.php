{{ include('layouts/header.php', {title: 'Livres'}) }}
    <h1>Livres</h1>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Prix</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            {% for livre in livres %}
            <tr>
                <td><a href="{{base}}/livre/show?id={{livre.id}}">{{ livre.titre }}</a></td>
                <td>{{ livre.auteur_prenom }} {{ livre.auteur_nom }}</td>
                <td>{{ livre.prix|number_format(2) }} $</td>
                <td>{{ livre.stock }}</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="4">Aucun livre.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/livre/create" class="btn">Nouveau livre</a>
{{ include('layouts/footer.php') }}