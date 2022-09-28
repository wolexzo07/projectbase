	function checksch(str){
		var ss = document.getElementById("read_dept");
		var sinp = document.getElementById("dpt");
		var rcode = document.getElementById("read_code");
		var rcodee = document.getElementById("read_codee");
		
		if((str == "others") || (str == "Computer Science")){
			
			if(str == "others"){
				
				ss.style.display="block";
				sinp.required="required";
				$("#rcodee").removeAttr("required");
				rcode.style.display="none";
				
			}else if(str == "Computer Science"){
				
				rcode.style.display="block";
				rcodee.required="required";
				$("#dpt").removeAttr("required");
				ss.style.display="none";
				
			}else{}
			
			}else{
				
				$("#dpt").removeAttr("required");
				ss.style.display="none";
				$("#rcodee").removeAttr("required");
				rcode.style.display="none";
				
			}
		}
		
		document.getElementById("dept").value='';
		document.getElementById("cat").value='';
		document.getElementById("dpt").value='';
		document.getElementById("upme").value='';
		document.getElementById("upmee").value='';
		document.getElementById("upmey").value='';
		document.getElementById("pin").value='';
		document.getElementById("pdes").value='';
		document.getElementById("amt").value='';
		document.getElementById("ptitl").value='';
