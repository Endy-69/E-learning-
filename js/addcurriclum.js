$(function(){

$("#dep_error_message").hide();
$("#Course_error_message").hide();
$("#Code_error_message").hide();
$("#crdite_error_message").hide();
$("#requst_error_message").hide();
$("#semis_error_message").hide();
$("#yea_error_message").hide();
var error_dep=false;
var error_Course=false;
var error_code=false;
var error_crdite=false;
var error_Pre=false;
var error_semi=false;
var error_year=false;
$("#department").focusout(function(){
check_department();
});
$("#course_name").focusout(function(){
check_course_name();
});
$("#course_code").focusout(function(){
 check_course_code();
 });
$("#crdite_houre").focusout(function(){
 check_crdite_houre();
 });
$("#Pre_requst").focusout(function(){
 check_Pre_requst();
 });
$("#semister").focusout(function(){
 check_semister();
 });

$("#year").focusout(function(){
 check_year();
 });	  
function check_department(){
        var role=$("#department").val();
		if(role=="select Department")
		{
			error_dep=true;
			$("#dep_error_message").html("Select department");
			$("#dep_error_message").show();
			$("#department").css("border-bottom","1px solid red");
			$("#dep_error_message").css("color","red");
		}
		else{
			error_dep=false;
        $("#department").css("border-bottom","2px solid green");
        $("#dep_error_message").hide();
            }
		}
	
function check_course_name()
	{
		var cname=$("#course_name").val();
		var len=$("#course_name").val().length;
		var pattern = /^[A-Za-z ]*$/;
		if(cname== "")
		{
		course_name==true;
		$("#Course_error_message").html("Enter Course name");
		$("#Course_error_message").show(); 
		$("#course_name").css("border-bottom","1px solid red");	
		$("#Course_error_message").css("color","red");
		}
		else if(len < 2 || len > 50)
		{
		 course_name=true;
			$("#Course_error_message").html("Enter betwwen 2-50 Letter");
			$("#Course_error_message").show();
			$("#course_name").css("border-bottom","2px solid red");
			$("#Course_error_message").css("color","red");
		}
		else if(pattern.test(cname) == "")
	    {  
             course_name=true;
			$("#Course_error_message").html("Enter valid Letter only and First Letter should be Capital Letter");
			$("#Course_error_message").show();
			$("#course_name").css("border-bottom","2px solid red");
			$("#Course_error_message").css("color","red");
		}
		else
		{
		$("#course_name").css("border-bottom","2px solid green");
		$("#Course_error_message").hide(); 	
		}
	 }	
function check_course_code()
	{
		var una=$("#course_code").val();
		var len=$("#course_code").val().length;
		var pattern = /^(\w*(\d+[a-zA-Z]|[a-zA-Z]+\d)\w*)+$/;
		if(una=="")
		{
			error_code=true;
			$("#Code_error_message").html("Enter course_code");
			$("#Code_error_message").show();
			$("#course_code").css("border-bottom","1px solid red");
			$("#Code_error_message").css("color","red");
		}
		 else if(len < 2 || len > 50)
		{
		  error_code=true;
			$("#Code_error_message").html("Enter betwwen 2-50 Letter");
			$("#Code_error_message").show();
			$("#course_code").css("border-bottom","2px solid red");
		}
		else 
		if(pattern.test(una) == "")
	{
	error_code=true;
			$("#Code_error_message").html("Enter both Letter and number only");
			$("#Code_error_message").show();
			$("#course_code").css("border-bottom","2px solid red");
	}
		else 
		{
		error_code=false;
			$("#course_code").css("border-bottom","1px solid green");
			$("#Code_error_message").hide();
		}
	}	  
 // For Credit Hour 
	function check_crdite_houre()
	{
		
	    var cred=$("#crdite_houre").val();
	    var len=$("#crdite_houre").val().length;
        var pattern = /^[0-9]*$/;
	    if(cred == "")
		{
	    error_crdite==true;
	    $("#crdite_error_message").html("Enter crdite houre");
	    $("#crdite_error_message").show();
	    $("#crdite_houre").css("border-bottom","1px solid red");
	    $("#crdite_error_message").css("color","red");
		}
	    else
	    if(pattern.test(cred) == "")
	{
	    error_crdite==true;
		$("#crdite_error_message").html("Crdite houre should be only number");
		$("#crdite_error_message").show();
		$("#crdite_houre").css("border-bottom","1px solid red");
		$("#crdite_error_message").css("color","red");
	}
	else
	   if(cred < 1 || cred >10)
	   {
		   error_crdite= true;
	   $("#crdite_error_message").html("Crdite houre should be between 1 and 10");
	   $("#crdite_error_message").show();
	   $("#crdite_houre").css("border-bottom","1px solid red");
	   }
		else
		{
		$("#crdite_houre").css("border-bottom","1px solid green");
		$("#crdite_error_message").hide();
		}
	}
	// For Pre Request 
	function check_Pre_requst()
	{
		var pre=$("#Pre_requst").val();
		var len=$("#Pre_requst").val().length;
		var pattern =/^[A-Za-z ]*$/;;
		if(pre== "")
		{
		Pre_requst==true;
		$("#requst_error_message").html("Enter pre requst");
		$("#requst_error_message").show(); 
		$("#Pre_requst").css("border-bottom","1px solid red");	
		$("#requst_error_message").css("color","red");
		}
		else if(len < 2 || len > 30)
		{
		 Pre_requst=true;
			$("#requst_error_message").html("Enter betwwen 2-50 ");
			$("#requst_error_message").show();
			$("#Pre_requst").css("border-bottom","2px solid red");
			$("#requst_error_message").css("color","red");
		}
		else if(pattern.test(pre) == "")
	    {  
             Pre_requst=true;
			$("#requst_error_message").html("Enter valid prerequst name ");
			$("#requst_error_message").show();
			$("#Pre_requst").css("border-bottom","2px solid red");
			$("#requst_error_message").css("color","red");
		}
		else
		{
		$("#Pre_requst").css("border-bottom","2px solid green");
		$("#requst_error_message").hide(); 	
		}
	 }
// For semister
	 	function check_semister()
    {
      var semi=$("#semister").val();
      if( semi=="select semester")
      {
        error_semi=false;
        $("#semis_error_message").html("Select semister");
        $("#semis_error_message").show();
        $("#semister").css("border-bottom","1px solid red");
        $("#semister").css("width","170px");
        $("#semis_error_message").css("color","red");
      }
      else
      {
      error_semi = false;
        $("#semister").css("border-bottom","1px solid green");
        $("#semis_error_message").hide();
       }
       }
	   // For year
       function check_year()
       {
      var yea=$("#year").val();
      if( yea=="select year")
      {
        error_year=false;
        $("#yea_error_message").html("Select year");
        $("#yea_error_message").show();
        $("#year").css("border-bottom","1px solid red");
        $("#year").css("width","170px");
        $("#yea_error_message").css("color","red");
      }
      else
      {
      error_year = false;
        $("#year").css("border-bottom","1px solid green");
        $("#yea_error_message").hide();
       }
       }	 
$("#adform").submit(function(){
	    
		error_dep=false;
		error_Course=false;
        error_code=false;
        error_crdite=false;
        error_Pre=false;
        error_semi=false;
        error_year=false; 
		  check_department();
		  check_course_name();
		  check_course_code();
          check_crdite_houre();
		  check_Pre_requst();
		  check_semister();
		  check_year();
if(error_dep===false && error_Course===false && error_code===false&& error_crdite===false&& error_Pre===false
&& error_semi===false&& error_year===false)
	   {
		   return true;
	   }
	   else{
		   return false;
	   }

	});
	});
		
	