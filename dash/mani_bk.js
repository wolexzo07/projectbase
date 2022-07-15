$(document).ready(function(){
$("#btnupload").click(function(){
$("#upload_data").show("slow");	
$("#project_ready").hide("slow");	
});
});
			
			function checksch(str){
		var ss = document.getElementById("read_dept");
		var sinp = document.getElementById("dpt");
		var rcode = document.getElementById("read_code");
		var rcodee = document.getElementById("read_codee");
		
		if(str == "others"){
			
			$("#rcodee").removeAttr("required");
			rcode.style.display="none";
			ss.style.display="block";
			sinp.required="required";
			
			
			}else if(str == "Computer Science"){
				
			$("#dpt").removeAttr("required");
			ss.style.display="none";
			rcode.style.display="block";
			rcodee.required="required";
			
				}else{
				$("#dpt").removeAttr("required");
				ss.style.display="none";
				$("#rcodee").removeAttr("required");
				rcode.style.display="none";
				
				}
		
		}
		
		function radi(str){
		var rcode = document.getElementById("read_code");
		var rcodee = document.getElementById("read_codee");
			if(str == "yes"){
			rcode.style.display="block";
			rcodee.required="required";
			}else{	
			$("#read_codee").removeAttr("required");
			rcode.style.display="none";
			}
			
		}
		
	function validatesize(file){
	var file_size = file.files[0].size / 1024;
	if(file_size > 200){
		
		alert("File size exceeds 200kb!");
		
	}else{
		
	}
	
}
	function vals(file,rsize,msg){
	var file_size = file.files[0].size / 1024 /1024;
	if(file_size > rsize){
		
		alert(""+msg+"");
		
	}else{
		
	}
	
}
