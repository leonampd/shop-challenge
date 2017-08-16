var getCreditCardDatav = function () {
    var card = {}
    card.card_holder_name = jQuery("#card_holder_name").val()
    card.card_expiration_date = jQuery("#card_expiration_month").val() + '/' + jQuery("#card_expiration_year").val()
    card.card_number = jQuery("#card_number").val()
    card.card_cvv = jQuery("#card_cvv").val()

    return card;
};
var getCardHashFromPagarme = function(card, callback) {
    pagarme.client.connect({ encryption_key: 'ek_test_pvXfMOPeMo0eN7A6xLMASyuqETWA1Q' })
        .then(client => client.security.encrypt(card))
        .then(card_hash => callback(card_hash));
};

jQuery(document).ready(function () {
    var btnFinalizarCompra = jQuery('.btn-finalizar-compra');

    btnFinalizarCompra.on('click', function () {
        var card = getCreditCardDatav();
        var cardValidations = pagarme.validate({card: card})
        if(!cardValidations.card.card_number){
            jQuery('#field_errors').text('Oops, número de cartão incorreto');
            return;
        }

        getCardHashFromPagarme(card, function (card_hash) {
            jQuery('#card_hash').val(card_hash);
            if (card_hash !== '') {
                jQuery('#payment_form').submit();
            }
        });

    });
});