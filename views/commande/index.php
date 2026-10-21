{{ include('layouts/header.php', {title: 'Commandes'}) }}
    <h1>Commandes</h1>
    <table>
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Client</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            {% for commande in commandes %}
            <tr>
                <td><a href="{{base}}/commande/show?id={{commande.id}}">{{ commande.id }}</a></td>
                <td>{{ commande.date_commande }}</td>
                <td>{{ commande.client_name }}</td>
                <td>{{ commande.total|number_format(2) }} $</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="4">Aucune commande.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <a href="{{base}}/commande/create" class="btn">Nouvelle commande</a>
{{ include('layouts/footer.php') }}