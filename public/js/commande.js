$(document).ready(function() {
    // you may need to change this code if you are not using Bootstrap Datepicker
    $('.js-datepicker').datepicker({
        format: 'dd-mm-yyyy'
    });
});


$.datepicker.setDefaults($.datepicker.regional['fr']);
$('#commande_date').datepicker($.datepicker.regional['fr']);

