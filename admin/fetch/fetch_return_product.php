<style>
/* Basic styling */

[type=checkbox] {
    width: 2rem;
    height: 2rem;
    color: black;
    vertical-align: middle;
    -webkit-appearance: none;
    background: none;
    border: 1;
    outline: 0;
    flex-grow: 0;
    border-radius: 50%;
    background-color: #FFFFFF;
    transition: background 300ms;
    cursor: pointer;
}


/* Pseudo element for check styling */

[type=checkbox]::before {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: transparent;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #D6FAFF;
}


/* Checked */

[type=checkbox]:checked {
    background-color: currentcolor;
}

[type=checkbox]:checked::before {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


/* Disabled */

[type=checkbox]:disabled {
    background-color: #CCD3D8;
    opacity: 0.84;
    cursor: not-allowed;
}


/* IE */

[type=checkbox]::-ms-check {
    content: "";
    color: transparent;
    display: block;
    width: inherit;
    height: inherit;
    border-radius: inherit;
    border: 0;
    background-color: #FCF4A3;
    background-size: contain;
    box-shadow: inset 0 0 0 1px #CCD3D8;
}

[type=checkbox]:checked::-ms-check {
    box-shadow: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E %3Cpath d='M15.88 8.29L10 14.17l-1.88-1.88a.996.996 0 1 0-1.41 1.41l2.59 2.59c.39.39 1.02.39 1.41 0L17.3 9.7a.996.996 0 0 0 0-1.41c-.39-.39-1.03-.39-1.42 0z' fill='%23fff'/%3E %3C/svg%3E");
}


  #select_prod_return {
    font-size: 10px;
  }

</style>

<?php  
  session_start();
  include '../../connections/connect.php';
 $output = '';  

 $trans_id = (string)$_POST['trans_id'];
 
 $sql  = "SELECT *,trans_record.price as trans_price
 from transaction
 LEFT JOIN trans_record on transaction.tid = trans_record.transaction_id
 LEFT JOIN product ON trans_record.prod_id =  product.prod_id
 LEFT JOIN photo ON product.prod_id =  photo.prod_id
 WHERE transaction_id='$trans_id' "; 
 
 
 
  $result = mysqli_query($con, $sql);  
  $output .= '  
             <table class="table" id="select_prod_return" style="font-size: 10px !important">
             <thead class="table-warning"  style="font-size: 10px !important">
                 <tr >
                  
                     <th> Img </th>
        
                     <th>Bardcode</th>
                     <th>Product Name</th>
                     <th width="13%"> Price </th>
                    
                     <th width="13%">Total Amount</th>
                     <th>Ordered Quantity</th>
                     <th width="10%"> Return Qty</th>
                     <th>Select Product</th>
                 </tr>
             </thead>';  
  if(mysqli_num_rows($result) > 0)  
  {  
       while($arr = mysqli_fetch_array($result))  
       {

       $qty=  $arr["quantity"];
       $prod_id = $arr["prod_id"];
            $output .= '  
                 <tr>  
                 <td>
         
                     <img src="../img/products/'.$arr["photo"].'" alt=""
                     class="card-img-top" style="width:70px;height: 70px">
                   
                     </td>
                     <td scope="row" hidden>'.$arr["transaction_id"].'</td>
                     <td scope="row">'.$arr["barcode"].'</td>
                     <td scope="row">'.$arr["name"].'</td>
                     <td scope="row">₱ '.number_format($arr["trans_price"],2).'</td>

                     <td scope="row">₱ '.number_format($arr["total"],2).' </td>
                     <td scope="row">'.number_format($arr["quantity"]).'</td>
                     <td scope="row">
                     <input  class="form-control" id="qty_'.$prod_id.'" name="qty[]" value="'.$arr["quantity"].'" onkeyup="checkQty(this.value,'.$qty.','.$prod_id.')"/>
                     
                     
                     </td>
                     <td><input type="checkbox" id="select_prod_check_'.$prod_id.'" name="product_select[]" value="'.$prod_id.'"> <label for="'.$prod_id.'"></label></td>
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
 
 <script>
  function checkQty(qty, order_qty, item_id) {
    document.getElementById("select_prod_check_" + item_id).checked = true;
    if (qty > order_qty) {
      alert("Quantity cannot be greater than current quantity.");
      document.getElementById("qty_" + item_id).value = order_qty;
      return false;
    }
    return true;
    console.log(qty);
  }
</script>