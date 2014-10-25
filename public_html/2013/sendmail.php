<?php
$headers = 'From: hackatl@hackatl.org' . "\r\n" .
    'Reply-To: hackatl@hackatl.org' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$check = mail('nihar.parikh@emory.edu', 'Test', 'This is sent from the server via php.', $headers);
if($check){ echo "Sucess";}
else{ echo "Failed";}
?>