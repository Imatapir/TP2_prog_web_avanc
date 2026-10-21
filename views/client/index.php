{{ include('layouts/header.php', {title: 'Clients'}) }}
    <h1>Clients</h1>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Téléphone</th>
                <th>Courriel</th>
            </tr>
        </thead>
        <tbody>
            {% for client in clients %}
            <tr>
                <td><a href="{{base}}/client/show?id={{client.id}}">{{ client.name }}</a></td>
                <td>{{ client.address }}</td>
                <td>{{ client.zip_code }}</td>
                <td>{{ client.phone }}</td>
                <td>{{ client.email }}</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="5">Aucun client.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/client/create" class="btn">Nouveau client</a>
{{ include('layouts/footer.php') }}