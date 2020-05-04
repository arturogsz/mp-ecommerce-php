<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="./assets/result.css">
  </head>
  <body>
    <div class="container">
      <p class="tite">Recibimos tu pago con éxito</p>
      <p class="message">En breve estaremos enviando tus productos :)</p>
      <p>Payment method id:<?php echo $_GET['payment_method_id'] ?></p>
      <p>Monto pagado:<?php echo $_GET['transaction_amount'] ?></p>
      <p>Orden del pedido:<?php echo $_GET['external_reference'] ?></p>
      <p>ID Mercado Pago:<?php echo $_GET['id'] ?></p>      
    </div>
  </body>
</html>