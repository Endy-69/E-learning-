$(function(){
$("#fname_error_message").hide();
$("#lname_error_message").hide();
$("#user_id_error_message").hide();
$("#phone_no_error_message").hide();
$("#username_error_message").hide();
$("#password_error_message").hide();
$("#accounttype_error_message").hide();

var error_fname=false;
var error_lname=false;
var error_user_id=false;
var error_phone=false;
var error_username=false;
var error_password=false;
var error_accounttype=false;

$("#fname").focusout(function(){
check_fname();
});
$("#lname").focusout(function(){
check_lname();
});
$("#user_id").focusout(function(){
check_user_id();
});
$("#phone_no").focusout(function(){
check_phone();
});
$("#username").focusout(function(){
check_username();
});
$("#password").focusout(function(){
check_password();
});
$("#accounttype").focusout(function(){
check_account();
});
// For First name
function check_fname()
	{
		var fi=$("#fname").val();
		var len=$("#fname").val().length;
		var pattern = /^[A-Z][a-z]*$/;
		if(fi== "")
		{
		fname==true;
		$("#fname_error_message").html("Fill first name");
		$("#fname_error_message").show(); 
		$("#fname").css("border-bottom","1px solid red");	
		$("#fname_error_message").css("color","red");
		}
		else if(len < 3 || len > 30)
		{
		 fname=true;
			$("#fname_error_message").html("Enter between 2-30 character for first name");
			$("#fname_error_message").show();
			$("#fname").css("border-bottom","2px solid red");
			$("#fname_error_message").css("color","red");
		}
		else if(pattern.test(fi) == "")
	    {  
             fname=true;
			$("#fname_error_message").html("Enter valid name  and First Letter should be Capital");
			$("#fname_error_message").show();
			$("#fname").css("border-bottom","2px solid red");
			$("#fname_error_message").css("color","red");
		}
		else
		{
		$("#fname").css("border-bottom","2px solid green");
		$("#fname_error_message").hide(); 	
		}
	 }	
	 // For Last name
	 function check_lname()
	{
		var l=$("#lname").val();
		var len=$("#lname").val().length;
		var pattern = /^[A-Z][a-z]*$/;
		if(l== "")
		{
		lname==true;
		$("#lname_error_message").html("Fill last name");
		$("#lname_error_message").show(); 
		$("#lname").css("border-bottom","1px solid red");	
		$("#lname_error_message").css("color","red");
		}
		else if(len < 3|| len > 30)
		{
		 lname=true;
			$("#lname_error_message").html("Enter betwwen 2-30 character for last name");
			$("#lname_error_message").show();
			$("#lname").css("border-bottom","2px solid red");
			$("#lname_error_message").css("color","red");
		}
		else if(pattern.test(l) == "")
	    {  
             lastname=true;
			$("#lname_error_message").html("Enter valid last name and First Letter should be Capital ");
			$("#lname_error_message").show();
			$("#lname").css("border-bottom","2px solid red");
			$("#lname_error_message").css("color","red");
		}
		else
		{
		$("#lname").css("border-bottom","2px solid green");
		$("#lname_error_message").hide(); 	
		}
	 }	
 // For User Id
	function check_user_id()
	{
		var una=$("#user_id").val();
		var len=$("#user_id").val().length;
		var pattern = /^(\w*(\d+[a-zA-Z]|[a-zA-Z]+\d)\w*)+$/;
		if(una=="")
		{
			error_user_id=true;
			$("#user_id_error_message").html("Fill User Id");
			$("#user_id_error_message").show();
			$("#user_id").css("border-bottom","1px solid red");
			$("#user_id_error_message").css("color","red");
		}
		 /*else if(len < 3 || len > 30)
		{
		  error_user_id=true;
			$("#user_id_error_message").html("Enter betwwen 3-30 character");
			$("#user_id_error_message").show();
			$("#user_id").css("border-bottom","2px solid red");
		}
		else 
		if(pattern.test(una) == "")
	{
	error_user_id=true;
			$("#user_id_error_message").html("Enter both Letter and number only");
			$("#user_id_error_message").show();
			$("#user_id").css("border-bottom","2px solid red");
	}*/
		else 
		{
		error_user_id=false;
			$("#user_id").css("border-bottom","1px solid green");
			$("#user_id_error_message").hide();
		}
	}	  // For phone
	 function check_phone()
  	{
  		var phon=$("#phone_no").val();
  		var len=$("#phone_no").val().length;
          var pattern = /^[+]+[2]+[5]+[1][0-9]+$/;
  		if(phon=="")
  		{
  	error_phone = true;
  			$("#phone_no_error_message").html("Fill your phone Number");
  			$("#phone_no_error_message").show();
  			$("#phone_no").css("border-bottom","1px solid red");
  			$("#phone_no_error_message").css("color","red");
  		}
  		else
  		if(pattern.test(phon) == "")
  	{
  	error_phone = true;
  			$("#phone_no_error_message").html("phone should start with +251!!");
  			$("#phone_no_error_message").show();
  			$("#phone_no").css("border-bottom","2px solid red");
  			$("#phone_no_error_message").css("color","red");
  	}
  	
  		else
  		{
  			$("#phone").css("border-bottom","1px solid green");
  			$("#phone_no_error_message").hide();
  		}
  	}
	// For User Name
	function check_username()
	{
		var una=$("#username").val();
		var len=$("#username").val().length;
		//var pattern = /^(\w*(\d+[a-zA-Z]|[a-zA-Z]+\d)\w*)+$/;
		if(una=="")
		{
			error_username=true;
			$("#username_error_message").html("Fill User Name");
			$("#username_error_message").show();
			$("#username").css("border-bottom","1px solid red");
			$("#username_error_message").css("color","red");
		}
		 /*else if(len < 2 || len > 30)
		{
		  error_username=true;
			$("#username_error_message").html("Enter betwwen 2-30 character");
			$("#username_error_message").show();
			$("#username").css("border-bottom","2px solid red");
		}
		else 
		if(pattern.test(una) == "")
	{
	error_username=true;
			$("#username_error_message").html("Enter both Letter and number only");
			$("#username_error_message").show();
			$("#username").css("border-bottom","2px solid red");
	}*/
		else 
		{
		error_username=false;
			$("#username").css("border-bottom","1px solid green");
			$("#username_error_message").hide();
		}
	}	  
	 
	 // For Password
	function check_password()
	{
		var pa=$("#password").val();
		var len=$("#password").val().length;
		//var pattern = /^(\w*(\d+[a-zA-Z]|[a-zA-Z]+\d)\w*)+$/;
		if(pa=="")
		{
			error_password=true;
			$("#password_error_message").html("Fill user password");
			$("#password_error_message").show();
			$("#password").css("border-bottom","1px solid red");
			$("#password_error_message").css("color","red");
		}
		 /*else if(len < 2 || len > 30)
		{
		  error_password=true;
			$("#password_error_message").html("Enter betwwen 2-30 character");
			$("#password_error_message").show();
			$("#password").css("border-bottom","2px solid red");
		}
		else 
		if(pattern.test(pa) == "")
	{
	error_password=true;
			$("#password_error_message").html("Enter both Letter and number only");
			$("#password_error_message").show();
			$("#password").css("border-bottom","2px solid red");
	}*/
		else 
		{
		error_password=false;
			$("#password").css("border-bottom","1px solid green");
			$("#password_error_message").hide();
		}
	}	  
	 // For account Type
	 function check_account()
    {
      var aco=$("#accounttype").val();
      if( aco=="select Account")
      {
        error_accounttype=false;
        $("#accounttype_error_message").html("Select accounttype");
        $("#accounttype_error_message").show();
        $("#accounttype").css("border-bottom","1px solid red");
        $("#accounttype").css("width","170px");
        $("#accounttype_error_message").css("color","red");
      }
      else
      {
      error_accounttype = false;
        $("#accounttype").css("border-bottom","1px solid green");
        $("#accounttype_error_message").hide();
       }
       }
$("#crform").submit(function(){
		 error_fname=false;
         error_lname=false;
		 error_user_id=false;
         error_phone=false;
         error_username=false;
		 error_password=false;
	     error_accounttype=false;	
		
		  check_fname();
          check_lname();
		  check_user_id();
		  check_phone();
		  check_username();
		  check_password();
		  check_account();
if(error_fname===false&& error_lname===false&&error_user_id===false&&error_phone===false
&& error_username===false&&error_password===false&&error_accounttype===false)
	   {
		   return true;
	   }
	   else{
		   return false;
	   }

	});
	});
		
	