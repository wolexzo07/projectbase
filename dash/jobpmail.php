<?php
$subject = "PBNG JOBS PAYMENT -JOB PAYMENT OF $amc_b $amt_paid_b HAS BEEN RELEASED";

$message = "
<html>
<head>
<title>PBNG JOBS PAYMENT -JOB PAYMENT OF $amc_b $amt_paid_b HAS BEEN RELEASED</title>
</head>
<body>
<div style='margin:0%;border:1px solid purple;'>
<div style='height:30px;padding:1%;background-color:purple;color:white'>

</div>
<div style='background-color:white;padding:1%;'>
<center>
<h2 style='text-align:center;display:block;'><img src='https://projectbase.ng/image/logome.png' style='width:80px;padding:0px;'/> <br/><font style='color:green;'>projectbase</font>.ng</h2></center>
</div>
<div style='padding:1%;'>
<p>
Hi &nbsp;<b>$appname ($bidder)</b>,<br/><br/>
Congratulations! Your wallet has been credited with Job payment of $amc_b $amt_paid_b for the project titled $ptit that was completed successfully.Thank you.
<br/><br/>
<style type='text/css'>
.br{
background-color:purple;
padding:10px;
border-radius:7px;

}
.br:hover{
background-color:gold;
padding:10px;
}
a{
color:white;
text-decoration:none;
}
.mail{
text-decoration:none;
color:white;
font-size:13pt;
}

</style>
</p>
</div>
<div style='padding:1%;background-color:purple;color:white'>

<b>From C.E.O <i>PBNG</i> ( T.O Biobaku Oluwole)</b><br/>


<font style='color:;font-weight:bold;font;'>Contact our support on:</font><br/>
Email : hello@projectbase.ng<br/>
Phone : +234(0)9031144111<br/>
</div>
</div>
</body>
</html>
";

if(x_count("mailer","status='1' LIMIT 1") > 0){
	  $mailsend = sendmail($bidder,$subject,$message);
  if($mailsend==0){
	
	echo '<h2>There are some issue sending mail.</h2>';
  }
  else{
	#echo '<h2>email sent.</h2>';
  }		
	
	}else{
		
		
		}



						?>
