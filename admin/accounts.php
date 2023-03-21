<?php 
session_start();
include "../connections/connect.php";
if(!isset($_SESSION['admin_id'])){
  header('location:../log/signin.php');
}

 ?>
<!DOCTYPE html>
<html>

<?php include 'head.php' ?>

<body style="background-color: white">
    <div class="wrapper">


        <nav class="sidenav shadow">
            <?php include 'navbar.php' ?>
        </nav>


        <section class="home-section">



            <div class="">
                <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;"><i
                        class="fas fa-arrow-left"></i></button>

                <button class="btn btn-light text-dark d-none" id="slideright" style="font-size: 10px;"><i
                        class="fas fa-arrow-right"></i></button>

            </div>

            <div class="main_contents">
                <div class="container">

                    <h5 style="font-weight: bolder;">ACCOUNTS</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


                            <button class="btn btn-warning  text-white mb-2" data-bs-toggle="modal"
                                data-bs-target="#addmodal" data-backdrop="static" data-keyboard="false"
                                style="font-size: 14px;">Add new <i class="fas fa-plus-circle"></i></button>

                            <!--
    <label style="font-size: 14px" class="mb-2 mt-4">Enter new Category:</label>
                      <input type="text" name="" class="form-control" style="font-size: 12px">
                      <hr>
                       <button class="btn btn-light  text-primary" style="font-size: 12px;float: right;" >Add new <i class="fas fa-plus-circle"></i></button>
                        -->




                            <div id="table_category">
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>

                            </div>







                        </div>

                    </div>
                </div>



            </div>


            <div class="footer shadow">

            </div>






        </section>

    </div>


    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <br>
                    <form method="post" enctype="multipart/form-data" action="action_account.php"
                        onsubmit="return false" id="savenew">

                        <input type="hidden" name="savenew">





                        <h6>Add new User</h6>
                        <hr>
                        <label style="font-size: 14px">User-Type</label>
                        <select class="form-select mb-1" name="usertype" style="font-size: 14px">
                            <option value="client">Customer</option>
                            <option value="courier">Delivery</option>
                        </select>

                        <!-- <span style="font-size: 14px">Include a Profile Photo.</span>
                        <input type="file" style="font-size: 14px" name="profile" class="form-control e"
                            accept="image/*"> -->
                        <label style="font-size: 14px">Contact</label>
                        <input type="number" name="contact" style="font-size: 14px" class="form-control e" required="">


                        <label style="font-size: 14px">Email</label>
                        <input type="email" name="email" style="font-size: 14px" class="form-control e" required="">

                        <label style="font-size: 14px">Lastname</label>
                        <input type="text" name="lastname" style="font-size: 14px" class="form-control e" required="">

                        <label style="font-size: 14px">Firstname</label>
                        <input type="text" name="firstname" style="font-size: 14px" class="form-control e" required="">

                        <label style="font-size: 14px">Password</label>
                        <input type="text" id="pass" name="password" style="font-size: 14px" class="form-control e"
                            required="">

                        <button type="button" class="btn btn-secondary mt-2" id='generatepass'
                            style="font-size: 13px">Generate a Password</button>




                        <button type="submit" id="disabledsave" class="btn btn-primary  mt-3"
                            style="font-size: 15px;float: right;">Save</button>

                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-body">
                    <button type="button" class="btn-close" style="float: right;" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <br>
                    <form method="post" action="action_account.php" onsubmit="return false" id="editcategory">

                        <input type="hidden" name="editcategory">
                        <h6>Update User</h6>
                        <label style="font-size: 14px">Email</label>
                        <input type="email" name="eemail" id="eemail" style="font-size: 14px" class="form-control"
                            required="">

                        <label style="font-size: 14px">Lastname</label>
                        <input type="text" name="elastname" id="elastname" style="font-size: 14px" class="form-control"
                            required="">

                        <label style="font-size: 14px">Firstname</label>
                        <input type="text" name="efirstname" id="efirstname" style="font-size: 14px"
                            class="form-control" required="">

                        <label style="font-size: 14px">Contact</label>
                        <input type="number" name="econtact" id="econtact" style="font-size: 14px" class="form-control"
                            required="">


                        <input type="hidden" id="catid" name="uid">
                        <button type="submit" id="disabledsaved" class="btn btn-primary text-white mt-3"
                            style="font-size: 15px;float: right;">Update</button>

                    </form>

                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="cartlist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">



                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="float: right;"
                        aria-label="Close"></button>

                    <br>
                    <h6 style="font-size: 14px;font-weight: bolder;text-transform: uppercase;" class="text-info"
                        id="usercart"> </h6><i class="fas fa-shopping-cart text-info"></i>
                    <hr>
                    <input type="hidden" name="" id="userid">
                    <style type="text/css">
                    #item::-webkit-scrollbar {

                        width: 4px;
                    }
                    </style>
                    <div class="card-body" id="item" style="height: 400px;overflow-y: scroll;">

                        <!--Items-->
                        <div id="usercarts"></div>

                        <!---->







                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        // var id = $('#userid').val();

        function getusercart(id) {
            $.ajax({
                url: "action_account.php",
                method: "POST",
                data: {
                    getusercart: 1,
                    id: id
                },
                success: function(data) {
                    $('#usercarts').html(data);

                }
            })
        }




    });
    </script>


    <div class="modal fade" id="wishlist" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">




                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="float: right;"
                        aria-label="Close"></button>

                    <br>
                    <h6 style="font-size: 14px;font-weight: bolder;text-transform: uppercase;" class="text-danger"
                        id="usercartw"> </h6> <i class="fas fa-heart text-danger"></i>
                    <hr>
                    <input type="hidden" name="" id="useridw">
                    <style type="text/css">
                    #item::-webkit-scrollbar {

                        width: 4px;
                    }
                    </style>
                    <div class="card-body" id="item" style="height: 400px;overflow-y: scroll;">

                        <div id="userwlist"></div>





                    </div>

                </div>
            </div>
        </div>
    </div>





    <div class="modal fade" id="changepp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">




                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="float: right;"
                        aria-label="Close"></button>

                    <br>
                    <form method="post" enctype="multipart/form-data" action="action_account.php"
                        onsubmit="return false" id="changepicture">
                        <input type="hidden" name="changepicture">

                        <h6 style="font-weight: bolder"> Change Profile Photo </h6>
                        <input type="file" id="ppp" name="pp" class="form-control" style="font-size: 14px"
                            accept="image/*" required="">
                        <input type="hidden" name="uid" id="userid">
                        <button type="submit" class="btn btn-dark form-control mt-2"
                            style="font-size: 14px">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>










    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {


        $('#changepicture').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",

                success: function(data) {
                    $('#ppp').val('');
                    table_category();
                    $.notify("Added Successfully!", "success");
                    $('.btn-close').click();
                }
            })
        });

        $('#generatepass').click(function() {


            $('#pass').val(generatePassword(8))

        })

        function generatePassword(passwordLength) {
            var numberChars = "0123456789";
            var upperChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            var lowerChars = "abcdefghijklmnopqrstuvwxyz";
            var allChars = numberChars + upperChars + lowerChars;
            var randPasswordArray = Array(passwordLength);
            randPasswordArray[0] = numberChars;
            randPasswordArray[1] = upperChars;
            randPasswordArray[2] = lowerChars;
            randPasswordArray = randPasswordArray.fill(allChars, 3);
            return shuffleArray(randPasswordArray.map(function(x) {
                return x[Math.floor(Math.random() * x.length)]
            })).join('');
        }

        function shuffleArray(array) {
            for (var i = array.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
            }
            return array;
        }



        $('#savenew').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                method: "POST",

                success: function(data) {

                    table_category();
                    $.notify("Added Successfully!", "success");
                    $('.btn-close').click();


                }
            })
        });



        $('#editcategory').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    table_category();
                    $.notify("Modified Successfully!", "success");
                    $('.btn-close').click();
                }
            })

        });

        var myModalEl = document.getElementById('addmodal')
        myModalEl.addEventListener('hidden.bs.modal', function(event) {
            $('.e').val('');
        })


        $('#newcat').keyup(function() {
            var val = $(this).val();

            if (val == '') {
                $('#msg').html('');
            } else {



                $.ajax({
                    url: "action_account.php",
                    method: "POST",
                    data: {
                        checkifexistcat: 1,
                        val: val
                    },
                    success: function(data) {
                        if (data.match('exist')) {
                            $('#disabledsave').attr('disabled', true);
                            $('#msg').html(
                                '<span class="text-danger" style="font-size:12px">Already Exist!</span>'
                            );
                        } else {
                            $('#disabledsave').removeAttr('disabled');
                            $('#msg').html('');
                        }
                    }
                })
            }



        })

        $('#editcat').keyup(function() {

            var val = $(this).val();

            if (val == '') {

            } else {



                $.ajax({
                    url: "action_account.php",
                    method: "POST",
                    data: {
                        checkifexistcat: 1,
                        val: val
                    },
                    success: function(data) {
                        if (data.match('exist')) {
                            $('#disabledsaved').attr('disabled', true);
                            $('#msgs').html(
                                '<span class="text-danger" style="font-size:12px">Already Exist!</span>'
                            );
                        } else {
                            $('#disabledsaved').removeAttr('disabled');
                            $('#msgs').html('');
                        }
                    }
                })
            }
        })


        table_category();

        function table_category() {


            $.ajax({
                url: "action_account.php",
                method: "POST",
                data: {
                    category: 1
                },
                success: function(data) {
                    $('#table_category').html(data);
                }
            })


        }


    });
    </script>

    <script type="text/javascript" src="../js/sidebar.js?v=1"></script>



    <!--Bootstrap Plugins-->
    <script type="text/javascript" src="../js/notify.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/popper.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>