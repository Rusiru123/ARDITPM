<?php
session_start();
//error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{ 

if(isset($_POST['update']))
{
$supid=intval($_GET['supid']);
$name=$_POST['supname'];
$add=$_POST['address'];
$tpno=$_POST['tpno'];
$email=$_POST['email'];
$sql="update  tblsuppliers set supname=:supname,address=:address,tpno=:tpno,email=:email where supid=:supid";
$query = $dbh->prepare($sql);
$query->bindParam(':supname',$name,PDO::PARAM_STR);
$query->bindParam(':address',$add,PDO::PARAM_STR);
$query->bindParam(':tpno',$tpno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':supid',$supid,PDO::PARAM_STR);
$query->execute();
$_SESSION['updatemsg']="Supplier info updated successfully";
header('location:manage-suppliers.php');

echo '<script>alert("Update supplier successfully")</script>';

}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="supplier" content="" />
    <title>ARD | Edit Supplier</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

</head>
<body>
      <!------MENU SECTION START-->
<?php include('includes/header.php');?>
<!-- MENU SECTION END-->
    <div class="content-wrapper">
    <div class="content-wrapper">
         <div class="container">
        <div class="row pad-botm">
            <div class="col-md-12">
                <h4 class="header-line"></h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">
<div class="panel-heading">
Supplier Info
</div>
<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Supplier Name:</label>
<?php
$supid=intval($_GET['supid']);
$sql = "SELECT * from  tblsuppliers where supid='$supid'";
$query = $dbh -> prepare($sql);
$query->bindParam(':supid',$supid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
    ?>
    <label>Supplier Name:</label>
    <input class="form-control" type="text" name="supname" value="<?php echo htmlentities($result->supname);?>" required />
    <label>address:</label>
    <input class="form-control" type="text" name="address" value="<?php echo htmlentities($result->address);?>" required />
    <label>TP NO:</label>
    <input class="form-control" type="text" name="tpno" value="<?php echo htmlentities($result->tpno);?>" required />
    <label>E-Mail:</label>
    <input class="form-control" type="text" name="email" value="<?php echo htmlentities($result->email);?>" required />

<?php }} ?>
</div>

<button type="submit" name="update" class="btn btn-info">Update </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
     <!-- CONTENT-WRAPPER SECTION END-->
  <?php include('includes/footer.php');?>
      <!-- FOOTER SECTION END-->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
</body>
</html>
<?php } ?>