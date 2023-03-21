<?php  
  session_start();
include '../../connections/connect.php';

 $output = '';  

 $trans_id = (string)$_POST['trans_id'];
 
$sql  = "SELECT * from trans_record
LEFT JOIN product ON trans_record.prod_id =  product.prod_id
WHERE transaction_id='$trans_id' "; 



 $result = mysqli_query($con, $sql);  
 $output .= '  
            <table class="table">
            <thead class="table-dark">
                <tr>
                   
                    <th>Product</th>
                    <th>Price</th>
                    <th>QTY</th>
                    <th>Total</th>
                </tr>
            </thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($arr = mysqli_fetch_array($result))  
      {  


           $output .= '  
                <tr>  
               
                <td scope="row" >'.$arr["name"].'</td>
                <td scope="row">'.$arr["price"].'</td>
                <td scope="row">'.$arr["quantity"].'</td>
                <td>'.$arr['total'].'</td>
            
                </tr>  
           ';  
      } 
      
}
 else  
 {  
      $output .= '<tr>  
                          <td colspan="4">Nothings in the cart</td>  
                     </tr>';  
 }  
 $output .= '</table>  


      </div>';  
 echo $output;  
 ?>