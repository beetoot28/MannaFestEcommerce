<?php  
  session_start();
  include '../connections/connect.php';
 $output = '';  
 $selected = (string)$_POST['selected'];
 $trans_id = (string)$_POST['trans_id'];
 
 $sql  = "SELECT *,trans_record.price as trans_price from trans_record
 LEFT JOIN product ON trans_record.prod_id =  product.prod_id
 LEFT JOIN photo ON product.prod_id =  photo.prod_id
 WHERE transaction_id='$trans_id' and  product.prod_id IN ($selected)  "; 
 
//  $sql = "SELECT * FROM product
// LEFT JOIN photo ON product.prod_id =  photo.prod_id
// WHERE product.prod_id IN ($selected)";
 
  $result = mysqli_query($con, $sql);  
  $output .= '  
             <table class="table">
             <thead class="table-warning">
                 <tr>
                  
                     <th> Img </th>
        
                     <th>Bardcode</th>
                     <th>Product Name</th>
                     <th> Price </th>
                     <th> Qty</th>
                     <th>Total Amount</th>
                 </tr>
             </thead>';  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($arr = mysqli_fetch_array($result))  
       {  
 
 
            $output .= '  
                 <tr>  
                 <td>
         
                     <img src="img/products/'.$arr["photo"].'" alt=""
                     class="card-img-top" style="width:70px;height: 70px">
    
                     </td>
                     <td scope="row">'.$arr["barcode"].'</td>
                     <td scope="row">'.$arr["name"].'</td>
                     <td scope="row">₱ '.number_format($arr["trans_price"],2).'</td>
                  
                     <td scope="row">'.$arr["quantity"].'</td>
              
                     <td scope="row">₱ '.number_format($arr["total"],2).'</td>
                    
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

  
