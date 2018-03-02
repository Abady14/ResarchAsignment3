
<script type="text/javascript">
if(document.cookie.split(";")[0].split("=")[0] != "")//the login page checks for cookies every time it loads.if the password and id are saved,it'll redirects to homepage without showing login page
        {
        window.location.href = "index.html";
        }

if(condition)//condition when username and password are valid
            {
                var uname=document.getElementById("zname").value;
                var pswd=document.getElementById("zpswd").value;
                if(document.getElementById("chkbx").checked) //Remember me checkbox (stores username and password until "logout" is clicked in homepage)
                {
                    document.cookie=uname+"="+pswd;
                    alert("You will be automtically logged in when you visit this page again" +uname);
                }



                window.location.href="index.html";
            }
</script>
<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    header("location: error.php");
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['active'] = $user['active'];

        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        header("location: error.php");
    }
}
