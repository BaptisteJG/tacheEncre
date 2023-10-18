$(function(){
    $.datepicker.setDefaults($.datepicker.regional['fr']);

    $('#commande_date').datepicker({
        dateFormat: 'dd-mm-yy',
    });

    $('#ajout_commande_date').datepicker({
        dateFormat: 'dd-mm-yy',
    });
});