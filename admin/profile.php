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



        <section class="main">

            <div class="topbar shadow-sm">
                <button class="btn btn-light text-dark" id="slideleft" style="font-size: 10px;"><i
                        class="fas fa-arrow-left"></i></button>

                <button class="btn btn-light text-dark d-none" id="slideright" style="font-size: 10px;"><i
                        class="fas fa-arrow-right"></i></button>
    

            </div>

            <div class="main_contents">
                <div class="container">

                    <h5 style="font-weight: bolder;">CREDENTIALS</h5>
                    <hr>
                    <div class="card shadow-sm" style="">
                        <div class="card-body">


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





    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {


        table_category();

        function table_category() {


            $.ajax({
                url: "action_profile.php",
                method: "POST",
                data: {
                    profile: 1
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