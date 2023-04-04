<?php

    session_start();

    if(isset($_SESSION["user"])) {

        header("Location: index.php");

        exit();

    }

    $title = "إنشاء الحساب";

    include "init.php";

?>

<!-- Start sign up form -->
<div class="container">
    <div class="form sign-up">
        <h1 class="signup-signin">Create account</h1>
        <input class="signup_username" type="text"     placeholder="Username" />
        <input class="signup_email"    type="text"     placeholder="Email" />
        <input class="signup_password" type="password" placeholder="Password" />
        <input class="signup_submit"   type="submit"   id="register" value="Sign up" />
    </div>
</div>

<script>
    /*
        Sign up Ajax
    */
    let signup_username =  document.querySelector(".sign-up .signup_username"),
        signup_email    =  document.querySelector(".sign-up .signup_email"),
        signup_password =  document.querySelector(".sign-up .signup_password"),
        signup_submit   =  document.querySelector(".sign-up .signup_submit"),
        emptyUsername   =  document.createElement("div"),
        emptyEmail      =  document.createElement("div"),
        emptyPassword   =  document.createElement("div"),
        successRegister =  document.createElement("div"),
        failedRegister  =  document.createElement("div");


    // Create request Ajax
    let request = new XMLHttpRequest();

    signup_submit.addEventListener("click", () => {

        request.onreadystatechange = function() {

            if(this.readyState === 4 && this.status === 200) {
    
                if(signup_username.value == "") {

                    emptyUsername.style.display = "block";
            
                    emptyUsername.className = "error";
            
                    emptyUsername.textContent = "The username is empty !";
            
                    signup_username.before(emptyUsername);
                    
                } else {
            
                    emptyUsername.style.display = "none";
            
                }
            
                if(signup_email.value == "") {
            
                    emptyEmail.style.display = "block";
            
                    emptyEmail.className = "error";
            
                    emptyEmail.textContent = "The email is empty !";
            
                    signup_email.before(emptyEmail);
                    
                } else {
            
                    emptyEmail.style.display = "none";
            
                }
            
                if(signup_password.value == "") {
            
                    emptyPassword.style.display = "block";
            
                    emptyPassword.className = "error";
            
                    emptyPassword.textContent = "The password is empty !";
            
                    signup_password.before(emptyPassword);
                    
                } else {
            
                    emptyPassword.style.display = "none";
            
                }

                if(signup_username.value != "" && signup_email.value != "" && signup_password.value != "") {

                    if(this.responseText == 1) {
        
                        successRegister.style.display = "block";
        
                        failedRegister.style.display = "none";
        
                        successRegister.className = "success";
        
                        successRegister.textContent = "Successful register";
        
                        signup_username.before(successRegister);

                        signup_username.value = "";

                        signup_email.value = "";

                        signup_password.value = "";
        
                    } else {
        
                        successRegister.style.display = "none";
        
                        failedRegister.style.display = "block";
        
                        failedRegister.className = "error";
        
                        failedRegister.textContent = "The email is already exists !";
        
                        signup_email.before(failedRegister);
        
                    }

                } else {

                    successRegister.style.display = "none";
        
                    failedRegister.style.display = "none";
                    
                }

            }

        }

        // Make a request
        request.open("POST", "ajax/signup.php", true);

        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Send the request
        request.send(`username=${signup_username.value}&email=${signup_email.value}&password=${signup_password.value}`);

    });

</script>