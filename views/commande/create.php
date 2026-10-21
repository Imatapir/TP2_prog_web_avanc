{{ include('layouts/header.php', {title: 'Nouvelle commande'}) }}
    <h1>Nouvelle commande</h1>

    <h3>Panier</h3>
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
                <td>{{ ligne.titre }}</td>
                <td>{{ ligne.prix|number_format(2) }} $</td>
                <td>{{ ligne.quantite }}</td>
                <td>{{ ligne.sous_total|number_format(2) }} $</td>
            </tr>
            {% else %}
            <tr>
                <td colspan="4">Le panier est vide.</td>
            </tr>
            {% endfor %}
        </tbody>
    </table>
    <p><strong>Total : </strong>{{ total|number_format(2) }} $</p>

    {% if lignes|length > 0 %}
    <div class="actions">
        <form method="post" action="{{base}}/commande/vider">
            <input type="submit" class="btn red" value="Vider le panier">
        </form>
    </div>
    {% endif %}

    <form method="post" action="{{base}}/commande/ajouter">
        <h2>Ajouter un livre</h2>
        <label>Livre
            <select name="livre_id">
                {% for livre in livres %}
                <option value="{{livre.id}}">{{ livre.titre }} ({{ livre.prix|number_format(2) }} $)</option>
                {% endfor %}
            </select>
        </label>
        {% if errors.livre_id is defined %}
            <span class="error">{{ errors.livre_id }}</span>
        {% endif %}
        <label>Quantité
            <input type="number" name="quantite" min="1" value="1">
        </label>
        {% if errors.quantite is defined %}
            <span class="error">{{ errors.quantite }}</span>
        {% endif %}
        <input type="submit" class="btn" value="Ajouter au panier">
    </form>

    <form method="post" action="{{base}}/commande/create">
        <h2>Confirmer la commande</h2>
        <label>Client
            <select name="client_id">
                <option value="">Choisir un client</option>
                {% for client in clients %}
                <option value="{{client.id}}" {% if client.id == client_id %}selected{% endif %}>{{ client.name }}</option>
                {% endfor %}
            </select>
        </label>
        {% if errors.client_id is defined %}
            <span class="error">{{ errors.client_id }}</span>
        {% endif %}
        {% if errors.panier is defined %}
            <span class="error">{{ errors.panier }}</span>
        {% endif %}
        <input type="submit" class="btn" value="Confirmer la commande">
    </form>
{{ include('layouts/footer.php') }}