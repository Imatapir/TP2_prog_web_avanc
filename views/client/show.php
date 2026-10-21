{{ include('layouts/header.php', {title: 'Client'}) }}
    <h1>{{ client.name }}</h1>
    {% if error is defined %}
        <span class="error">{{ error }}</span>
    {% endif %}
    <p><strong>Adresse : </strong>{{ client.address }}</p>
    <p><strong>Code postal : </strong>{{ client.zip_code }}</p>
    <p><strong>Téléphone : </strong>{{ client.phone }}</p>
    <p><strong>Courriel : </strong>{{ client.email }}</p>

    <h3>Commandes</h3>
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            {% for commande in commandes %}
            <tr>
                <td><a href="{{base}}/commande/show?id={{commande.id}}">{{ commande.id }}</a></td>
                <td>{{ commande.date_commande }}</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="2">Aucune commande pour ce client.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <div class="actions">
        <a href="{{base}}/client/edit?id={{client.id}}" class="btn">Modifier</a>
        <form method="post" action="{{base}}/client/delete" onsubmit="return confirm('Supprimer ce client ?')">
            <input type="hidden" name="id" value="{{client.id}}">
            <input type="submit" class="btn red" value="Supprimer">
        </form>
    </div>
{{ include('layouts/footer.php') }}