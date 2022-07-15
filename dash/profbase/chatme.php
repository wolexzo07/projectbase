<?php 

include("validatebase.php");
?>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 chatpartone">
<h3 class="yii"><button class="btn btn-primary" onclick="<?php
if($_SESSION["PBNG_POSITION_2018_VISION"] == "student"){
	?>load('../dash/chatme')<?php
	}else{
		?>load('profbase/chate')<?php
		}
?>"><i class="fa fa-arrow-left"></i> </button> <!---<i class="fa fa-comment"></i>-->Chat <font style="color:green">Window</font> </h3>
<button class="btn btn-success dn"><i class="glyphicon glyphicon-fullscreen"></i></button>
<script>
$(document).ready(function(){
	$(".dn").click(function(){
		
			$(".por").fadeToggle("slow");
			$(".yii").fadeToggle("slow");
			$(".chatpartone").hide("slow");
			$(".chatparttwo").attr("class","col-lg-12 col-md-12 col-sm-12 col-xs-12 chatparttwo");
			$(".dn").hide("slow");
		});

	});
</script>
<table class="table por">
	<?php 
if(isset($_GET["tid"]) && !empty($_GET["tid"]) && isset($_GET["key"]) && !empty($_GET["key"])){
$ido = xg('tid');
$keyo = xg('key');

$usermi = $_SESSION["PBNG_EMAIL_2018_VISION"];
	if(x_count("projects","id='$ido' AND token='$keyo' LIMIT 1") > 0 ){
	foreach(x_select("amount_to_pay,amount_currency,ptitle,owner,approved_to","projects","id='$ido' AND token='$keyo'","1","id") as $key){
			$pti = $key["ptitle"];
			$owner = $key["owner"];
			$apto = $key["approved_to"];
			$amtp = $key["amount_to_pay"];
			$amtc = $key["amount_currency"];
			if(x_count("userdb","email='$owner' LIMIT 1") > 0){
			foreach(x_select("mobile,name,user_photo","userdb","email='$owner'","1","id") as $key){
					$oname = $key["name"];
					$pho = $key["user_photo"];
					$mo = $key["mobile"];
					
			}
				if(x_count("userdb","email='$apto' LIMIT 1") > 0){
				foreach(x_select("mobile,name,user_photo","userdb","email='$apto'","1","id") as $key){
					$bname = $key["name"];
					$bpho = $key["user_photo"];
					$bmo = $key["mobile"];
					
			}
				?>
				<tr>
				<th><img src="../<?php echo $pho;?>" class="img-circle chav"/>
			
				</th>
				<td>
					<font style="color:green"><i class="fa fa-comment"></i><<<>>><i class="fa fa-comment"></i>&nbsp;&nbsp;&nbsp;</font>
				<img src="../<?php echo $bpho;?>" class="img-circle chav"/>
				
				</td>
				</tr>
				<tr>
				<th>Stud.</th>
				<td><?php 
				echo x_vert($oname,"b")."<br/>";
				echo x_vert($owner,"")."<br/>";
				echo x_vert($mo,"b")."";
				
				?></td>
				</tr>
				<tr>
				<th>Prof.</th>
				<td><?php 
				echo x_vert($bname,"b")."<br/>";
				echo x_vert($apto,"")."<br/>";
				echo x_vert($bmo,"b")."";
				?></td>
				</tr>
					

				<tr>
				<th>Job.</th><td><?php echo x_vert($pti,"");?></td>
				</tr>
				
				<tr>
				<th>Budget</th><td><?php echo $amtc." ".number_format($amtp,2);?></td>
				</tr>
				<tr>
				<th></th><td><button class="btn btn-lg btn-primary" onclick="load('profbase/load_chat?id=<?php echo $ido;?>&token=<?php echo $keyo;?>')"><i class="fa fa-comment"></i> Check Chatlogs</button></td>
				</tr>
				
				<?php
				
				}else{
	echo "Invalid Professional!";
	exit();
					}
				}else{
					
	echo "Invalid Project Owner!";
	exit();
					}
			}
		}else{
	echo "Invalid Project detected!";
	exit();
			}
}else{
	echo "Modified parameter!";
	exit();
	}
	
	
	?>

</table>
	
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 chatparttwo">
<?php
if(isset($_GET["tid"]) && !empty($_GET["tid"]) && isset($_GET["key"]) && !empty($_GET["key"])){
$ido = x_clean($_GET['tid']);
$keyo = x_clean($_GET['key']);
?>
<script src="../log.js"></script>
<!---<script>
$(".chatme").ready(function(){
	setInterval(function(){cloe()}, 1000);
	});
</script>---->

<div class="chatme" style="">
<?php 
include("showchat.php");

?>
</div>	

<form id="chatme" class="pil" method="POST">
<!---<p class="banp">Write Message*</p>--->
<textarea name="message"  maxlength="1000" required="required" id="pdes" class="form-control pdes" style="margin-bottom:10pt;"  placeholder="Enter Message"></textarea>
<input type="hidden" name="name" value="<?php echo 	$_SESSION["PBNG_NAME_2018_VISION"];?>"/>
<input type="hidden" name="email" value="<?php echo $_SESSION["PBNG_EMAIL_2018_VISION"];?>"/>

<input type="hidden" name="tid" value="<?php echo $_GET["tid"];?>"/>
<input type="hidden" name="token" value="<?php echo $_GET["key"];?>"/>

<input type="hidden" name="chatme" value="<?php echo sha1(rand());?>"/>
						       
<input type="submit"  value="Send" class="btn btn-success uip" id="bup" />
</form>
<div id="gallery"><img src="../image/load.gif"/></div>
<script type="text/javascript">
$(document).keydown(function(e){
var key = e.charCode || e.keyCode;
if(key == 13){
$(".uip").click();
document.getElementById("pdes").value='';
}
});
</script>
	<?php
	}else{
		
		?>
		<p style="30pt">Missing Parameter!</p>
		<?php
		}

?>

</div>
<!--<div class="col-lg-1 col-md-1 col-sm-12 col-xs-12"></div>--->
</div>
