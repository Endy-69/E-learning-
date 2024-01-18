 $(function(){
$("#photo_error_message").hide();
$("#grade_error_message").hide();
$("#fname_error_message").hide();
$("#mname_error_message").hide();
$("#lname_error_message").hide();
$("#birthdate_error_message").hide();
$("#sex_error_message").hide();
//$("#age_error_message").hide();
$("#tname_error_message").hide();
$("#wname_error_message").hide();
$("#aname_error_message").hide();
$("#ename_error_message").hide();
$("#dep_error_message").hide();
$("#phone_error_message").hide();
$("#sename_error_message").hide();
$("#yname_error_message").hide();

var error_photo=false;
var error_grade=false;
var error_fname=false;
var error_mname=false;
var error_lname=false;
var error_birthdate=false;
var error_sex=false;
//var error_age=false;
var error_tname=false;
var error_wname=false;
var error_aname=false;
var error_ename=false;
var error_dep=false;
var error_phone=false;
var error_sename=false;
var error_yname=false;

$("#photo").focusout(function(){
check_photo();
});
$("#grade").focusout(function(){
check_grade();
});
$("#firstname").focusout(function(){
check_fname();
});
$("#middlename").focusout(function(){
check_mname();
});
$("#lastname").focusout(function(){
check_lname();
});
$("#birthdate").focusout(function(){
check_birthdate();
});
$("#sex").focusout(function(){
check_sex();
});
$("#town").focusout(function(){
check_town();
});
$("#woreda").focusout(function(){
check_woreda();
});
$("#adress").focusout(function(){
check_adress();
});
$("#email").focusout(function(){
check_email();
});
$("#dep").focusout(function(){
check_dep();
});
$("#phone").focusout(function(){
check_phone();
});
$("#semister").focusout(function(){
check_semister();
});
$("#year").focusout(function(){
check_year();
});
// For photo
function check_photo()
    {
      var pho=$("#photo").val();
      if(pho=="choose File")
      {
        error_photo=true;
        $("#photo_error_message").html("Browse grade 10 File");
        $("#photo_error_message").show();
        $("#photo").css("border-bottom","1px solid red");
        $("#photo").css("width","170px");
        $("#photo_error_message").css("color","red");
      }
      else
      {
      error_photo = false;
        $("#photo").css("border-bottom","1px solid green");
        $("#photo_error_message").hide();
       }
}
// For grade
function check_grade()
    {
      var pho=$("#grade").val();
      if(pho=="choose File")
      {
        error_grade=true;
        $("#grade_error_message").html("Browse grade 12 file");
        $("#grade_error_message").show();
        $("#grade").css("border-bottom","1px solid red");
        $("#grade").css("width","170px");
        $("#grade_error_message").css("color","red");
      }
      else
      {
      error_grade = false;
        $("#grade").css("border-bottom","1px solid green");
        $("#grade_error_message").hide();
       }
}
	// For first name
function check_fname()
	{
		var f=$("#firstname").val();
		var len=$("#firstname").val().length;
		var pattern =/^[A-Za-z]*$/;
		if(f== "")
		{
		firstname==true;
		$("#fname_error_message").html("Enter First Name");
		$("#fname_error_message").show(); 
		$("#firstname").css("border-bottom","1px solid red");	
		$("#fname_error_message").css("color","red");
		}
			else if(pattern.test(f) == "")
	    {  
             firstname=true;
			$("#fname_error_message").html("Enter valid First Name In Letter only");
			$("#fname_error_message").show();
			$("#firstname").css("border-bottom","2px solid red");
			$("#fname_error_message").css("color","red");
		}
		else if(len <2 || len > 30)
		{
		 firstname=true;
			$("#fname_error_message").html("Enter betwwen 2-30 Letters");
			$("#fname_error_message").show();
			$("#firstname").css("border-bottom","2px solid red");
			$("#fname_error_message").css("color","red");
		}
	
		else
		{
		$("#firstname").css("border-bottom","2px solid green");
		$("#fname_error_message").hide(); 	
		}
	 }	
	 	// For middle name
function check_mname()
	{
		var m=$("#middlename").val();
		var len=$("#middlename").val().length;
		var pattern = /^[A-Za-z]*$/;
		if(m == "")
		{
		middlename==true;
		$("#mname_error_message").html("Enter Middle Name");
		$("#mname_error_message").show(); 
		$("#middlename").css("border-bottom","1px solid red");	
		$("#mname_error_message").css("color","red");
		}
		else if(len <2 || len > 30)
		{
		 middlename=true;
			$("#mname_error_message").html("Enter between 2-30 Letters");
			$("#mname_error_message").show();
			$("#middlename").css("border-bottom","2px solid red");
			$("#mname_error_message").css("color","red");
		}
		else if(pattern.test(m) == "")
	    {  
             middlename=true;
			$("#mname_error_message").html("Enter valid Middle name In Letter only!!");
			$("#mname_error_message").show();
			$("#middlename").css("border-bottom","2px solid red");
			$("#mname_error_message").css("color","red");
		}
		else
		{
		$("#middlename").css("border-bottom","2px solid green");
		$("#mname_error_message").hide(); 	
		}
	 }	
	 // For last name
	 function check_lname()
	{
		var l=$("#lastname").val();
		var len=$("#lastname").val().length;
		var pattern = /^[A-Za-z]*$/;;
		if(l== "")
		{
		lastname==true;
		$("#lname_error_message").html("Enter Last Name");
		$("#lname_error_message").show(); 
		$("#lastname").css("border-bottom","1px solid red");	
		$("#lname_error_message").css("color","red");
		}
		else if(len < 2|| len > 30)
		{
		 lastname=true;
			$("#lname_error_message").html("Enter between 2-30 Letters");
			$("#lname_error_message").show();
			$("#lastname").css("border-bottom","2px solid red");
			$("#lname_error_message").css("color","red");
		}
		else if(pattern.test(l) == "")
	    {  
             lastname=true;
			$("#lname_error_message").html("Enter valid last name  In Letter only");
			$("#lname_error_message").show();
			$("#lastname").css("border-bottom","2px solid red");
			$("#lname_error_message").css("color","red");
		}
		else
		{
		$("#lastname").css("border-bottom","2px solid green");
		$("#lname_error_message").hide(); 	
		}
	 }	
		
		// For birthdate
	function check_birthdate()
	{
		var bir=$("#birthdate").val();
		var pattern =/^[0-9][/][0-9][/][0-9]*$/;
		if(bir=="")
		{
			error_birthdate =true;
			$("#birthdate_error_message").html("Enter birth date");
			$("#birthdate_error_message").show();
			$("#birthdate").css("border-bottom","1px solid red");
			$("#birthdate_error_message").css("color"," red");
		}

else
   {
   error_birthdate=false;	   
   $("#birthdate").css("border-bottom","1px solid green");
   $("#birthdate_error_message").hide();
	 }
	}
	// For sex
	function check_sex()
    {
      var se=$("#sex").val();
      if( se=="select Sex")
      {
        error_sex=true;
        $("#sex_error_message").html("Select sex");
        $("#sex_error_message").show();
        $("#sex").css("border-bottom","1px solid red");
        $("#sex").css("width","170px");
        $("#sex_error_message").css("color","red");
      }
      else
      {
      error_sex = false;
        $("#sex").css("border-bottom","1px solid green");
        $("#sex_error_message").hide();
       }
         }
        	  
    // For town
	 function check_town()
	{
		var tow=$("#town").val();
		var len=$("#town").val().length;
		var pattern =/^[A-Za-z ]*$/;
		if(tow == "")
		{
		town==true;
		$("#tname_error_message").html("Enter your town ");
		$("#tname_error_message").show(); 
		$("#town").css("border-bottom","1px solid red");	
		$("#tname_error_message").css("color","red");
		}
		else if(pattern.test(tow) == "")
	    {  
             town=true;
			$("#tname_error_message").html("Enter Valid town Name");
			$("#tname_error_message").show();
			$("#town").css("border-bottom","2px solid red");
			$("#tname_error_message").css("color","red");
		}
		else if(len <2|| len > 30)
		{
		 town=true;
			$("#tname_error_message").html("Enter your town between 2-30 character ");
			$("#tname_error_message").show();
			$("#town").css("border-bottom","2px solid red");
			$("#tname_error_message").css("color","red");
		}
		
		else
		{
		$("#town").css("border-bottom","2px solid green");
		$("#tname_error_message").hide(); 	
		}
	 }
	 // For woreda
	  function check_woreda()
	{
		var wor=$("#woreda").val();
		var len=$("#woreda").val().length;
		var pattern =/^[A-Za-z ]*$/;
		if(wor == "")
		{
		woreda==true;
		$("#wname_error_message").html("Enter your Woreda name");
		$("#wname_error_message").show(); 
		$("#woreda").css("border-bottom","1px solid red");	
		$("#wname_error_message").css("color","red");
		}
			else if(pattern.test(wor) == "")
	    {  
             woreda=true;
			$("#wname_error_message").html("Enter Valid Woreda Name");
			$("#wname_error_message").show();
			$("#woreda").css("border-bottom","2px solid red");
			$("#wname_error_message").css("color","red");
		}
		else if(len <2|| len > 30)
		{
		 woreda=true;
			$("#wname_error_message").html("Enter your woreda name between 2-30 Letter");
			$("#wname_error_message").show();
			$("#woreda").css("border-bottom","2px solid red");
			$("#wname_error_message").css("color","red");
		}
		else if(pattern.test(wor) == "")
	    {  
             woreda=true;
			$("#wname_error_message").html("Enter valid Woreda Name");
			$("#wname_error_message").show();
			$("#woreda").css("border-bottom","2px solid red");
			$("#wname_error_message").css("color","red");
		}
		else
		{
		$("#woreda").css("border-bottom","2px solid green");
		$("#wname_error_message").hide(); 	
		}
	 }
	 // For adress
	  function check_adress()
	{
		var adre=$("#adress").val();
		var len=$("#adress").val().length;
		var pattern =/^[A-Za-z ]*$/;
		if(adre == "")
		{
		adress==true;
		$("#aname_error_message").html("Enter your address");
		$("#aname_error_message").show(); 
		$("#adress").css("border-bottom","1px solid red");	
		$("#aname_error_message").css("color","red");
		}
			else if(pattern.test(adre) == "")
	    {  
             adress=true;
			$("#aname_error_message").html("Enter Valid Adress ");
			$("#aname_error_message").show();
			$("#adress").css("border-bottom","2px solid red");
			$("#aname_error_message").css("color","red");
		}
		else if(len <2 || len >30)
		{
		 adress=true;
			$("#aname_error_message").html("Enter between 2-30 Letter");
			$("#aname_error_message").show();
			$("#adress").css("border-bottom","2px solid red");
			$("#aname_error_message").css("color","red");
		}	
		else
		{
		$("#adress").css("border-bottom","2px solid green");
		$("#aname_error_message").hide(); 	
		}
	 }
	 // For email
	function check_email()
  {
  var emi=$("#email").val();
  var len=$("#email").val().length;
  var pattern = /^[A-Za-z]+[0-9]{0,10}[@]+[a-z]{5,15}[.]+[a-z]{2,3}$/;  //^[A-Za-z]+@+[a-z]{5,15}+[.]{1}+[a-z]{2,3}*$/   /^[A-Za-z]+[0-9]{0,8}+[@]+[a-z]{5,15}+[.]{1}+[a-z]{}
  if(emi=="")
  {
    error_ename = true;
    $("#ename_error_message").html("Enter your email Adress");
    $("#ename_error_message").show();
    $("#email").css("border-bottom","1px solid red");
    $("#ename_error_message").css("color","red");
  }
  else
  if(pattern.test(emi) == "")
  {
  error_ename=true;
    $("#ename_error_message").html("Enter valid email address");
    $("#ename_error_message").show();
    $("#email").css("border-bottom","2px solid red");
    $("#ename_error_message").css("color","red");
  }
  else if(len < 10 || len > 30)
  {
    error_ename=true;
    $("#ename_error_message").html("Enter between 10-30 input");
    $("#ename_error_message").show();
    $("#email").css("border-bottom","2px solid red");
    $("#ename_error_message").css("color","red");
  }
 
  else
  {
    $("#email").css("border-bottom","1px solid green");
    $("#ename_error_message").hide();
  }
  }
 // For depname		  
function check_dep(){
        var role=$("#dep").val();
		if(role=="Select department")
		{
			error_dep=true;
			$("#dep_error_message").html("Select department");
			$("#dep_error_message").show();
			$("#dep").css("border-bottom","1px solid red");
			$("#dep_error_message").css("color","red");
		}
		else{
			error_dep=false;
        $("#dep").css("border-bottom","2px solid green");
        $("#dep_error_message").hide();
            }
		}
 // For phone
	 function check_phone()
  	{
  		var phon=$("#phone").val();
  		var len=$("#phone").val().length;
          var pattern = /^[+]+[2]+[5]+[1][0-9]+$/;
  		if(phon == "")
  		{
  	error_phone = true;
  			$("#phone_error_message").html("Enter your phone");
  			$("#phone_error_message").show();
  			$("#phone").css("border-bottom","1px solid red");
  			$("#phone_error_message").css("color","red");
  		}
  		else
  		if(pattern.test(phon) == "")
  	{
  	error_phone = true;
  			$("#phone_error_message").html("Enter Valid Phone Number!!");
  			$("#phone_error_message").show();
  			$("#phone").css("border-bottom","2px solid red");
  			$("#phone_error_message").css("color","red");
  	}
  		  else
  	   if(len < 13 || len >13)
  	   {
  		   error_phone = true;
  	   $("#phone_error_message").html("Your phone should be 13 digits");
  	   $("#phone_error_message").show();
  	   $("#phone").css("border-bottom","2px solid red");
  	   }
  		else
  		{
  			$("#phone").css("border-bottom","1px solid green");
  			$("#phone_error_message").hide();
  		}
  	}
	// For semister
	 	function check_semister()
    {
      var semi=$("#semister").val();
      if( semi=="select semester")
      {
        error_sename=false;
        $("#sename_error_message").html("Select semister");
        $("#sename_error_message").show();
        $("#semister").css("border-bottom","1px solid red");
        $("#semister").css("width","170px");
        $("#sename_error_message").css("color","red");
      }
      else
      {
      error_sename = false;
        $("#semister").css("border-bottom","1px solid green");
        $("#sename_error_message").hide();
       }
       }
	   // For year
       function check_year()
       {
      var yea=$("#year").val();
      if( yea=="select year")
      {
        error_yname=false;
        $("#yname_error_message").html("Select year");
        $("#yname_error_message").show();
        $("#year").css("border-bottom","1px solid red");
        $("#year").css("width","170px");
        $("#yname_error_message").css("color","red");
      }
      else
      {
      error_yname = false;
        $("#year").css("border-bottom","1px solid green");
        $("#yname_error_message").hide();
       }
       }
$("#rform").submit(function(){
	    error_photo=false;
		error_grade=false;
		error_fname=false;
        error_mname=false;
        error_lname=false;
        error_birthdate=false;
		error_sex=false;
		error_tname=false;
		error_wname=false;
        error_aname=false;
		error_ename=false;
		error_dep=false;
        error_phone=false;
		error_sename=false;
		error_yname=false;
		
         check_photo();
		 check_grade();
		 check_fname();
         check_mname();
         check_lname();
         check_birthdate();
		 check_sex();
		 check_town();
		 check_woreda();
		 check_adress();
		 check_email();
		 check_dep();
		 check_phone();
		 check_semister();
		 check_year();
if(error_photo===false&&error_grade===false&& error_fname===false&&error_mname===false&&error_lname===false&&error_birthdate===false
&& error_sex===false&&error_tname===false&&error_wname===false&&error_aname===false
&&error_ename===false&&error_dep===false&&error_phone===false&&error_sename===false&&error_yname===false)
	   {
		   return true;
	   }
	   else{
		   return false;
	   }

	});
	});
		
	