<?php 
require_once("includes/config.php");
if(!empty($_POST["supid"])) {
  $supid=$_POST["supid"];
 
    $sql ="SELECT supname,supid FROM tblsuppliers WHERE (supid=:supid)";
$query= $dbh -> prepare($sql);
$query-> bindParam(':supid', $supid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
  foreach ($results as $result) {?>
<option value="<?php echo htmlentities($result->supid);?>"><?php echo htmlentities($result->supname);?></option>
<b>Supplier Name :</b> 
<?php  
echo htmlentities($result->supname);
 echo "<script>$('#submit').prop('disabled',false);</script>";
}
}
 else{?>
  
<option class="others"> Invalid Supplier</option>
<?php
 echo "<script>$('#submit').prop('disabled',true);</script>";
}
}



?>
