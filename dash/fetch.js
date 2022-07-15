function powner(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="<p class='banp'>Project Owner*</p><select name='owner' required='required' class='form-control slec'><option value=''>No project owner</option></select>";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","projow?q="+str,true);
xmlhttp.send();
}

function showp(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="<p class='banp'>Amount Budgeted*</p><select name='amount' required='required' class='form-control slec'><option value=''>No project amount</option></select>";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","listed.php?q="+str,true);
xmlhttp.send();
}


function usercheck(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").style.display="block";
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","fpine/getuser?q="+str,true);
xmlhttp.send();
}



function msgupdate(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").style.display="block";
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","msgupdate?q="+str,true);
xmlhttp.send();
}


function getonlineuser(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("showitnow").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("showitnow").style.display="block";
    document.getElementById("showitnow").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","dtimes?q="+str,true);
xmlhttp.send();
}
