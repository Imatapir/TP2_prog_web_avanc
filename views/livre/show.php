{{ include('layouts/header.php', {title: 'Livre'}) }}
    <h1>{{ livre.titre }}</h1>
    {% if error is defined %}
        <span class="error">{{ error }}</span>
    {% endif %}
    <p><strong>Auteur : </strong><a href="{{base}}/auteur/show?id={{auteur.id}}">{{ auteur.prenom }} {{ auteur.nom }}</a></p>
    <p><strong>Prix : </strong>{{ livre.prix|number_format(2) }} $</p>
    <p><strong>Stock : </strong>{{ livre.stock }}
        {% if livre.stock > 0 %}(Disponible){% else %}(Rupture de stock){% endif %}
    </p>
    <div class="actions">
        <a href="{{base}}/livre/edit?id={{livre.id}}" class="btn">Modifier</a>
        <form method="post" action="{{base}}/livre/delete" onsubmit="return confirm('Supprimer ce livre ?')">
            <input type="hidden" name="id" value="{{livre.id}}">
            <input type="submit" class="btn red" value="Supprimer">
        </form>
    </div>
{{ include('layouts/footer.php') }}