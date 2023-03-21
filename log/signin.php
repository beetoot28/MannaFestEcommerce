<?php 
session_start();

if(isset($_SESSION['admin_id'])){
	header('location:../admin/dashboard.php');
}
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortout icon" type="image/x-icon" href="">-->
    <!---->
    <script src="https://kit.fontawesome.com/129b086bc9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery.Wload.css">
    <title>Signin - Manna</title>

    <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New&display=swap');

    * {
        font-family: 'Zen Kaku Gothic New', sans-serif;
    }

    .logo_container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .form-control {

        border-radius: 20px;
    }

    .txt {
        font-size: 14px;
    }



    .text {
        position: relative;
        top: 10px;
        right: 10px;
    }

    .subtitle {
        position: absolute;
        right: 20px;
    }

    .form-group {
        border: 1px solid #ced4da;
        padding: 5px;
        border-radius: 6px;
        width: auto;
    }

    .form-group:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
    }

    .form-group input {
        display: inline-block;
        width: auto;
        border: none;
    }

    .form-group input:focus {
        box-shadow: none;
    }
    </style>

</head>

<body style="background-color: #FFFEF1">

    <div class="container">
        <p style="user-select: none"><br></p>
        <div class="row mt-5">



            <div class="col-md-4 mx-auto">

                <div class="card shadow-sm" style="border-radius: 20px; background-color:white; color:black;">
                    <div class="card-body">


                        <div class="logo_container">
                            <a href="../index.php">
                                <img src="../assets/logo/logo.png" alt=""
                                    class="animate__animated animate__bounceInDown">
                            </a>
                            <br>
                        </div>

                        <!---Login-->
                        <form method="post" action="login.php" id="login" class="" onsubmit="return false">

                            <input type="hidden" name="login">

                            <div class="container py-4">
                                <link rel="preconnect" href="https://fonts.googleapis.com">




                                <div class="alert alert-danger d-none" id="logalert" role="alert"
                                    style="text-align: center;padding: 3px">
                                    <span class="text-danger" style="font-size: 13px;font-weight: bolder;">Unknown Email
                                        or Password</span>
                                </div>

                                <label>Email:</label>
                                <input type="email" class="form-control txt mb-3" id="em_lg" name="email" style=""
                                    required="">

                                <label>Password:</label>
                                <input type="password" class="form-control txt mb-4" id="pw_lg" name="password" style=""
                                    required="">

                                <button type="submit" name="login" id="btnlogin"
                                    class="btn btn-primary form-control mb-1 py-2" style="font-style: 16px">
                                    Login</button>


                            </div>
                            <div class="row">
                                <div class="col-sm-8"> <a href="javascript:void(0)" class="registerhere"
                                        style="text-decoration: none">Don't have
                                        an Account?<br>Register here.</a></div>
                                <div class="col-sm-4"> <a href="forgot.php"" style=" text-decoration: none">Forgot
                                        Password</a></div>
                            </div>

                        </form>

                        <!--End Login-->
                        <?php 
 	 	 		 	 	 	 /*

					
 	 	 		 	 	 	 */

 	 	 		 	 	 	  ?>
                        <!--REGISTER-->
                        <form method="post" action="action.php" onsubmit="return false" id="reg_step1">
                            <input type="hidden" name="reg_step1">



                            <div id="step1" class="d-none">

                                <h5 class="text-dark mb-4">Registration</h5>

                                <h6 style="font-size: 14px"> <span class="badge badge-success bg-success">Step 1 -
                                        3</span></h6>
                                <div class="progress-bar" role="progressbar" style="width: 33.3333s%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>

                                <label>Lastname:</label>
                                <input type="text" class="form-control txt mb-2" name="ln" style="" required="">

                                <label>Firstname:</label>
                                <input type="text" class="form-control txt mb-2" name="fn" style="" required="">

                                <label>BirthDate:</label>
                                <input type="date" class="form-control txt mb-2" name="bd" style="" required="">
                                <hr>

                                <label>Address:</label>
                                <input type="text" class="form-control txt mb-2" name="addr" style="" required="">

                                <label>Postal Code:</label>
                                <input type="number" class="form-control txt mb-2" name="postal" style="" required="">


                                <label>Delivery Address (Street Name, Building, House No.):</label>

                                <textarea class="form-control txt mb-2" name="daddr" cols="4"></textarea>





                                <button type="submit" class="btn btn-primary form-control mb-1 py-2 mt-2"
                                    style="font-style: 16px"> Next</button>
                                    <center>
                                <button type="button" class="btn btn-secondary text-light mt-2 back"
                                    style="font-size: 14px"> Already have an account</button>

                               <br>
                                    <p style='font-size:12px'> <br>

                                        DATA PRIVACY NOTICE
                                        <br>
                                        The Mannafest Food Inc. values the confidentiality of persoanl date. All
                                        information
                                        we collect shall be kept private and in accordance with the Data Privacy Act of
                                        2012.
                                    </p>
                                </center>
                            </div>

                        </form>

                        <form method="post" action="action.php" onsubmit="return false" id="reg_step2">
                            <input type="hidden" name="reg_step2">


                            <div id="step2" class="d-none">
                                <h6 class="text-primary mb-4">Login Credentials</h6>

                                <h6 style="font-size: 14px"> <span class="badge badge-success bg-success">Step 2 -
                                        3</span></h6>
                                <div class="progress-bar" role="progressbar" style="width: 66.755%" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100"></div>

                                <label>Email:</label>
                                <input type="text" class="form-control txt mb-2" name="em" style="" required="">

                                <label>Password:</label>
                                <input type="password" class="form-control txt mb-2" name="pass" id="pass" style=""
                                    required="">

                                <label>Re-Enter Password:</label>
                                <input type="password" class="form-control txt mb-2" name="repass" id="repass" style=""
                                    required="">



                                <button type="submit" class="btn btn-primary form-control mb-1 py-2 mt-2"
                                    style="font-style: 16px">Next</button>


                                <button type="button" data-step="2"
                                    class="btn btn-light form-control mb-1 py-2 mt-2 back1" style="font-style: 16px">
                                    Back</button>
                                <button type="button" class="btn btn-light text-primary mt-2 back"
                                    style="font-size: 14px"> Already have an account</button>

                                <br>

                            </div>

                        </form>




                        <form method="post" action="action.php" onsubmit="return false" id="reg_step3">
                            <input type="hidden" name="reg_step3">

                            <div id="step3" class="d-none">


                                <h6 style="font-size: 14px"> <span class="badge badge-success bg-success">Step 3 -
                                        3</span></h6>
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                                <label>Enter Mobile Number</label>
                                <br>

                                <center>
                                    <div class="form-group mt-2 d-inline-block">
                                        <span class="border-end country-code px-2">+63</span>
                                        <input type="text" class="form-control" name="phone_number"
                                            aria-describedby="emailHelp" placeholder="91257888" maxlength="10" />
                                    </div>
                                </center>


                                <button type="submit" class="btn btn-primary form-control mb-1 py-2 mt-2"
                                    style="font-style: 16px">Register</button>




                                <button type="button" class="btn btn-light form-control mb-1 py-2 mt-2 back2"
                                    style="font-style: 16px"> Back</button>

                                <button type="button" class="btn btn-light text-primary mt-2 back"
                                    style="font-size: 14px"> Already have an account</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <script type="text/javascript" src="../js/jquery.Wload.js"></script>
    <script>
    $(document).ready(function() {

        $('#login').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);


            $('#btnlogin').html(
                '<div class="spinner-grow spinner-grow-sm" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow spinner-grow-sm" role="status"><span class="visually-hidden">Loading...</span></div><div class="spinner-grow spinner-grow-sm" role="status"><span class="visually-hidden">Loading...</span></div>'
            );
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",

                success: function(data) {
                    console.log(data);
                    if (data == 'match') {
                        $('#em_lg').removeClass('is-invalid');
                        $('#pw_lg').removeClass('is-invalid');
                        $('#em_lg').addClass('is-valid');
                        $('#pw_lg').addClass('is-valid');
                        $('#logalert').addClass('d-none');

                        setInterval(function() {
                            window.location.href = "../index.php";
                        }, 2000);

                    } else if (data == 'verify_first') {
                        $('#em_lg').removeClass('is-invalid');
                        $('#pw_lg').removeClass('is-invalid');
                        $('#em_lg').addClass('is-valid');
                        $('#pw_lg').addClass('is-valid');
                        $('#logalert').addClass('d-none');

                        setInterval(function() {
                            window.location.href = "verify.php";
                        }, 1000);
                    } else if (data == 'adminmatch') {
                        $('#em_lg').removeClass('is-invalid');
                        $('#pw_lg').removeClass('is-invalid');
                        $('#em_lg').addClass('is-valid');
                        $('#pw_lg').addClass('is-valid');
                        $('#logalert').addClass('d-none');

                        setInterval(function() {
                            window.location.href = "../admin/dashboard.php";
                        }, 2000);
                    } else if (data == 'couriermatch') {
                        $('#em_lg').removeClass('is-invalid');
                        $('#pw_lg').removeClass('is-invalid');
                        $('#em_lg').addClass('is-valid');
                        $('#pw_lg').addClass('is-valid');
                        $('#logalert').addClass('d-none');

                        setInterval(function() {
                            window.location.href = "../courier/";
                        }, 2000);


                    } else {

                        $('#em_lg').addClass('is-invalid');
                        $('#pw_lg').addClass('is-invalid');
                        $('#pw_lg').val('');
                        $('#logalert').removeClass('d-none');
                        $('#btnlogin').html('Login');

                    }
                }
            })
        });


        $('#reg_step1').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    //alert(data);
                    $('#step1').addClass('d-none');
                    $('#step2').removeClass('d-none');
                }
            })
        });

        $('#reg_step2').on('submit', function(event) {
            event.preventDefault();

            var pass = $('#pass').val();
            var repass = $('#repass').val();

            if (pass != repass) {

                $('#pass').notify(
                    "Password Doesnot Match", {
                        position: "right"
                    }
                );
                $('#repass').notify(
                    "Password Doesnot Match", {
                        position: "right"
                    }
                );
            } else {
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#step2').addClass('d-none');
                        $('#step3').removeClass('d-none');
                    }
                })
            }


            /*	*/
        });

        $('#reg_step3').on('submit', function(event) {
            $('body').Wload({
                text: ' Processing',
            });
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    $('#login').removeClass('d-none');
                    $('#step1').addClass('d-none');
                    $('#step2').addClass('d-none');
                    $('#step3').addClass('d-none');

                    window.location.href = "verify.php?v=" + data;

                    // $('body').Wload('hide', {
                    //     time: 1000
                    // })
                    // $.notify("Registered Successfully! ", "success");
                }
            })
        });


        $('.back1').click(function() {

            $('#step2').addClass('d-none');
            $('#step1').removeClass('d-none');


        })

        $('.back2').click(function() {
            $('#step3').addClass('d-none');
            $('#step2').removeClass('d-none');
        })

        $('.registerhere').click(function() {
            $('#login').addClass('d-none');
            $('#step1').removeClass('d-none');
        })

        $('.back').click(function() {
            $('#login').removeClass('d-none');
            $('#step1').addClass('d-none');
            $('#step2').addClass('d-none');
            $('#step3').addClass('d-none');

        })
    });
    </script>


    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>