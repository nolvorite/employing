function sendPushMessage() {

    var receiverToken = document.getElementById("push_ReceiverToken").value;
    var key = 'AAAAA011N5U:APA91bGzD3NHCvJWufPimdgEqYo8Y1fd-SROFRg4COBktrt10w1wcFzRfLawYlY0TE3h2AXuy9Jq3KR2cH5vh5njVoBgJPJfyGdhrI6dHMEAWZNOqFujp7jcX1uAvEQ5eNWsDvBjL9UF'; // Server API key

    var endUsersList = [];
    endUsersList.push(receiverToken);

    var title = document.getElementById("push_Title");
    var message = document.getElementById("push_Message");

    // Generate Notification Content
    var notification = {
        'title': title.value,
        'body': message.value,
        'icon': 'notification-icon.png',
        'click_action': 'http://www.toyotabharat.com/'
    };


    //This function to sends push notification to users
    for (var i = 0; i <= endUsersList.length - 1; i++)
    {
    fetch('https://fcm.googleapis.com/fcm/send', {
        'method': 'POST',
        'headers': {
            'Authorization': 'key=' + key,
            'Content-Type': 'application/json'
        },
        'body': JSON.stringify({
            'notification': notification,
            'to': endUsersList[i]
        })
    }).then(function (response) {
      //  console.log(response);
    }).catch(function (error) {
       // console.error(error);
    })
}

}