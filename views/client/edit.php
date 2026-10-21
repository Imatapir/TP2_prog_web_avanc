{{ include('layouts/header.php', {title: 'Modifier un client'}) }}
    <form method="post">
        <h2>Modifier un client</h2>
        <label>Nom
            <input type="text" name="name" value="{{ client.name }}">
        </label>
        {% if errors.name is defined %}
            <span class="error">{{ errors.name }}</span>
        {% endif %}
        <label>Adresse
            <input type="text" name="address" value="{{ client.address }}">
        </label>
        {% if errors.address is defined %}
            <span class="error">{{ errors.address }}</span>
        {% endif %}
        <label>Code postal
            <input type="text" name="zip_code" value="{{ client.zip_code }}">
        </label>
        {% if errors.zip_code is defined %}
            <span class="error">{{ errors.zip_code }}</span>
        {% endif %}
        <label>Téléphone
            <input type="text" name="phone" value="{{ client.phone }}">
        </label>
        {% if errors.phone is defined %}
            <span class="error">{{ errors.phone }}</span>
        {% endif %}
        <label>Courriel
            <input type="text" name="email" value="{{ client.email }}">
        </label>
        {% if errors.email is defined %}
            <span class="error">{{ errors.email }}</span>
        {% endif %}
        <input type="submit" class="btn" value="Enregistrer">
    </form>
{{ include('layouts/footer.php') }}