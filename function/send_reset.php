<?php 

session_start();
 include('../connections/connect.php');
 require 'PHPMailer/PHPMailerAutoload.php';
                        if (isset($_POST['reset'])) {
                            
                            $email = $_POST['email'];
                         

                            $sql = " select * from `accounts` where  email = '$email' ";
                            $result = mysqli_query($con,$sql); 
                            
                           $count = mysqli_num_rows($result);
                          if($count >=1){
                            $data = mysqli_fetch_array($result);
                            $name = $data['name'].' '.$data['lastname'];
                                    //END
                                    $random_string = str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
                                    $random_string = substr($random_string, 0, 12);
                                    $phpmailer = new PHPMailer();

                                    try {
                                        //Server settings
                                    
                                        $phpmailer->isSMTP();
                                        $phpmailer->Host = 'smtp.hostinger.com';
                                        $phpmailer->SMTPAuth = true;
                                        $phpmailer->Port = 587;
                                        $phpmailer->Username = 'no-reply@mannafest-app.online';
                                        $phpmailer->Password = 'Mannafest_101';


                                        $phpmailer->setFrom('no-reply@mannafest-app.online', 'Mannafest Food Inc. Online');
                                        $phpmailer->addAddress($email);

                                        //Attachments
                                        //$phpmailer->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                                        // $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                                        //Content
                                        $phpmailer->isHTML(true);                                  //Set email format to HTML
                                        $phpmailer->Subject = 'Password Rest Request | Mannafest Food Online'; 
                                        $phpmailer->Body    = "
                                    <center>
                                    <img src='https://i.ibb.co/pRm7g7h/logo.png' alt='header' border='0'>
                                        <h3>Mannafest Food Inc. Online</h3>
                                    </center>
                                          
                                    <p>   
                                    Hi  $name.
                                    <br> <br>
                                    There was a request to change your password!
                                    
                                    If you did not make this request then please ignore this email.
                                    
                                    Otherwise, please click this link to change your password:  <a href='localhost/manna-system/log/reset_pass.php?token=$random_string' class='btn btn-primary btn-lg active' role='button' aria-pressed='true'>Reset Password</a>
                                        </p>

                                        ";


                                        $phpmailer->send();
                                        echo 'Message has been sent';
                                   
                                        $user_id = $data['user_id'];
                                    $query = "INSERT INTO password_reset (user_id,reset_token,is_valid) 
                                         VALUES ('$user_id','$random_string','1')";
                                      $results = mysqli_query($con, $query);
                                      header("Location: ../log/forgot.php");
                                      $_SESSION['sent']= "successful";

                                    } catch (Exception $e) {
                                        echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
                                    }




                          }	
                          else {

                            $_SESSION['error']= "successful";
                                 header("Location: ../log/forgot.php");
                          }
                                //exit();
                                }



              

?>