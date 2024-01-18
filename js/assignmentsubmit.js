$(function(){
$("#file_error_message").hide();
$("#studid_error_message").hide();
$("#dep_error_message").hide();
$("#yname_error_message").hide();
$("#modulenum_error_message").hide();
$("#sename_error_message").hide();

var error_file=false;
var error_studid=false;
var error_dep=false;
var error_yname=false;
var error_modulenum=false;
var error_sename=false;

$("#file").focusout(function(){
check_file();
});
$("#studid").focusout(function(){
check_studid();
});
 $("#dep").focusout(function(){
 check_depname();
 $("#year").focusout(function(){
check_year();
});
 $("#modulenum").focusout(function(){
 check_modulenum();
 });
 });
 $("#semister").focusout(function(){
check_semister();
});

// For file 
function check_file()
    {
      var pho=$("#file").val();
      if(pho=="Choose File")
      {
        error_file=true;
        $("#file_error_message").html("Browse your file");
        $("#file_error_message").show();
        $("#file").css("border-bottom","1px solid red");
        $("#file").css("width","170px");
        $("#file_error_message").css("color","red");
      }
      else
      {
      error_file = false;
        $("#file").css("border-bottom","1px solid green");
        $("#file_error_message").hide();
       }
}
  // For Student id 
function check_studid()
	{
		var cname=$("#studid").val();
		var len=$("#studid").val().length;
		var pattern = /^(\w*(\d+[a-zA-Z]|[a-zA-Z]+\d)\w*)+$/;
		if(cname== "")
		{
		studid==true;
		$("#studid_error_message").html("Enter student id");
		$("#studid_error_message").show(); 
		$("#studid").css("border-bottom","1px solid red");	
		$("#studid_error_message").css("color","red");
		}
		else if(len < 2 || len > 50)
		{
		 studid=true;
			$("#studid_error_message").html("Enter betwwen 2-50 Letter");
			$("#studid_error_message").show();
			$("#studid").css("border-bottom","2px solid red");
			$("#studid_error_message").css("color","red");
		}
			else
		{
		$("#studid").css("border-bottom","2px solid green");
		$("#studid_error_message").hide(); 	
		}
	 }
	// For depname		  
  function check_depname(){
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
   
	   // For year
       function check_year()
       {
      var yea=$("#year").val();
      if( yea=="Select year")
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
	   // For semister
	 	function check_semister()
    {
      var semi=$("#semister").val();
      if( semi=="Select semester")
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
$("#submassform").submit(function(){
	    
		error_file=false;
		error_studid=false;
        error_dep=false;
		error_modulenum=false;
        error_sename=false;
        error_yname=false;
          
		  check_file();
		  check_studid();		 
          check_depname();
		  check_modulenum();
		  check_year();
		  check_semister();

if(error_file===false && error_studid===false&&error_dep===false&&error_yname===false&&error_sename===false)
	   {
		   return true;
	   }
	   else{
		   return false;
	   }

	});
	});
		
	