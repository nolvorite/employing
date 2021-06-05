<!--<img src="/gem/ore/grupo/users/default.png"-->
<script>
    
    
    $(document).on('click', '.notifyMe', function(){
      
          if(textmessage.length>2){
                var  imgs = '';
         imgs =   $('.lazyimg.loginuserimage').attr('hello');
//         var  imgs = "http://localhost:1005/gem/ore/grupo/users/1-gr-KqdyIcR5ce.png";
//           alert(imgs);
    var chatusers = $('.chatuser').attr('no');
    $.ajax({
            url: 'send.php',
//            url: '',
            method: 'post',
            data:  { chatuser: chatusers,imgs:imgs,textmessage:textmessage },
        }).done(function (result) {
            console.log(result);
        })
     }
         
       // alert(chatusers);
    });

//    loginuserimage
//function notifyMe(){  
//     if(textmessage.length>2){
//       var  imgs =   $('.loginuserimage').attr('hello');
//    var chatusers = $('.chatuser').attr('no');
//    $.ajax({
//            url: 'send.php',
//            method: 'post',
//            data:  { chatuser: chatusers,imgs:imgs,textmessage:textmessage },
//        }).done(function (result) {
//        })
//     }
//}
</script>

<?php 
//print_r( $_POST['imgss']);
//die($_POST['chatuser']);

//if($_POST['chatuser']!=''){
//'fdsfsdfsdf';
//die();
$ids2 = "'".$_POST['chatuser']."'";

$magess = $_POST['imgs'];

if(isset($_POST['chatuser']) && $_POST['chatuser']!=''){

//$ids2 = "'".$_POST['chatuser']."'";
//	define('SERVER_API_KEY', 'YOUR SERVER KEY');
define('SERVER_API_KEY', 'AAAAy7GUp5s:APA91bHfAea17V-Ebemzv-_1TEtFoUrRLS2yyMvNkROPsQQuaF6lSyHd5yPKoA7LPBZkZYhhzzLwl8yzGjJFN-dJhaXQjGmFgbg1yESnhKkjLFrEKoTZVVjl-p6z7cpUvtoyFvLXGTmK');
	require 'DbConnect.php';
	$db = new DbConnect;
	$conn = $db->connect();
        if($_POST['chatuser'] == '10' && $ids2 != ''){
            $ids3 = "'".$GLOBALS["user"]['id']."'";
             $stmt = $conn->prepare("SELECT token_id FROM gr_users where  id!=$ids3 and signin_status_id = '1'");
        }elseif($_POST['chatuser'] != '10' && $ids2 != ''){
            $stmt = $conn->prepare("SELECT token_id FROM gr_users where  id=$ids2 and signin_status_id = '1'");
        }
	//print_r($stmt);
	//print_r($ids2);
	$stmt->execute();
	$tokens = $stmt->fetchAll(PDO::FETCH_ASSOC);
	foreach ($tokens as $token) {
		$registrationIds[] = $token['token_id'];
	}
	$header = [
		'Authorization: Key=' . SERVER_API_KEY,
		'Content-Type: Application/json'
	];

	$msg = [
		'title' => 'Leackchat',
		'body' => $_POST['textmessage'],
//		'icon' => './img/icon.png',
//		'image' => './img/d.png',
            'icon' => $magess
//		'image' => $_POST['imgss'],
	];

//        print_r($msg);
//        die();
	$payload = [
		'registration_ids' 	=> $registrationIds,
		'data'				=> $msg
	];

//        $notification = [
//            'title' =>'title',
//            'body' => 'body of message.',
//            'icon' =>'myIcon', 
//            'sound' => 'mySound'
//        ];
//        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
//
//        $fcmNotification = [
//            //'registration_ids' => $tokenList, //multple token array
//            'to'        => $token, //single token
//            'notification' => $notification,
//            'data' => $extraNotificationData
//        ];
//
//        $headers = [
//            'Authorization: key=' . API_ACCESS_KEY,
//            'Content-Type: application/json'
//        ];
        
        
        
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => json_encode( $payload ),
	  CURLOPT_HTTPHEADER => $header
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
//	  echo "cURL Error #:" . $err;
	} else {
//	  echo $response;
}
}
//        }
 ?>