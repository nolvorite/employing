

<script src="https://www.gstatic.com/firebasejs/4.9.1/firebase.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="manifest" href="manifest.json">
<script>
    // Initialize Firebase
    /*Update this config*/
    var config = {

    apiKey: "AIzaSyDoQdPROyyWsy0RhjLqvzJ8qpi5Vb-xeUc",
        authDomain: "leackchat.firebaseapp.com",
        databaseURL: "https://leackchat-default-rtdb.firebaseio.com",
        projectId: "leackchat",
        storageBucket: "leackchat.appspot.com",
        messagingSenderId: "874857670555",
        appId: "1:874857670555:web:a73ead03e169f1fddb233e",
        measurementId: "G-C5ZM4RM9ZS"
        
       /*     apiKey: "AIzaSyBHND9dXFaQfL1kz39CGADPjPWjZnQPA7Y",
        authDomain: "leakchat-15f95.firebaseapp.com",
        projectId: "leakchat-15f95",
        storageBucket: "leakchat-15f95.appspot.com",
        messagingSenderId: "540990227372",
        appId: "1:540990227372:web:dd785bd23282c5d9ea3009",
         databaseURL: "https://leakchat-15f95.firebaseapp.com"*/
    };
    firebase.initializeApp(config);

    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
    messaging.requestPermission()
            .then(function () {
                console.log('Notification permission granted.');
                // TODO(developer): Retrieve an Instance ID token for use with FCM.
                if (isTokenSentToServer()) {
                 //  getRegToken();
                    console.log('Token already saved.');
                } else {
                    getRegToken();
                }

            })
            .catch(function (err) {
                console.log('Unable to get permission to notify.', err);
            });

    function getRegToken(argument) {
        messaging.getToken()
                .then(function (currentToken) {
                    if (currentToken) {
                        saveToken(currentToken);
//                        console.log(currentToken);
                        setTokenSentToServer(false);
                    } else {
                        console.log('No Instance ID token available. Request permission to generate one.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function (err) {
                    console.log('An error occurred while retrieving token. ', err);
                    setTokenSentToServer(false);
                });
    }

    function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? 1 : 0);
    }

    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') == 1;
    }

    function saveToken(currentToken) {
        //alert(currentToken);
        $.ajax({
            //url: 'action.php',
            url: 'pushnoti_token.php',
            method: 'post',
            data: 'token=' + currentToken
        }).done(function (result) {
            console.log(result);
        })
    }

    messaging.onMessage(function (payload) {
        console.log("Message received. ", payload);
        notificationTitle = payload.data.title;
        notificationOptions = {
            body: payload.data.body,
            icon: payload.data.icon,
            image: payload.data.image
        };
        var notification = new Notification(notificationTitle, notificationOptions);
    });
    
    
    
 
    
</script>
<?php

if (isset($_POST['token'])) {
    $servername = cnf($v = "Grupo")['host'];
    $username = cnf($v = "Grupo")['user'];
    $password = cnf($v = "Grupo")['pass'];
    $dbname = cnf($v = "Grupo")['db'];
   $prefix =  cnf($v = "Grupo")['prefix'];
     $table_name = `$prefix'_users'`;
     
    
//    $servername = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "leakchat_leakchat";
// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $ids = "'" . $GLOBALS["user"]['id'] . "'";
    $sql = "SELECT * FROM gr_users where id = " . $ids;
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if ($row[0]['token_id'] != "") {
        $sql = "Update `gr_users` SET `token_id`='" . $_POST['token'] . "',`signin_status_id`='" . 1 . "'  WHERE id = " . $ids . "";
  // $sql = "Update `gr_users` SET `token_id`='" . $_POST['token'] . "'  WHERE id = " . $ids . "";
        if ($conn->query($sql) === TRUE) {
//            echo "New record updated successfully";
        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } 
//    elseif ($row[0]['token_id'] == "") {
//        $sql = "INSERT INTO gr_users (`token_id`)
//VALUES ('" . $_POST['token'] . "')";
//
//        if ($conn->query($sql) === TRUE) {
//            echo "New record created successfully";
//        } else {
//            echo "Error: " . $sql . "<br>" . $conn->error;
//        }
//    }



    $conn->close();
}
?>
