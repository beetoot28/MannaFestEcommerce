<?php
session_start();
include '../../connections/connect.php';

$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {
$update_field='';
if(isset($input['prod_date'])) {
    $prod_date = $input['prod_date'];

    $update_field.= "prod_date='".$prod_date."'";
    
    }
 else if(isset($input['exp_date'])) {

    $update_field.= "exp_date='".$input['exp_date']."'";
    
    }
        


if($update_field && $input['production_code']) {
$sql_query = "UPDATE production_log SET $update_field WHERE production_code='" . $input['production_code'] . "'";
mysqli_query($con, $sql_query) or die("database error:". mysqli_error($conn));


}
}
?>