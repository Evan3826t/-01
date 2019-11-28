<?php
include_once ("../base.php");

$total = find("total", 1);
$total['total']=$_POST['total'];

save("total",$total);
to("../admin.php?do=total");
?>