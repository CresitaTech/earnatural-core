<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?=base_url('public/img/favicon.ico')?>" type="images/ico">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/css/bootstrap.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/css/custom.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('public/css/login.css')?>" />

    <title>Login</title>
</head>

<body>
    <div class="login-wrap">
        <div class="container h-100">
            <div class="row  align-items-center h-100"> <!-- justify-content-center -->
                <div class="col-sm-12 col-md-12 col-lg-4 m-auto">
                    <div class="bg-white rounded p-4">
                        <form action="<?=base_url('home/login')?>" name="loginForm" method="post">
                            <div class="row mb-3">
                                <div class="col logo text-center">
                                        <img src="<?=base_url('public/img/logo.png')?>" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <h4 class="font-weight-bold">Login</h4>
                                    <small class="form-text text-muted">Login with your data that you entered during your registration</small>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" id="userName" name="email"
                                    placeholder="Enter User Name">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                               <input type="password" class="form-control"  name="password" id="password" placeholder="Enter Password">
                               
                            </div>
                            
                            <button type="submit" id="loginUser" class="btn btn-primary btn-block mt-3 mb-2">Login</button>
                           
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?=base_url('public/js/jquery-3.3.1.slim.min.js')?>"></script>
    <!-- Popper.JS -->
    <script src="<?=base_url('public/js/popper.min.js')?>"></script>
    <!-- Bootstrap JS -->
    <script src="<?=base_url('public/js/bootstrap.min.js')?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <script >

$(document).ready(function () {

    $('#loginUser').click(function () {

        var form=$("#loginForm");
        var formdata = form.serialize()
        console.log(formdata)
    axios.post('/api/login', formdata)
        .then((response) => {
            console.log(response);
            
            if (response.data.status == '201') {
                console.log(response);
            } else {
                //document.getElementById("myModal").style.display = 'none';
                console.log(response);
            }

        }, (error) => {
            console.log(error);
            

        });


    });
})
       

	
    </script>
</body>

</html>