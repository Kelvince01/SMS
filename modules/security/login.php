<title>MySkulMate:: LOGIN</title>
<style type="text/css">
td {font-size:10; font-family:verdana;  }
p {font-size:10; font-family:verdana }
bb {font-size:9; font-family:verdana }
w {font-size:10 }
a.w:hover {color:red}
.alert {
    background: url(/sms/images/error.jpg) no-repeat left top;
	font-size: 12px;
    line-height: 12px;
    font-family: "Trebuchet MS", Arial, Helvetica, Sans-Serif;
	color: #000000;
    font-weight: normal;
	margin: 0px;
    padding: 6px 5px 6px 5px;
	background-color: #FFFFCC;
	width: 90%;
    border-bottom: 1px solid #93323a;
    border-right: 1px solid #93323a;
    border-left: 1px solid #93323a;
    border-top: 1px solid #cd717a;
    text-transform: none;
}
.info{
 background: url(/sms/images/info.jpg) no-repeat left top;
background-color: #FFFFCC;
font-size: 12px;
    line-height: 12px;
    font-family: "Trebuchet MS", Arial, Helvetica, Sans-Serif;
	color: #000000;
    font-weight: normal;
	margin: 0px;
    padding: 6px 5px 6px 5px;
	background-color: #FFFFCC;
	width: 90%;
    border-bottom: 1px solid blue;
    border-right: 1px solid blue;
    border-left: 1px solid blue;
    border-top: 1px solid blue;
    text-transform: none;
}
</style>
<br><br>
<table width="60%" align="center" border="2" cellspacing="0" bgcolor="#DDDDDD">
<br><br>
<tr><td>
   <p align="left"><img src="/sms/school_logo.jpg" width="150" height="100" border="1"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <img src="/sms/images/login.jpg" align="" height="100" width="200" border="1"/>
   <img src="/sms/images/logo.png" align="right" height="100" width="150"border="1"/></p>
   
		 <form name ="login" id="login" method="post" align="center"  onsubmit="return validate(this);" action="process_login.php" >
				<?php
	if(isset($_GET['info']))
	{
	if($_GET['tab']=='invalid'){
	echo "<div class='alert' align='center'>The login details provided are wrong,please enter correct details</div>";
	}
	
	elseif($_GET['tab']=='logout') {
	echo "<div class='info' align='center'>You have successfully logged out</div>";

	}
	else {
	echo "<div class='info' align='center'>Please enter your login credetials to continue</div>";

	}
	}
    else {
	echo "<div class='info' align='center'>Please enter your login credetials to continue</div>";

	}
	?>
	<br><br>
				<table align="left" width="25%"><tr><td><img src="/sms/images/lock_3.png"/></td></tr></table>
					<table width="60%" border="0" align="center">
                          <tr>
                            <td ><strong>Username:</strong></td></tr>
                           <tr> <td><label>
                              <input type="text" name="userName" id="User_Name" title="Enter your Username to login."/>
                            </label></td>
                          </tr>
                          <tr>
                            <td height="30"><strong>Password:</strong></td></tr>
							<tr><td><label>
                              <input type="password" name="password" id="Password" title="Enter your Password." />
                            </label></td>
                          </tr>
                          <tr>
                            <td height="15"></td></tr>
                      <tr><td align="left"><label>
                              <input type="submit" name="login" id="login" value="Log In" >
							  
					 </label></td>
							
                          </tr>
                         
                        </table>
                    <script language="JavaScript" type="text/javascript">
<!--
function validate (login)
{
 
  if (login.User_Name.value == "") {
    alert( "Please Enter your Username." );
    login.User_Name.focus();
    return false ;
  }
 
	else if (login.Password.value == "") {
    alert( "Please enter your Password." );
    login.Password.focus();
    return false ;
	}
	else{
  
  return true ;

  }
}
//-->
</script>
	          </form>
			  
			  

</table>
