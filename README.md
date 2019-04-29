# firebase-otp
Authenticate with Firebase with a Phone Number Using JavaScript

You can use Firebase Authentication to sign in a user by sending an SMS message to the user's phone. The user signs in using a one-time code contained in the SMS message.

# FirebaseUI
The easiest way to add phone number sign-in to your app is to use FirebaseUI, which includes a drop-in sign-in widget that implements sign-in flows for phone number sign-in, as well as password-based and federated sign-in. This document describes how to implement a phone number sign-in flow using the Firebase SDK.
URL : https://opensource.google.com/projects/firebaseui

# Enable phone number 
To sign in users by SMS, you must first enable the Phone Number sign-in method for your Firebase project:
1)In the Firebase console, open the Authentication section. 
Firebase console URL : https://console.firebase.google.com/u/0/
2)On the Sign-in Method page, enable the Phone Number sign-in method.
3)On the same page, if the domain that will host your app isn't listed in the OAuth redirect domains section, add your domain.

# read documentation
Read all detail documentaion in detail on google firebase 
URL : https://firebase.google.com/docs/auth/web/phone-auth

# My Code Explanation
  # 1)  Include there library and Initialize Firebase
  <script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "<****Used your API key********>",
            authDomain: "<***Domain Name****>.firebaseapp.com",
            databaseURL: "<****Firebase database url*******>",
            projectId: "<*****Project id********>",
            storageBucket: "<***domain****>.appspot.com",
            messagingSenderId: "<*****Sender id******>"
        };
        firebase.initializeApp(config);
    </script>
   
   # 2) Make Div for recaptcha
    <div id="recaptcha-container"></div>
    
   # 3)Set inivisible recaptcha & Send OTP to mobile number & Enter OTP to varification
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
         
      //Send OTP to mobile number
          var phoneNumber = '+91<****Enter mobile number*****>';
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
        </script>
        
     //Enter OTP to varification
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
        </script>
  
  
