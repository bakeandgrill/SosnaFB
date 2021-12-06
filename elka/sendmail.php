<?

 $ip = $_SERVER['REMOTE_ADDR']; 
    $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip.'?lang=ru'));
    

if (empty($_POST['name']) or empty($_POST['phone'])) exit('<center><h2>УПС ! Заполните все данные</h2><font size=\"10\"><a href=/>Вернутся назад</a></font>');

   $name = $_POST['name'];
	$phone = $_POST['phone'];
$recepient = "Сосна";
$product_id = $_POST['product_id'];
		// Telegram Mail

$token = "1457998709:AAFe5J_ZwrgtxCOVyNd54n9OsfrfW8LBs_Y";

$telegram_text = array(
    'site'            => $_SERVER['SERVER_NAME'],'<br />',  // naeo ioi?aaey?uee cai?in
    'bayer_name'      => $name,'<br />',             // iieoiaoaeu (O.E.I)
    'phone'           => $phone,'<br />',           // oaeaoii
	'ip'              => $ip,'<br />',
     'utm_source'=>isset($_COOKIE['utm_source']) ? $_COOKIE['utm_source'] : '',
	       'utm_campaign'=>isset($_COOKIE['utm_campaign']) ? $_COOKIE['utm_campaign'] : '',
	       'utm_medium'=>isset($_COOKIE['utm_medium']) ? $_COOKIE['utm_medium'] : '',
	       'utm_term'=>isset($_COOKIE['utm_term']) ? $_COOKIE['utm_term'] : '',
	       'utm_content'=>isset($_COOKIE['utm_content']) ? $_COOKIE['utm_content'] : ''
);

$data = [
    'text' => "Ленд: $recepient \nИмя: $name \nТелефон: $phone \nВремя заказ: " . date('d.m.Y H:i') . " \nГео позиция: ".$query['country'].', '.$query['city']."\nIP: $ip  \nСайт: ".$telegram_text['site']."",

    'chat_id' => "-332965928"
];


file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );


header('Location:success.php?name='.$_POST['name'].'&phone='.$_POST['phone'].'&product_id='.$_POST['product_id']);
?>