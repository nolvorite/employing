<script>
function notifyMe(){  
    
        
//        alert($('.chatuser .lazyimg').attr('src'));
     if(textmessage.length>2){
         
          var imgs ='';
//         if($('.chatuser .lazyimg').attr('src') == undefined){
                 
//               var imgs =   'https://cdn.icon-icons.com/icons2/37/PNG/512/online_4158.png';
             if($('.userimagepushnotification').attr('src') != undefined){
//                 alert('1');
                imgs =   $('.userimagepushnotification').attr('src');
             
           }else{
//               alert('2');
//                var imgs = '';
                   imgs =  '/gem/ore/grupo/users/default.png';
           }
         
        
//         if($('.chatuser .lazyimg').attr('src') == undefined){
                 
//               var imgs =   'https://cdn.icon-icons.com/icons2/37/PNG/512/online_4158.png';
          //  var imgs =   $('.chatuser .lazyimg').attr('src');
//           }else{
//                var imgs =   $('.chatuser .lazyimg').attr('src');
//                var imgs =   $('.userimagepushnotification').attr('src');
//           }
    
    var chatusers = $('.chatuser').attr('no');
    $.ajax({
            url: 'send.php',
//            url: '',
            method: 'post',
            data:  { chatuser: chatusers,textmessage:textmessage,imgss:imgs },
//            data: 'chatuser=' + chatusers,'textmessage='+textmessage,'imgs='+imgs
        }).done(function (result) {
//            console.log(result);
//            alert(textmessage);
//            alert(imgs);
        })
     }
}
</script>

<?php 

//die($_POST['chatuser']);

//if($_POST['chatuser']!=''){
//'fdsfsdfsdf';
//die();
$ids2 = "'".$_POST['chatuser']."'";



if(isset($_POST['chatuser'])){

//$ids2 = "'".$_POST['chatuser']."'";
//	define('SERVER_API_KEY', 'YOUR SERVER KEY');
define('SERVER_API_KEY', 'AAAAy7GUp5s:APA91bHfAea17V-Ebemzv-_1TEtFoUrRLS2yyMvNkROPsQQuaF6lSyHd5yPKoA7LPBZkZYhhzzLwl8yzGjJFN-dJhaXQjGmFgbg1yESnhKkjLFrEKoTZVVjl-p6z7cpUvtoyFvLXGTmK');
	require 'DbConnect.php';
	$db = new DbConnect;
	$conn = $db->connect();
        if($ids2 == 0 && $ids2 != ''){
            $ids3 = "'".$GLOBALS["user"]['id']."'";
             $stmt = $conn->prepare("SELECT token_id FROM gr_users where  id!=$ids3");
        }else{
            $stmt = $conn->prepare("SELECT token_id FROM gr_users where  id=$ids2");
        }
	
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
            'icon' => $_POST['imgss'],
//		'image' => $_POST['imgss'],
	];

	$payload = [
		'registration_ids' 	=> $registrationIds,
		'data'				=> $msg
	];

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