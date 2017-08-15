$(document).ready(function() {
  var form = $("#payment_form")

  form.submit(function(event) {
    event.preventDefault();
    var card = {}
    card.card_holder_name = $("#card_holder_name").val()
    card.card_expiration_date = $("#card_expiration_month").val() + '/' + $("#card_expiration_year").val()
    card.card_number = $("#card_number").val()
    card.card_cvv = $("#card_cvv").val()

    // pega os erros de validação nos campos do form e a bandeira do cartão
    var cardValidations = pagarme.validate({card: card})

    //Então você pode verificar se algum campo não é válido
    if(!cardValidations.card.card_number) {
      console.log('Oops, número de cartão incorreto')
    }

    //Mas caso esteja tudo certo, você pode seguir o fluxo
    pagarme.client.connect({ encryption_key: 'ek_test_pvXfMOPeMo0eN7A6xLMASyuqETWA1Q' })
      .then(client => client.security.encrypt(card))
  .then(card_hash => console.log(card_hash))
    event.
    // o próximo passo aqui é enviar o card_hash para seu servidor, e
    // em seguida criar a transação/assinatura

    return false
  })
});