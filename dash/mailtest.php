<?php

/***
 * #paranoia mental delusion in which one finds it difficult to trust other
 * #$name     =   "";
   #$mailsend =   sendmail($to,$subject,$message,$name);

 * */
      include_once("../finishit.php");
      $to       =   "webmastertitus@gmail.com";
      $subject  =   "PBNG USER REGISTRATION";
      $message  =   "I am coming now pls helpme asap.</i>";
      $mailsend =   sendmail($to,$subject,$message);
      if($mailsend==0){
        
        echo '<h2>There are some issue.</h2>';
      }
      else{
        echo '<h2>email sent.</h2>';
      }
?>
