<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 8 Firebase Web Pus Notification</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" style="margin-top: 50px">
        <div style="text-align: center">
            <h4>
                Laravel 8 Firebase Web Push Notification
            </h4>
            <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Click here - Allow Notification</button>
        </div>

        <form action="{{route('notification.send')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Notification Title" name="title">
            </div>
            <div class="form-group">
                <label for="body">Body:</label>
                <input type="text" class="form-control" id="body" placeholder="Notification Body" name="body">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>


<script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.0.2/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries
  
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
      apiKey: "AIzaSyAzteVl9j9amZKuxHIIqiuZnl6RVykAGNY",
      authDomain: "laravel-web-push-notific-415ad.firebaseapp.com",
      projectId: "laravel-web-push-notific-415ad",
      storageBucket: "laravel-web-push-notific-415ad.appspot.com",
      messagingSenderId: "336104874389",
      appId: "1:336104874389:web:ad77167e7793144ff4d69c",
      measurementId: "G-P6DF33HR4D"
    };
  
    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    // const analytics = getAnalytics(app);

    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging.requestPermission().then(function(token) {
            return messaging.getToken();
        }).then(function(token) {
            console.log(token);

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN':'{{csrf_token()}}'
                }
            });

            $.ajax({
                url:'{{route("notification.save-token")}}',
                type:'POST',
                data:{
                    token:token
                },
                dataType:'JSON',
                success:function(response) {
                    alert('Token saved successfully.');
                },
                error:function(err) {
                    console.log('User Chat Token Error' , + err);
                },
            });
        }).catch(function(err) {
            console.log('User Chat Token Error' + err);
        });
    }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body:payload.notification.body,
            icon:payload.notification.icon,
        };
        new Notification(noteTitle , noteOptions);
    });
</script>