<?php  

 $output = '';  
 session_start();
 include '../../connections/connect.php';
 $trans_id = (string)$_POST['trans_id'];
 $trans_code = (string)$_POST['trans_code'];
 
 
$sql  = "SELECT *,trans_record.price as trans_price from trans_record
LEFT JOIN product ON trans_record.prod_id =  product.prod_id
LEFT JOIN photo ON product.prod_id =  photo.prod_id
WHERE transaction_id='$trans_id'  "; 



 $result = mysqli_query($con, $sql);  
 $output .= '  
            <table class="table" style="font-size:12px">
            <thead class="table-warning">
                <tr>
                    <th hidden>ID</th>
                    <th> Image </th>
                    <th hidden>Prod_id</th>
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
        
                    <img src="../img/products/'.$arr["photo"].'" alt=""
                    class="card-img-top" style="width:70px;height: 70px">
                  
                    </td>
                    <td scope="row" hidden>'.$arr["transaction_id"].'</td>
                    <td scope="row" hidden>'.$arr["prod_id"].'</td>
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
'; 

$sql  = "SELECT * from return_product
LEFT JOIN return_request ON return_product.return_id =  return_request.return_id
LEFT JOIN product ON return_product.prod_id =  product.prod_id
LEFT JOIN photo ON product.prod_id =  photo.prod_id
WHERE return_request.trans_code='$trans_code'";
$res = mysqli_query($con,$sql); 
$check= mysqli_num_rows($res);

if ($check > 0) {
    $output .= '   <br> <hr>
    <center>
    <h4> Returned Product </h4>
    <center>
    <br>
        <table class="table">
        <thead class="table-warning">
            <tr>
            
                <th> Image </th>

                <th>Bardcode</th>
                <th>Product Name</th>
                <th> Price </th>
                <th> Returned Qty</th>
                <th>Total Return Amount</th>
                <th> </th>
            </tr>
        </thead>';
    if (mysqli_num_rows($res) > 0) {
        while($arr = mysqli_fetch_array($res))  
        {  
  
  
             $output .= '  
                  <tr>  
                  <td>
          
                      <img src="../img/products/'.$arr["photo"].'" alt=""
                      class="card-img-top" style="width:70px;height: 70px">
     
                      </td>
                      <td scope="row">'.$arr["barcode"].'</td>
                      <td scope="row">'.$arr["name"].'</td>
                      <td scope="row">₱ '.number_format($arr["price"],2).'</td>
                   
                      <td scope="row">'.$arr["qty"].'</td>
               
                      <td scope="row">₱ '.number_format($arr["total"],2).'</td>
                     <td><span class="badge bg-danger">'.$arr["remarks"].'</span> </td>
                      </tr>
  ';
  }
    }

}


echo $output;
?>