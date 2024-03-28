<?php 
include 'db_connect.php';
    $qry = $conn->query("SELECT * FROM 'category' WHERE id=".$_GET['id'])->fetch_array();
    foreach ($qry as $k => $val) {
        $$k = $val;
    }
?>
     <!-- Masthead-->
        <header class="masthead">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                         <h1 class="text-uppercase text-white font-weight-bold">Payment</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header>

<section class="page-section bg-warning">
        
        <div class="container"> 
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h4>MPESA Payment Method</h4>
                            </div>
                            <div class="card-body">
                                <form action="push.php" method="POST">
                                    <h5>Amount to PAY: <?="KES".number_format($amount, 2) ?></h5>
                                    <input type="hidden" name="id" value="<?=$_GET['id'] ?>">
                                    <div class="form-group mb-2 mt-4">
                                        <label for="" class="form-control-label">Mpesa Phone Number</label>
                                        <input type="text" name="phone_number" class="form-control">
                                    </div>
                                    <input type="hidden" name="amount" value="<?=$amount ?>">
                                    <input type="submit" value="PAY" class="btn btn-primary">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>  
</section>
<style type="text/css">
    .item-rooms img {
    width: 23vw;
}
</style>
<script>
    $('.book_now').click(function(){
        uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&cid='+$(this).attr('data-id'))
    })
    
    var date = new Date();

    var tdate = date.getDate();
    var month = date.getMonth() +1;
    if(tdate < 10){
        tdate = '0' + tdate;
    }
    if(month <10){
        month = '0' + month;
    }
    var year = date.getUTCFullYear();
    var minDate = year + "-" + month + "-" + tdate;
    document.getElementById("demo").setAttribute('min', minDate)
    console.log(minDate);
    

</script>