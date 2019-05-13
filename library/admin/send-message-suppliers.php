<?php
session_start();
//error_reporting(0);
include('includes/config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(); // create a new object
$mail->isSMTP();
$mail->Host = 'smtp.googlemail.com';  //gmail SMTP server
$mail->SMTPAuth = true;
$mail->Username = 'gajarthan@gmail.com';   //username
$mail->Password = 'Maithily0112';   //password
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;                    //SMTP port
$mail->setFrom('gajarthan@gmail.com', 'ARD');

if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}else{

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ARD | Send Notification to supplier</title>
    <!-- BOOTSTRAP CORE STYLE  -->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONT AWESOME STYLE  -->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLE  -->
    <link href="assets/css/style.css" rel="stylesheet" />
    <!-- GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	
	<script>
// function for get student name
function getstudent() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'studentid='+$("#studentid").val(),
type: "POST",
success:function(data){
$("#get_std_name").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

//function for book details
function getemail() {
$("#loaderIcon").show();
jQuery.ajax({
url: "get_student.php",
data:'emailid='+$("#emailid").val(),
type: "POST",
success:function(data){
$("#get_std_email").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

</script> 
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
                <h4 class="header-line">Send Notification to Supplier</h4>
                
                            </div>

</div>
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
<div class="panel panel-info">

<div class="panel-body">
<form role="form" method="post">
<div class="form-group">
<label>Supplier Name<span style="color:red;">*</span></label>
<select class="form-control" name="dusername" required="required">
<option value=""> Select Supplier</option>
<?php 
$status=1;
$sql = "SELECT * from tblsuppliers ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
<option value="<?php echo htmlentities($result->email);?>">
    <?php echo htmlentities($result->supname);?>
    </option>
 <?php
    }
} 
    ?> 
    </select>
</div>

<div class="form-group">
<label>Title<span style="color:red;">*</span></label>
<input class="form-control" type="text" name="title"  placeholder="Enter title here" required="required" autocomplete="off"  />

</div>

 <div class="form-group">
 <label>Message<span style="color:red;">*</span></label>
     <textarea class="form-control" type="text" name="msg" autocomplete="off" rows="5" cols="50" required="required" ></textarea>
 </div>
<button class="btn btn-info" type="submit" name="send" value="Send Notification">Send </button>

                                    </form>
                            </div>
                        </div>
                            </div>

        </div>
   
    </div>
    </div>
<!--INSERT DATA -->
<?php 
      if(isset($_POST['send']))
      {
          $susername=$_SESSION['alogin'];
          $dusername=$_POST['dusername'];
          $title=$_POST['title'];
          $msg=$_POST['msg'];
          $read1= 'n';
          $sql="INSERT INTO tblsupmessages(susername,dsupname,title,msg,status) VALUES('$susername','$dusername','$title','$msg','$read1')";
          $query = $dbh->prepare($sql);
          $query->execute();
          $mail->addAddress($dusername, 'ARD');

          $mail->isHTML(true);

          $mail->Subject = $title;
          $mail->Body    = $msg;

          $mail->send();


          $lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    ?>
        <?php echo '<script>alert("Notification sent Successfully!!");</script>';
        ?>
        
        <?php

}
else 
{?>

        <script type="text/javascript">
            alert ("Somthing went wrong!!");
        </script>
        
        <?php
}
      }
      
        
?>

        
        
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
