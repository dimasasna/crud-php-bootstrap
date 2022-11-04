<!DOCTYPE html>
<html lang="en">
<?php
    session_start()
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>


    <div class="login">
        <h1 class="text-center">Hello Dimas!</h1>
        <form class="needs-validation" method="post" action="auth.php" onclick="return validation()">
            <div class="form-group was-validated">
                <label class="form-label" for="email">Username</label>
                <input class="form-control" type="text" id="email" name="user" required>
                <div class="invalid-feedback">
                    Please enter your username
                </div>
            </div>
            <div class="form-group was-validated">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" type="password" id="password" name="password" required>
                <div class="invalid-feedback">
                    Please enter your password
                </div>
            </div>
            <input class="btn btn-success w-100" type="submit" value="LOGIN">
        </form>
    </div>

</body>

</html>