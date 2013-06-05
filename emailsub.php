<?php
$email = $_POST['email'];
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // use filter_var function to verify we are dealing with an email address.
    echo "Failed";
    exit; // kill if the email is not valid. This is the second check, the first happens in the javascript.
} else {
	$emailtofile = $email."\n";
}
$filename = 'emailsubscribers.txt';
if (is_writable($filename)) { // file is writable and exists?
    if (!$handle = fopen($filename, 'a')) { // file is loaded in append mode
         echo "Failed";
         exit;
    }
    if (fwrite($handle, $emailtofile) === FALSE) { // successfully written?
        echo "Failed";
        exit;
    }
    echo "Success"; // echo success... which doesn't actually do anything.
    fclose($handle); // close the file
} else {
    echo "Failed";
}


?>