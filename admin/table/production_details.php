<style>
th {
    font-size: 14px;
}
</style>

<?php  
include '../../connections/connect.php';
 $prod_id = (string)$_POST['prod_id'];


$sql  = "SELECT *,production_log.cost as prod_cost,production_log.price as prod_price  from production_log
LEFT JOIN product on production_log.prod_id = product.prod_id
WHERE production_log.prod_id='$prod_id' ORDER BY log_id DESC"; 
$output='';


 $result = mysqli_query($con, $sql);  
 $output .= '  
            <table id="prods_record_table" class="table" style="width:100%">
            <thead class="table-dark">
                <tr >
                    <th>Production Code</th>
                    <th>Name</th>
                    <th>Qty Added</th>
                    <th>Remaining Quantity</th>
                    <th>Production Date</th>
                    <th>Expiration Date</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Status</th>
                </tr>
            </thead>';  
 if(mysqli_num_rows($result) > 0)  
 {  
      while($arr = mysqli_fetch_array($result))  
      {  

          $color='';
          if ($arr['status'] == 'EMPTY'){
               $color = 'danger';
          }
          else if ($arr['status'] == 'LOW'){
               $color = 'warning';
          }
          else if ($arr['status'] =='ACTIVE'){
               $color = 'success';
          }
          else if ($arr['status'] =='EXPIRED'){
               $color = 'danger';
          }
           $output .= '  
                <tr>  
                <td><div class="badge">'.$arr['production_code'].'</div></td>
                <td>'.$arr['name'].'</td>
                <td><div class="badge">'.$arr['qty_added'].'</div></td>
                <td><div class="badge_1">'.$arr['qty_remaining'].'</div></td>
                <td>'.$arr['prod_date'].'</td>
                <td>'.$arr['exp_date'].'</td>
               <td scope="row" >₱ '.number_format($arr["prod_cost"],2).'</td>
               <td scope="row" >₱ '.number_format($arr["prod_price"],2).'</td>
                <td><span class="badge bg-'.$color.' text-white">'.$arr["status"].'</span></td>
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
 $output .= '

 </table>  


      </div>';  
 echo $output;  
 ?>

<script>
$('#prods_record_table').DataTable({
    dom: 'Bfrtip',
    order: [[0, 'desc']],
    buttons: [
        'excel', 'pdf', 'print'
    ],
});

$(document).ready(function() {
            $('#prods_record_table').Tabledit({
                deleteButton: false,
                editButton: false,
                columns: {
                    identifier: [0, 'production_code'],
                    editable: [
                        [4, 'prod_date'],
                        [5, 'exp_date'],
                     

                    ]
                },

                url: 'functions/live_edit_stockin.php'
            });
        });

</script>


