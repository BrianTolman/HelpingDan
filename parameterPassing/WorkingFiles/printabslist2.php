<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$hostname_connASC = "mysql.aasurg.org";
$database_connASC = "ascabstracts";
$username_connASC = "aasmaster";
$password_connASC = "M0nty_pyth0ns_fly1ng_circuS";
$connASC = mysqli_connect($hostname_connASC, $username_connASC, $password_connASC, $database_connASC);
// 

$s = ($_GET['session']);

// Test if $s exists - if there is nothing, error out and die.
if (!$s) {
    echo 'Nothing selected';
    die();
}
/* test to make sure its numeric.  This solves much in this case, preventing 
 * anything but numbers from being entered.
 * 
 */
if (!is_numeric($s)) {
    echo "Not a valid selction";
    die();
}
$query_rsDetails = "SELECT abstracts_temp_export.control_number, abstracts_temp_export.session_number, abstracts_temp_export.session_topic, abstracts_temp_export.session_day, abstracts_temp_export.session_time, abstracts_temp_export.session_code, abstracts_temp_export.session_author, abstracts_temp_export.abstract_title, abstracts_temp_export.author_block, abstracts_temp_export.abstract_type, abstracts_temp_export.abstract_scientific_area, abstracts_temp_export.abstract_clinical_area, abstracts_temp_export.abstract_body, abstracts_temp_export.graphic_file_url, abstracts_temp_export.confirmation, program_sessions.session_type, program_sessions.SESSION_FOR_EMAIL, program_sessions.session_option_number, abstracts_temp_export.Notes, auths_temp_export.first_name, auths_temp_export.last_name, auths_temp_export.degrees
FROM (program_sessions INNER JOIN abstracts_temp_export ON program_sessions.session_code = abstracts_temp_export.session_code) LEFT JOIN auths_temp_export ON abstracts_temp_export.session_author = auths_temp_export.pkID
WHERE abstracts_temp_export.session_code = $s AND abstracts_temp_export.confirmation = 'accepted' ORDER BY abstracts_temp_export.session_number";
$rsDetails = mysqli_query($connASC, $query_rsDetails) or die();
$totalRows_rsDetails = mysqli_num_rows($rsDetails);

// Test for empty results - this prevents the white page. Basically, this is an error test
if ($totalRows_rsDetails < 1) {
    echo "No Results.  The number you selected to not link to a document.";
}

// Now I would encase this to make sure that it is greater than 0, this prevents
// some idiot from entering -1

if ($totalRows_rsDetails > 0) {
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>2018 Session<?php echo $row_rsDetails['session_code']; ?>Abstracts</title>
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

            <?php while ($row_rsDetails = mysqli_fetch_array($rsDetails)) { ?>  
                <h3><strong><?php echo $row_rsDetails['session_number']; ?> - <?php echo $row_rsDetails['control_number']; ?><?php if ($row_rsDetails['Notes'] == '') { ?>
                        <?php } else { ?>
                            <font color=red>(<?php echo $row_rsDetails['Notes']; ?>)</font>
                        <?php } ?></strong></h3>
                <h4><strong><?php echo utf8_encode("{$row_rsDetails['abstract_title']}"); ?></strong><br />
                    <?php echo utf8_encode("{$row_rsDetails['author_block']}"); ?></h4>
                <h4><strong>Presenter: </strong><?php echo utf8_encode("{$reply['first_name']} {$reply['last_name']}"); ?><?php if ($row_rsDetails['degrees'] == '') { ?><?php } else { ?>, <?php echo $row_rsDetails['degrees']; ?><?php } ?></h4>

                <?php echo utf8_encode("{$row_rsDetails['abstract_body']}"); ?>
                <?php if (!is_null($row_rsDetails['graphic_file_url']) AND $row_rsDetails['graphic_file_url'] != "") { ?>
                    <p>&nbsp;</p>
                    <p><img src="<?php echo $row_rsDetails['graphic_file_url'] ?>" style="max-width:600px" /></p>
                <?php
                }
            }
            ?>

        </body>
    </html>
    <?php
}
// always free up the resources.
mysqli_free_result($rsDetails);
mysqli_close($connASC);
?>
