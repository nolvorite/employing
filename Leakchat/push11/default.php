<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>Firebase Web Push Notification Example</h2>

<p id="token"></p>

<script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-messaging.js"></script>






 <link rel="manifest" href="manifest.json">
<script>
       //Initialise Service workers
        if ('serviceWorker' in navigator) {
            // Register service worker
            navigator.serviceWorker.register('service-worker.js').then(function (reg) {
                console.log("SW registration succeeded. Scope is " + reg.scope);
            }).catch(function (err) {
                console.error("SW registration failed with error " + err);
            });
        }
        
    var firebaseConfig = {
    /*    apiKey: "YOUR_API_KEY",
        authDomain: "YOUR_FIREBASE_DOMAIN_NAME",
        databaseURL: "YOUR_FIREBASE_DATBASE_URL",
        projectId: "YOUR_FIREBASE_PROJECT_ID",
        storageBucket: "YOUR_FIREBASE_STORAGE_BUCKET END WITH appspot.com",
        messagingSenderId: "YOUR SENDER ID",
        appId: "YOUR APP ID",
        measurementId: "YOUR MEASUREMENT ID"*/
		
		  apiKey: "AIzaSyDoQdPROyyWsy0RhjLqvzJ8qpi5Vb-xeUc",
					authDomain: "leackchat.firebaseapp.com",
					databaseURL: "https://leackchat.firebaseapp.com",
					projectId: "leackchat",
					storageBucket: "leackchat.appspot.com",
					messagingSenderId: "874857670555",
					appId: "1:874857670555:web:705b14ce6ca1ab3edb233e",
					measurementId: "G-9WBS1VC9JH"
    };

    firebase.initializeApp(firebaseConfig);

    const messaging=firebase.messaging();


  
        messaging.requestPermission().then(function () {
        
                console.log("Notification Permission granted.");
        getRegisterToken();
                }).catch(function (err) {
                console.log('Unable to get Permission to notify.',err);
            });


                 function getRegisterToken() {

                      messaging.getToken().then(function (newtoken) {
                            if(newtoken){
                                 console.log(newtoken);
                                sendTokenToServer(newtoken);
                                }else{
                                  console.log("No Instance ID token avalible. Request Permission to generate one.");
                     
                                  setTokenSentToServer(false);
                                }
                          }).catch(function (err) {

                           console.log('An error occurred while retrieving token. ', err);
    //showToken('Error retrieving Instance ID token. ', err);
    setTokenSentToServer(false);
                                    //console.log('An error occured while retriveing token.'.err);
                                   // setTokenSentToServer(false);
                      });
    
                  }

                  function setTokenSentToServer(sent){
                  window.localStorage.setItem('sentToServer',sent ? '1':'0');
                  }
                 


   // IntitalizeFireBaseMessaging();



   
/*
    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                document.getElementById("token").innerHTML=token;
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
            })
    })
    IntitalizeFireBaseMessaging();*/
</script>
</body>
</html>