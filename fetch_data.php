<?php
include('dbconnect.php');
if(isset($_POST["action"]))
{
    $query = $conn->query("SELECT * FROM produk");
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
        $query = $conn->query("SELECT * FROM produk WHERE hargaafter BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'");
    }
    $total_row = mysqli_num_rows($query);
    $output = '';
    if($total_row > 0){
        while ($row = $query ->fetch_object()) {
            $output .= '
            <div class="col-sm-4 col-lg-3 col-md-3">
                <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:320px;">
                    <img src="images/'. $row->gambar .'" alt="" class="img-responsive" >
                    <p align="center"><strong><a href="#">'. $row->namaproduk .'</a></strong></p>
                    <h4 style="text-align:center;" class="text-danger" >'. $row->hargaafter .'</h4>
                </div>
            </div>';
        }
    }else{
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}
?>