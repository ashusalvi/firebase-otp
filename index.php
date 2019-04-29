<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Firebase OTP</title>
    <script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "********************",
            authDomain: "*******.firebaseapp.com",
            databaseURL: "*************************",
            projectId: "**************",
            storageBucket: "********.appspot.com",
            messagingSenderId: "************"
        };
        firebase.initializeApp(config);
    </script>
</head>
<body>
<div id="recaptcha-container"></div>



<script>

        firebase.auth().languageCode = 'en';
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': function(response) {
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            onSignInSubmit();
        }
        });
        // window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render().then(function(widgetId) {
            window.recaptchaWidgetId = widgetId;
        });
    
    
    var phoneNumber = '+917350100085';
    var appVerifier = window.recaptchaVerifier;
    firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
        .then(function (confirmationResult) {
            console.log(confirmationResult);
            window.confirmationResult = confirmationResult;
            // SMS sent. Prompt user to type the code from the message, then sign the
        // user in with confirmationResult.confirm(code).
            // setotp(confirmationResult);
        
        }).catch(function (error) {
        // Error; SMS not sent
        // ...
        console.log(error);
        });

        // function setotp(confirmationResult){ 
        //     console.log(confirmationResult);
            var code = '123456';
            window.confirmationResult.confirm(code).then(function (result) {
                // User signed in successfully.
                console.log('User signed in successfully');
                var user = result.user;
                // ...
                }).catch(function (error) {
                // User couldn't sign in (bad verification code?)
                // ...
                });
        //  }

        
    
    </script>
</body>
</html>
