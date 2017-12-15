<?php

$abstract = file_get_contents('./wp-content/themes/optimal/page-abstractreply/templates/abstract.php') or die('Unable to open file');
echo $abstract;

$user_wpID = userCheck();
$author_wpID = identifyProfile();
$page_id = getProfilePageID();

echo "The User is: $user_wpID. <br> The page is $page_id <br>The Author is : $author_wpID"; 

$reply = array(
    'abstractTitle'  => 'someTitle',
    'fullauthorlist' => 'fullauthorlist',
    'institutions' => 'institutions',
    'body'=>'some body'
);
function abstract_paragraph($reply) {
    echo "<hr><br/><p align='center'><b><u>ABSTRACTecho</u></b></p><p><strong>".$reply['abstractTitle']."</strong><br/>";
    echo $reply['fullauthorlist']. " ". $reply['institutions']."<br/>" . $reply['body']."<br/>";
}

print_r($reply);
echo abstract_paragraph($reply);




$user_wpID = userCheck();
$author_wpID = identifyProfile();
$page_id = getProfilePageID();

echo "The User is: $user_wpID. <br> The page is $page_id <br>The Author is : $author_wpID"; 
