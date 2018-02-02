<?php require_once('Connections/connIPEGmaster2.php'); ?>
<?php


$query_rsDetails = "SELECT abstractreply.*, abstractAuthors.*, tblAbsRevResults_IS.*
FROM (abstractreply LEFT JOIN abstractAuthors ON abstractreply.Presenter = abstractAuthors.authorId) RIGHT JOIN tblAbsRevResults_IS ON abstractreply.abstractId = tblAbsRevResults_IS.Abstract_ID
ORDER BY tblAbsRevResults_IS.Avg_Score DESC, abstractreply.abstractId ASC;";
$rsDetails = mysqli_query($connIPEGmaster, $query_rsDetails) or die("This did not work");
$totalRows_rsDetails = mysqli_num_rows($rsDetails);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="ISO-8859-1">
<title>IPEG INNOVATIONS SESSION REVIEW RESULTS</title>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9pt;
}
-->
</style>
</head>

<body>
<?php while ($row_rsDetails = mysqli_fetch_array($rsDetails)) { ?>
  <p><strong>Abstract ID: <?php echo $row_rsDetails['abstractreply.abstractId']; ?></strong></p>
  <p><strong><?php echo utf8_encode("{$row_rsDetails['abstractreply.abstractTitle']}"); ?></strong><br />
  <?php echo utf8_encode("{$row_rsDetails['abstractreply.fullauthorlist']}"); ?>; <?php echo utf8_encode("{$row_rsDetails['abstractreply.institutions']}"); ?></p>
  <p><strong>Country: </strong>  <?php echo $row_rsDetails['abstractreply.Country']; ?><br />
  <strong>Presenter: </strong><?php echo utf8_encode("{$row_rsDetails['abstractAuthors.firstName']}"); ?> <?php if ($row_rsDetails['abstractAuthors.middleName'] == '') { ?>
	<?php } else{ ?> <?php echo utf8_encode("{$row_rsDetails['abstractAuthors.middleName']}"); ?> <?php } ?> <?php echo utf8_encode("{$row_rsDetails['abstractAuthors.lastName']}"); ?><?php if ($row_rsDetails['abstractAuthors.title'] == '') { ?>	<?php } else{ ?>, <?php echo $row_rsDetails['abstractAuthors.title']; ?> <?php } ?></p>
		
  <strong>Number of Reviewers: <?php echo $row_rsDetails['Num_of_Score']; ?></strong><br />
  <strong>Total Score: <?php echo $row_rsDetails['Total_Score']; ?></strong><br />
  <strong>Mean Score: <?php echo $row_rsDetails['Avg_Score']; ?></strong><br />
  <strong>Standard Deviation: <?php echo $row_rsDetails['StDev_Score']; ?></strong>  
   </p>
   
   <?php if ($row_rsDetails['Notes'] !== '') { ?><p><font color="red"><strong>NOTES: <?php echo $row_rsDetails['Notes']; ?></strong></font></p><?php } ?>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
    <tr>
      <td><strong>Reviewer</strong></td>
   	  <td><strong>Score</strong></td>
      <td><strong>Recommendation</strong></td>
      <td><strong>Overall Comment</strong></td>
  </tr>
  
    <tr>
      <td><?php echo utf8_encode("{$row_rsDetails['Reviewer_1']}"); ?></td>
		<?php if ($row_rsDetails['Score_1'] == '-2') { ?>
		<td>DUPLICATE ABSTRACT</td>
		<?php } elseif ($row_rsDetails['Score_1'] == '-1') { ?>
		<td>RECUSE FROM REVIEW</td>		
		<?php } elseif ($row_rsDetails['Score_1'] == '') { ?>
		<td><?php echo strtoupper($row_rsDetails['Reviewer_1']); ?> DID NOT REVIEW THIS ABSTRACT</td>	
		<?php } else{ ?>
		<td><?php echo $row_rsDetails['Score_1']; ?></td>
		<?php } ?>
      <td><?php echo $row_rsDetails['Recommend_1']; ?></td>
      <td><?php echo $row_rsDetails['Comment_1']; ?></td>
    </tr>
    <tr>
      <td><?php echo utf8_encode("{$row_rsDetails['Reviewer_2']}"); ?></td>
		<?php if ($row_rsDetails['Score_2'] == '-2') { ?>
		<td>DUPLICATE ABSTRACT</td>
		<?php } elseif ($row_rsDetails['Score_2'] == '-1') { ?>
		<td>RECUSE FROM REVIEW</td>		
		<?php } elseif ($row_rsDetails['Score_2'] == '') { ?>
		<td><?php echo strtoupper($row_rsDetails['Reviewer_2']); ?> DID NOT REVIEW THIS ABSTRACT</td>	
		<?php } else{ ?>
		<td><?php echo $row_rsDetails['Score_2']; ?></td>
		<?php } ?>
      <td><?php echo $row_rsDetails['Recommend_2']; ?></td>
      <td><?php echo $row_rsDetails['Comment_2']; ?></td>
    </tr>
    <tr>
      <td><?php echo utf8_encode("{$row_rsDetails['Reviewer_3']}"); ?></td>
		<?php if ($row_rsDetails['Score_3'] == '-2') { ?>
		<td>DUPLICATE ABSTRACT</td>
		<?php } elseif ($row_rsDetails['Score_3'] == '-1') { ?>
		<td>RECUSE FROM REVIEW</td>		
		<?php } elseif ($row_rsDetails['Score_3'] == '') { ?>
		<td><?php echo strtoupper($row_rsDetails['Reviewer_3']); ?> DID NOT REVIEW THIS ABSTRACT</td>	
		<?php } else{ ?>
		<td><?php echo $row_rsDetails['Score_3']; ?></td>
		<?php } ?>
      <td><?php echo $row_rsDetails['Recommend_3']; ?></td>
      <td><?php echo $row_rsDetails['Comment_3']; ?></td>
    </tr>
    <tr>
      <td><?php echo utf8_encode("{$row_rsDetails['Reviewer_4']}"); ?></td>
		<?php if ($row_rsDetails['Score_4'] == '-2') { ?>
		<td>DUPLICATE ABSTRACT</td>
		<?php } elseif ($row_rsDetails['Score_4'] == '-1') { ?>
		<td>RECUSE FROM REVIEW</td>		
		<?php } elseif ($row_rsDetails['Score_4'] == '') { ?>
		<td><?php echo strtoupper($row_rsDetails['Reviewer_4']); ?> DID NOT REVIEW THIS ABSTRACT</td>	
		<?php } else{ ?>
		<td><?php echo $row_rsDetails['Score_4']; ?></td>
		<?php } ?>
      <td><?php echo $row_rsDetails['Recommend_4']; ?></td>
      <td><?php echo $row_rsDetails['Comment_4']; ?></td>
    </tr>	
</table>
<?php echo utf8_encode("{$row_rsDetails['body']}"); ?>
<div style="page-break-after:always"></div>
  <?php } ?>
</body>
</html>
<?php
 mysqli_free_result($rsDetails);
 mysqli_close($connIPEGmaster);
?>

<?php

$rsDetails = mysqli_query($connIPEGmaster, $query_rsDetails) OR die(mysqli_error($connIPEGmaster));


?>