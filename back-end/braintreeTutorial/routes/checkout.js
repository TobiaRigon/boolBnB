const express = require('express'); // Importa Express
const router = express.Router(); // Crea un router utilizzando express.Router()
const braintree = require('braintree');

router.post('/', (req, res, next) => {
  const gateway = new braintree.BraintreeGateway({
    environment: braintree.Environment.Sandbox,
    // Usa le tue credenziali dal pannello di controllo Sandbox qui
    merchantId: 'ndydcqkc7stmdkgf',
    publicKey: 'p7khpry9np52wwnr',
    privateKey: 'd61515b4c4323303330e1425aaa94717'
  });

  // Usa il nonce del metodo di pagamento qui
  const nonceFromTheClient = req.body.paymentMethodNonce;
  // Crea una nuova transazione per $10
  const newTransaction = gateway.transaction.sale({
    amount: '10.00',
    paymentMethodNonce: nonceFromTheClient,
    options: {
      // Questa opzione richiede i fondi dalla transazione
      // una volta che è stata autorizzata con successo
      submitForSettlement: true
    }
  }, (error, result) => {
      if (result) {
        res.send(result);
      } else {
        res.status(500).send(error);
      }
  });
});

module.exports = router; // Esporta il router
