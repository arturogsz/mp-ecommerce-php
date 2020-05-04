<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

// const BASE_URL = 'http://vendeo.mx/mercado-pago-cert';
const BASE_URL = 'https://arturogsz-mp-commerce-php.herokuapp.com/';

$seller_info = array(
  'id' => 491494389,
  'key' => 'APP_USR-c82bb1fb-2c75-49b8-b730-2f98c42111fe',
  'token' => 'APP_USR-6588866596068053-041607-428a530760073a99a1f2d19b0812a5b6-491494389'
);

$payer_info = array(
  'id' => '535650015',
  'password' => 'qatest9980',
  'email' => 'test_user_58295862@testuser.com',
  'name' => 'Lalo',
  'surname' => 'Landa',
  'area_code' => '55',
  'phone' => '49737300',
  'street' => 'Insurgentes Sur',
  'number' => '1602',
  'postcode' => '03940',
);

$payment = array(
  'installments' => 6,
  'exluded_cards' => 'amex',
  'excluded_payment_method' => 'atm'
);

$product_info = array(
  'id' => 1234,
  'descr' => 'Dispositivo móvil de Tienda e-commerce',
  'quantity' => '1',
  'external_reference' => 'ABCD1234'
);

$config_info = array(
  'installments' => 6,
  'excluded' => 'amex'
);

MercadoPago\SDK::setAccessToken($seller_info['token']);

$item = new MercadoPago\Item();
$item->id = $product_info['id'];
$item->title = $_POST['title'];
$item->description = $product_info['descr'];
$item->picture_url = $_POST['img'];
$item->quantity = $product_info['quantity'];
$item->unit_price = $_POST['price'];

$payer = new MercadoPago\Payer();
$payer->name = $payer_info['name'];
$payer->surname = $payer_info['surname'];
$payer->email = $payer_info['email'];
$payer->phone = array(
  'area_code' => $payer_info['area_code'],
  'number' => $payer_info['phone']
);
$payer->address = array(
  'street_name' => $payer_info['street'],
  'street_number' => $payer_info['number'],
  'zip_code' => $payer_info['postcode']
);

$payment_methods = array(
  "installments" => $config_info['installments'],
  "excluded_payment_methods" => $config_info['excluded'],
);

$back_urls = array(
  'pending' => BASE_URL . 'pending/',
  'success' => BASE_URL . 'success/',
  'failure' => BASE_URL . 'failure/'
);

$preference = new MercadoPago\Preference();
$preference->external_reference = $product_info['external_reference'];
$preference->items = array($item);
// $pref['auto_return'] = true;
$preference->back_urls = $back_urls;
$preference->payment_methods = $payment_methods;
$preference->payer = $payer;
$response = array();
if($preference->save() === true) {
  $response['status'] = 'success';
  $response['redirect'] = $preference->init_point;
} else {
  $response['status'] = 'error';
}
echo json_encode($response);
?>