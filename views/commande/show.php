{{ include('layouts/header.php', {title: 'Commande'}) }}
    <h1>Commande n° {{ commande.id }}</h1>
    <p><strong>Client : </strong><a href="{{base}}/client/show?id={{client.id}}">{{ client.name }}</a></p>
    <p><strong>Date : </strong>{{ commande.date_commande }}</p>

    <h3>Livres commandés</h3>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            {% for ligne in lignes %}
            <tr>
                <td><a href="{{base}}/livre/show?id={{ligne.livre_id}}">{{ ligne.titre }}</a></td>
                <td>{{ ligne.prix|number_format(2) }} $</td>
                <td>{{ ligne.quantite }}</td>
                <td>{{ ligne.sous_total|number_format(2) }} $ $</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="4">Aucun livre dans cette commande.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <p><strong>Total : </strong>{{ total|number_format(2) }} $</p>
{{ include('layouts/footer.php') }}