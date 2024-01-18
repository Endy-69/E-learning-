$(function(){
$("#course_error_message").hide();
$("#name_error_message").hide();
$("#crdite_error_message").hide();
$("#pre_error_message").hide();

var error_course=false;
var error_name=false;
var error_crdite=false;
var error_pre=false;

$("#course_code").focusout(function(){
check_course();
});
$("#course_name").focusout(function(){
check_name();
});

$("#crdite_houre").focusout(function(){
check_crdite();
});
$("#pre_requst").focusout(function(){
check_pre();
});

function check_course()
	{
		var coid=$("#course_code").val();
		var pattern =/^[a-Az-Z0-9]$/;
		if(coid=="")
		{
			error_course =true;
			$("#course_error_message").html("Enter course name");
			$("#course_error_message").show();
			$("#course_code").css("border-bottom","1px solid red");
			$("#course_error_message").css("color"," red");
		}
else if(pattern.test(coid)==""){
   $("#course_error_message").html("Enter both Letter and number ");
   $("#course_error_message").show();
   $("#course_code").css("border-bottom","1px solid red");
   error_course=true;
   }
else
   {
	   error_course=false;
   $("#course_code").css("border-bottom","1px solid green");
   $("#course_error_message").hide();
	 }
	}
	function check_name()
	{
		var cname=$("#course_name").val();
		var len=$("#course_name").val().length;
		var pattern = /^[A-Z][a-z]*$/;
		if(cname== "")
		{
		course_name==true;
		$("#name_error_message").html("Enter Course Name");
		$("#name_error_message").show(); 
		$("#course_name").css("border-bottom","1px solid red");	
		$("#name_error_message").css("color","red");
		}
		else if(len < 3 || len > 30)
		{
		 course_name=true;
			$("#name_error_message").html("Enter  betwwen 3-30 For Course Name");
			$("#name_error_message").show();
			$("#course_name").css("border-bottom","2px solid red");
			$("#name_error_message").css("color","red");
		}
		else if(pattern.test(cname) == "")
	    {  
             course_name=true;
			$("#name_error_message").html("Enter valid Course name and First Letter should be Capital");
			$("#name_error_message").show();
			$("#course_name").css("border-bottom","2px solid red");
			$("#name_error_message").css("color","red");
		}
		else
		{
		$("#course_name").css("border-bottom","2px solid green");
		$("#name_error_message").hide(); 	
		}
	 }	
	
	function check_crdite()
  {
    var cred=$("#crdite_houre").val();
    var len=$("#crdite_houre").val().length;
    var pattern = /^[1-9]*$/;
    if(cred=="")
    {
  error_crdite = true;
      $("#crdite_error_message").html("please fill form");
      $("#crdite_error_message").show();
      $("#crdite_houre").css("border-bottom","1px solid red");
      $("#crdite_error_message").css("color","red");
    }
    else
    if(pattern.test(cred) == "")
  {
  error_crdite = true;
      $("#crdite_error_message").html("enter only digit between 1-9");
      $("#crdite_error_message").show();
      $("#crdite_houre").css("border-bottom","2px solid red");
      $("#crdite_error_message").css("color","red");
  }
      else
     if(len < 1 || len > 0)
     {
  error_crdite = true;
     $("#crdite_error_message").html("Enter valid between 1-10");
     $("#crdite_error_message").show();
     $("#crdite_houre").css("border-bottom","2px solid red");
      $("#crdite_error_message").css("color","red");
     }
else if(ag < 1 || len > 10)
     {
  error_crdite = true;
     $("#crdite_error_message").html("Enter crdite_houre between 1-10");
     $("#crdite_error_message").show();
     $("#crdite_houre").css("border-bottom","2px solid red");
      $("#crdite_error_message").css("color","red");
     }
    else
    {
      $("#crdite_houre").css("border-bottom","1px solid green");
      $("#crdite_error_message").hide();
    }
  }
	
	function check_pre()
	{
		var pre=$("#pre_requst").val()1
		var len=$("#pre_requst").val().length;
		var pattern = /^[A-Z][a-z]*$/;
		if(pre== "")
		{
		pre_requst==true;
		$("#pre_error_message").html("please fill this field");
		$("#pre_error_message").show(); 
		$("#pre_requst").css("border-bottom","1px solid red");	
		$("#pre_error_message").css("color","red");
		}
		else if(len < 3 || len > 30)
		{
		 pre_requst=true;
			$("#pre_error_message").html("Enter betwwen 3-30 character");
			$("#pre_error_message").show();
			$("#pre_requst").css("border-bottom","2px solid red");
			$("#pre_error_message").css("color","red");
		}
		else if(pattern.test(pre) == "")
	    {  
             pre_requst=true;
			$("#pre_error_message").html("Enter valid character only and First Letter should be Capital Letter");
			$("#pre_error_message").show();
			$("#pre_requst").css("border-bottom","2px solid red");
			$("#pre_error_message").css("color","red");
		}
		else
		{
		$("#pre_requst").css("border-bottom","2px solid green");
		$("#pre_error_message").hide(); 	
		}
	 }	
	
$("#rcform").submit(function(){
	    error_course=false;
		error_name=false;
        error_crdite=false;
        error_pre=false;

          check_cors();
		  check_name();
          check_crdite();
          check_pre();
if(error_course===false && error_name===false&&error_crdite===false&&error_pre===false)
	   {
		   return true;
	   }
	   else{
		   return false;
	   }

	});
	});
		
	