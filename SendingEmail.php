<?php
//mail('jazebakram@gmail.com','Testing','this is just a test to check localhost email ','From: jazebakram@gmail.com');
$emailTo="jazebakram@gmail.com";
 $subject="testing";
 $body="lets check its working or not using better variable way";
 $headers="From:jazebakram@gmail.com";
     if (mail($emailTo, $subject, $body, $headers)) {
                echo "Mail sent successfully!";
                    } else {
                                echo "Mail not sent!";
                    }
?>