function updateTotal() {
    var total = 0;

    // Parcourez chaque champ d'entrée dans la collection
    $("[id^='ajout_commande_sujets_'][inputmode='decimal']").each(function() {
        var value = parseFloat($(this).val()) || 0;
        total += value;
    });

    // Mettez à jour le champ "total"
    $("#ajout_commande_prix").val(total);
}

// Lorsque les champs d'entrée changent
$(document).on('input', "[id^='ajout_commande_sujets_'][inputmode='decimal']", function() {
    updateTotal();
});

// Gestion de la suppression de champ
$(document).on('click', 'button:contains("Supprimer")', function() {
    $(this).closest('.field').remove();
    updateTotal();
});

// Appelez la fonction pour calculer le total au chargement de la page
$(document).ready(function() {
    updateTotal();
});