<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=yes">
    <link rel="stylesheet" type="text/css" href="/home/single/Desktop/design/fontawesome/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>
<div class="container-mount mount-bg">
    <img src="img/123asdf.jpg" class="img-bg-login">
    <div class="mount-login-box shadow-lg p-3 mb-5">
        <form>

            <div class="pt-1">
                <label for="Username" class="mount-label">Username</label>
                <input type="text" class="form-control " id="Username" aria-describedby="emailHelp" placeholder="Enter Name">
            </div>
            <div class="pt-2">
                <label for="loginpass" class="mount-label">Password</label>
                <input type="Password" class="form-control " id="loginpass" aria-describedby="emailHelp" placeholder="Enter Password">
            </div>
            <div class="d-flex  pt-4 mt-1">
                <button type="button" class="mount-login-button" >Login&#8594;</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
