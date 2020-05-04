$(document).ready(function() {
  console.log('button pressed');
  $('#the-button').on('click', function() {
    $.ajax({
      url: window.location.host + 'checkout.php',
      type: 'POST',
      dataType: 'json',
      success: function(json) {
        console.log('response: ' + json);
        if(json['status'] == 'success') {
          window.location = json['redirect'];
        } else {
          alert('No logramos conectar con Mercado Pago');
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
      }
    });
  });
});