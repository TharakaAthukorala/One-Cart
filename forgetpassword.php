<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Untitled document</title>
        <link href="../css/forget.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
        <style>
            body
            {
                font-family:Tahoma, Geneva, sans-serif;
                color:#000;
                background-image:url(../images/mmm.jpg);
                background-size:cover;
            }

        </style>
    </head>

    <body>
        <div class="forget">
        <form>
            <h2 align="center" style="color:#fff;">Forget Password </h2>
            <h5 style="font-size:14px; color: ;">Enter email here that you used on your account. we send link on your email to reset your password. </h5>

            <input type="text" name="username" placeholder="Enter your email"/><br/><br/>
            <input type="button" value="Send" onclick="myFunction()"/><br/><br/>
            <a href="login.php" style="text-decoration:none;">Go back to Home page</a><br/><br/>

            <div id="snackbar">Link send on your email successfully !! </div>
            <script>
                function myFunction()
                {
                    var x=document.getElementById("snackbar");
                    x.className="show";
                    setTimeout(function()
                    {
                        x.className=x.className.replace("show","");
                    },3000);
                }
            </script>
        </form>
        </div>
    </body>
</html>
