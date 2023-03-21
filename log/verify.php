<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../css/verify.css">


<?php
session_start();
include '../connections/connect.php'; 

// if (isset($_GET['v'])) {
//     $user_id = $_GET['v'];
//   }

?>

<div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="position-relative">
        <div class="card p-2 text-center">
            <h6>Please enter the one time password <br> to verify your account</h6>
            <form action='../function/validate-otp.php' method='POST'>
                <input value='<?php echo $_SESSION['verify_user_id'] ?>' name='user_id' hidden >
                <div> <span>A code has been sent to</span> <small><?php  echo $_SESSION['reg_phone'] ?></small> </div>
                <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2"> <input
                        class="m-2 text-center form-control rounded" type="number" name="first" id="first"
                        maxlength="1" /> <input class="m-2 text-center form-control rounded" type="number" name="second"
                        id="second" maxlength="1" /> <input class="m-2 text-center form-control rounded" type="number"
                        name="third" id="third" maxlength="1" /> <input class="m-2 text-center form-control rounded"
                        type="number" name="fourth" id="fourth" maxlength="1" /> <input
                        class="m-2 text-center form-control rounded" type="number" name="fifth" id="fifth"
                        maxlength="1" /> <input class="m-2 text-center form-control rounded" type="number" name="sixth"
                        id="sixth" maxlength="1" /> </div>
                <div class="mt-4"> <button type='submit' name='verify' class="btn btn-danger px-4 validate">Validate</button> </div>
        </div>
        </form>
        <div class="card-2">
            <div class="content d-flex justify-content-center align-items-center"> <span>Didn't get the code</span> <a
                    href="#" class="text-decoration-none ms-3">Resend</a> </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function(event) {

    function OTPInput() {
        const inputs = document.querySelectorAll('#otp > *[id]');
        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('keydown', function(event) {
                if (event.key === "Backspace") {
                    inputs[i].value = '';
                    if (i !== 0) inputs[i - 1].focus();
                } else {
                    if (i === inputs.length - 1 && inputs[i].value !== '') {
                        return true;
                    } else if (event.keyCode > 47 && event.keyCode < 58) {
                        inputs[i].value = event.key;
                        if (i !== inputs.length - 1) inputs[i + 1].focus();
                        event.preventDefault();
                    } else if (event.keyCode > 64 && event.keyCode < 91) {
                        inputs[i].value = String.fromCharCode(event.keyCode);
                        if (i !== inputs.length - 1) inputs[i + 1].focus();
                        event.preventDefault();
                    }
                }
            });
        }
    }
    OTPInput();


});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- RECEIVING VOUCHER -->
<?php if (isset($_SESSION['error'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'info',
        title: 'Incorrect OTP Code!',
        text: 'Please Try Again',
    })
    </script>
    <?php 
			unset($_SESSION['error']);
		?>
</div>

<?php endif ?>


<?php if (isset($_SESSION['verify_first'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'info',
        title: 'Unverified Account',
        text: 'We send you a new code, please verify your account first',
    })
    </script>
    <?php 
			unset($_SESSION['verify_first']);
		?>
</div>
<?php endif ?>