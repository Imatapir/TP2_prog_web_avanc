{{ include('layouts/header.php', {title: 'Auteurs'}) }}
    <h1>Auteurs</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
            </tr>
        </thead>
        <tbody>
            {% for auteur in auteurs %}
            <tr>
                <td><a href="{{base}}/auteur/show?id={{auteur.id}}">{{ auteur.nom }}</a></td>
                <td>{{ auteur.prenom }}</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="2">Aucun auteur.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/auteur/create" class="btn">Nouvel auteur</a>
{{ include('layouts/footer.php') }}