<?php 

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$hostname_connASC = "mysql.aasurg.org";
$database_connASC = "ascabstracts";
$username_connASC = "aasmaster";
$password_connASC = "M0nty_pyth0ns_fly1ng_circuS";
$connASC = mysqli_connect($hostname_connASC, $username_connASC, $password_connASC, $database_connASC);

//mysqli_select_db($database_connASC, $connASC);
$query_rsDetails = "SELECT program_sessions.session_code, program_sessions.session_type, program_sessions.SESSION_FOR_EMAIL, program_sessions.session_option_number, program_sessions.conference_room_name, program_sessions.Date_for_Email, program_sessions.Time_for_Email FROM program_sessions WHERE program_sessions.session_code Not Like 96 ORDER BY program_sessions.session_code;";
$rsDetails = mysqli_query($connASC, $query_rsDetails) or die();
$totalRows_rsDetails = mysqli_num_rows($rsDetails);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASC Print/Save Abstracts by Session</title>
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 9.5pt;
}
-->
</style>
</head>

<body>
<h3>Welcome, ASC Moderator</h3>

<p>Please locate your session below and click the link to see the abstracts.  Then simply print the page, convert it to PDF, or bookmark it to get your abstracts.</p>

<table cellpadding="5" cellspacing="0">
  <tr>
    <td>Session Type and Title</td>
    <td>Session Day and Time</td>
  </tr>
<?php while ($row_rsDetails = mysqli_fetch_array($rsDetails)) { ?>  
<tr>
  <td><?php echo $row_rsDetails['session_code']; ?> - <a href="printabslist2.php?session=<?php echo $row_rsDetails['session_code']; ?>"><?php echo $row_rsDetails['session_type']; ?>: <?php echo $row_rsDetails['SESSION_FOR_EMAIL']; ?></a></td>
  <td><?php echo $row_rsDetails['Date_for_Email']; ?>  |  <?php echo $row_rsDetails['Time_for_Email']; ?></td>
</tr> 
<?php } ?>
</body>
</html>
<?php
 mysqli_free_result($rsDetails);
 mysqli_close($connASC);
?>
