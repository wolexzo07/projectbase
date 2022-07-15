<?php 
include("validatebase.php");
?>

	<?php
	if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['token']) && !empty($_GET['token'])){
		$id = xg("id");
		$token = xg("token");
		?>
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
<table class="table">
	<?php 

$usermi = $_SESSION["PBNG_EMAIL_2018_VISION"];
	if(x_count("projects","id='$id' AND token='$token' LIMIT 1") > 0 ){
	foreach(x_select("amount_to_pay,amount_currency,ptitle,owner,approved_to","projects","id='$id' AND token='$token'","1","id") as $key){
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
	
	
	?>

</table>
</div>
<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="background-color:white;">
	<h3 class="yii">
	<button onclick="load('profbase/chatme?tid=<?php echo $id;?>&key=<?php echo $token;?>&po=<?php echo $owner;?>&pt=<?php echo $pti;?>')" class="btn btn-success"><i class="fa fa-comment"></i></button> <font style='color:green;'> Chat</font>Logs</h3>
		<script type="text/javascript">
$(document).ready(function(){
changePagination('0');    
});
function changePagination(pageId){
     $(".flash").show();
     $(".flash").fadeIn(400).html
                ('Loading <img src="../image/load.gif" />');
     var dataString = 'pageId='+ pageId;
     $.ajax({
           type: "POST",
           url: "profbase/chatlogs?call=<?php if(isset($_GET['call']) && !empty($_GET['call'])){echo $_GET['call'];}else{} ?>&id=<?php echo $id;?>&token=<?php echo $token;?>&sm=<?php echo md5(rand(123,8929203867));?>",
           data: dataString,
           cache: false,
           success: function(result){
           $(".flash").hide();
                 $("#pageData").html(result);
           }
      });
}
</script>

<div id="pageData"></div>
<span class="flash"></span>
</div>
<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"></div>
</div>

		<?php
		}else{	
		echo "Modified Parameters!";
		exit();
			}
	
	?>
