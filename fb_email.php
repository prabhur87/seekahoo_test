<?php
$name = "Seekahoo - Support";
$email = "support@seekahoo.com";

$from="From: $name:<$email>\r\nReturn-path: $email";
$subject="Message from $name";
mail("prabhur.xvalue@gmail.com", $subject, $message, $from);

?>