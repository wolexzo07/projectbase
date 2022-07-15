<?php 
include("validatebase.php");
?>
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tourbase">
<h3 class="yii"><font style="color:green"><i class="glyphicon glyphicon-bell"></i> Notification</font></h3>
<div class="panel panel-default">
<div class="panel-heading"><i class="glyphicon glyphicon-bell"></i> Notifications 
        <i class='badge pull-right'><?php 
        $userme = x_clean($_SESSION["PBNG_EMAIL_2018_VISION"]);
        $cut = x_count("notifyme","type='all' OR type='p' AND email='$userme' LIMIT 1");
        echo $cut;
        
        ?></i>
</div>

<div class="panel-body">
	<script type="text/javascript" src="fetch.js"></script>
	<div id="showitnow"></div>
	 <div class="panel-group" id="accordion">
<?php

$counter = 0;
if(x_count("notifyme","type='all' OR type='p' AND email='$userme' LIMIT 1") > 0){
	$cut = x_count("notifyme","type='all' OR type='p' AND email='$userme' LIMIT 1");
	foreach(x_select("id,title,message,rtime","notifyme","type='all' OR type='p' AND email='$userme'","50","id desc") as $key){
		$counter++;
		$id = $key["id"];
		$title = $key["title"];
		$msg = $key["message"];
		$rtime = $key["rtime"];
		?>
		    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 onclick="msgupdate(<?php echo $id;?>)" style="padding:10px;" class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $counter;?>">
        <i class="fa fa-edit"></i> &nbsp;&nbsp;<?php echo xup($title,"");?>
        </a>
      </h4>
    </div>
    <div id="collapse<?php echo $counter;?>" class="panel-collapse collapse">
      <div class="panel-body">
	  <?php echo $msg;?>
	  </div>
    </div>
  </div>
		<?php
		}
	
	}else{
		echo "<p class='text-center'><font class=''><i style='font-size:100pt;' class='fa fa-bell'></i></font><br/><br/>No data found!</p>";
		
		}

?>
</div>
	<style>
	#abilp a:active{
		background-color:transparent;
		text-decoration:none;
		color:black;
		padding:10px;
	}
	#abilp a:hover{
			background-color:transparent;
		text-decoration:none;
		color:black;padding:10px;
	}
		#abilp a:visited{
			background-color:transparent;
		text-decoration:none;
		color:black;padding:10px;
	}
	#abilp a{
			background-color:transparent;
		text-decoration:none;
		color:black;padding:10px;
	}
	</style>
</div>

</div>

</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
</div>
