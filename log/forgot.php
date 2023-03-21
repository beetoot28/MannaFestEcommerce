<?php

session_start();
include '../connections/connect.php'; 

// if (isset($_GET['v'])) {
//     $user_id = $_GET['v'];
//   }

?>


<HTML>
<HEAD>
<TITLE>Forgot Password</TITLE>
<link href="../assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="../assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />

</HEAD>
<BODY>
	<div class="phppot-container">
		<div class="sign-up-container">
			<div class="signup-align">
		
					<div class="signup-heading">Forgot Password</div>
                        <?php
                        if (! empty($displayMessage["status"])) {
                            if ($displayMessage["status"] == "error") {
                                ?>
				    <div class="server-response error-msg"><?php echo $displayMessage["message"]; ?></div>
                                <?php
                                    } else if ($displayMessage["status"] == "success") {
                                        ?>
                    <div class="server-response success-msg"><?php echo $displayMessage["message"]; ?></div>
                                <?php
                                    }
                                }
                                ?>
				<div class="row">
						<div class="inline-block">
							<form action='../function/send_reset.php' method='POST'>
							<div class="form-label">
								Email<span class="required error" id="username-info"></span>
							</div>
							<input class="input-box-330" type="email" name="email"
								id="username">
						</div>
					</div>
					<div class="row">
						<input class="btn" type="submit" name="reset" id="forgot-btn"
							value="Forgot Password">
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
function loginValidation() {
	var valid = true;
	$("#username").removeClass("error-field");
	var UserName = $("#username").val();
	$("#username-info").html("").hide();

	if (UserName.trim() == "") {
		$("#username-info").html("required.").css("color", "#ee0000").show();
		$("#username").addClass("error-field");
		valid = false;
	}
	if (valid == false) {
		$('.error-field').first().focus();
		valid = false;
	}
	return valid;
}
</script>
</BODY>
</HTML>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- RECEIVING VOUCHER -->
<?php if (isset($_SESSION['sent'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'success',
        title: 'Password Reset Request Sent',
        text: 'Please check your email',
    })
    </script>
    <?php 
			unset($_SESSION['sent']);
		?>
</div>

<?php endif ?>

<?php if (isset($_SESSION['error'])): ?>
<div class="msg">

    <script>
    Swal.fire({
        icon: 'info',
        title: 'Email not Found',
        text: 'Please try again',
    })
    </script>
    <?php 
			unset($_SESSION['error']);
		?>
</div>

<?php endif ?>

