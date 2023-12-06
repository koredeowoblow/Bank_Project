<?php
$fat = "0";
$title="home";
include "../funtion/header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper animate__animated animate__fadeInDown "  id="home" >

  <?php
  ?>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0"></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">

        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid  animate__animated animate__slideInDown animate__delay-1s">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="container  p-2 mx-4" style="width:500vmax,500vmin;">
          <!-- small box -->
          <div class="small-box col-12 p-3"  style="background-image: linear-gradient(to bottom right,springgreen,forestgreen);box-shadow: 2px 2px 20px #707070;border-radius: 20px;">
            <div class="inner p-2">
              <div class="row ">
                <div class="col-sm-6 col-6">
                  <p class="font-weight-bold act" style="font-size:100%;text-align:start;">Account balance
                    <i class="btn btn-tone bg-transparent see fas fa-eye-slash button " style="color:white;" data-id="<?php echo $_SESSION["User_id"]; ?>"></i>
                  </p>
                  <h5 class="accts font-weight-bold mx-4" id="accts"></h5>
                  <h3 class="acct  mx-4">****</h3>
                </div>
                <div class="col-sm-6 col-6 " style="justify-content: right!important;justify-self: right;">
                  <a class="font-weight-bold" style="color:white;float:right;text-decoration:underline;font-size:90%;text-align:right;" href="../transactions/index.php">transaction history</a>
                </div>

              </div>

              <div class="col-12  " style="justify-self: center;">
                <div class="row  my-3  p-2" style="justify-content: center!important;">
                  <div class="col-3 animate__animated animate__jackInTheBox col-sm-3   my-5 " style="width:20%;justify-content: center!important;">
                    <button class=" btn  btn-tone bg-white add" onclick="add_money()">
                    
                      <i class=" fas fa-plus"></i>
                    </button>
                    <p class="font-weight-bold" style="font-size:2vmax,1.5vmin ;">add money</p>
                  </div>
                  <div class="col-3 animate__animated animate__rotateInUpRight  my-5  col-sm-3   " style="width:20%;justify-content: center!important;">
                    <button class=" btn btn-tone bg-white transfer " onclick="transfer()"><i class="fas fa-exchange-alt"></i></button>
                    <p class="font-weight-bold   ">transfer</p></button>
                  </div>
                  <div class="col-3 animate__animated animate__rollIn my-5 col-sm-3   " style="width:20vmax,10vmin;justify-content: center!important;">
                    <button class=" btn btn-tone bg-white withdraw" onclick=""><i class=" fas fa-expand-arrows-alt"></i></button>
                    <p class="font-weight-bold">withdraw</p></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<?Php
include "../funtion/footer.php";

?>