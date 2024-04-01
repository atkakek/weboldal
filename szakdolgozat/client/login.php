<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../client/css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="loginPanel">
                    <h1 class="my-3">Login/Sign up Panel</h1> 
                    <form class="mx-5">
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name" onchange="info(this)" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" onchange="info(this)" required>
                        </div>
                            <button type="submit" class="btn btn-primary" onclick="done(event)">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>

    function info(){
        let username = document.getElementById("name").value
        let password = document.getElementById("password").value
        console.log('username: ' + username +
                    ' password: ' + password
        );
    }

    function done(e){
        e.preventDefault();
        const myFormData = new FormData(document.querySelector('form'))
        let configObj = {
            method: 'POST',
            body: myFormData
        }
        postData('../server/addUser.php', renderResult, configObj);
        
    }
    function renderResult(data) {
        console.log(data);
    }


</script>