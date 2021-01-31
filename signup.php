<html>
<head>
<title>Log in</title>
<link rel="stylesheet" href="nav.css">
<style>
body{
margin:0;
padding:0;
font:family:Bell MT;
background:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(loginbg.jpg) no-repeat;
background-size: cover;
}

.lb{
width: 280px;
position: absolute;
top:50%;
left:50%;
transform:translate(-50%,-50%);
color: white;
padding: 30px;
}

.lb h1{
float: left;
font-size: 40px;
border-bottom: 4px solid white;
margin-bottom: 50px;
padding: 13px 0;
}

.textbox{
width: 100%;
overflow: hidden;
font-size: 20px;
padding: 8px 0;
margin: 8px 0;
border-bottom: 1px solid;
}

.textbox input{
border: none;
outline: none;
background: none;
color: white;
font-size: 18px;
width: 80%;
float:left;
margin:0 10px; 
}

.btn{
width:100%;
background:none;
border: 2px solid white;
color:white;
padding: 5px;
font-size: 18px;
cursor: pointer;
margin:12px 0;
}

.btn:hover{
background-color:white;
color: black;
transition: 0.6s ease;
}

.btn{
width:100%;
background:none;
border: 2px solid white;
color:white;
padding: 5px;
font-size: 18px;
cursor: pointer;
margin:12px 0;
}
.sel{
border: none;
outline: none;
background: none;
color:white;
font-size: 17px;
transition: 0.6s ease;
font-family: Century Gothic;
}

.sel:hover{
background-color:white;
color:black;
}
</style>


</head>
<body>


<div class="main">
<div class="logo">
<img src="logo1 - Copy.png" alt="hello">
</div>
<ul>
<li class="active"><a href="home.php">Home</a></li>
<li><a href="showvenue.php">Book now</a></li>
<li><a href="checkloginv.php">Add venue</a></li>
<li><a href="showevents.php">Upcoming Events</a></li>
<li><a href="addevent.php">Create Event</a></li>
<li><a href="services.php">Services</a></li>
<?php
if(isset($_SESSION['uname']))
{
	?>
	<li><select name="f1" onchange="location = this.value;" class="sel">
	<option disabled selected><?php echo($_SESSION['uname']);?> <i class="fa fa-user-circle-o" style="font-size:24px;color:white"></i></option>
	<option value="mybook.php">My bookings</option>
	<option value="?logout='1'">Log out</option>
</select>
</li>
<?php
}
else{
	?>
<li><select name="f1" onchange="location = this.value;" class="sel">
<option disabled selected>Login <i class="fa fa-user-circle-o" style="font-size:24px;color:white"></i></option>
 <option value="login.php">Login</option>
 <option value="signup.php">Sign up</option>
</select>
</li>
<?php	
}
?>

</ul>
</div>

<div class="lb">
<h1>Signup</h1>
<form action="" method="POST">
<div class="textbox">
<input type="text" placeholder="Name" id="name" name="name">
</div>

<div class="textbox">
<input type="text" placeholder="Username" id="uname" name="uname">
</div>

<div class="textbox">
<input type="email" placeholder="Email id" id="em" name="em">
</div>

<div class="textbox">
<input type="password" placeholder="Password" id="p1" name="p1">
</div>

<div class="textbox">
<input type="password" placeholder="Confirm Password" id ="p2" name="p2">
</div>
<input class="btn" type="submit" name="s1">

</div>

</body>
</html>



<?php




if(isset($_POST['s1']))
{
	
$name=$_POST['name'];
$uname=$_POST['uname'];
$em=$_POST['em'];
$pass=$_POST['p1'];
$cpass=$_POST['p2'];

if(!preg_match("/^[A-Za-z]+$/",$name))
{
echo '<script type="text/javascript">alert("Invalid name");</script>';
exit();
}
if (preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/",$em))
{
if(preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{6,}$/",$pass))
{
if($pass==$cpass)
{
}
else
{
	echo '<script type="text/javascript">alert("Password did not match");</script>';
	exit();
}
}
else{
	echo '<script type="text/javascript">alert("Password Must contain Uppercase characters,lowercase characters and digits");</script>';
	exit();
}
}
else
{
echo '<script type="text/javascript">alert("Invalid Email");</script>';	
exit();
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eventmanagement";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql1 = "select * from signup where username='".$uname."'";

if(mysqli_num_rows(mysqli_query($conn,$sql1))>0)
{
		echo '<script type="text/javascript">alert("Username already exist");</script>';	
		exit();
}

$sql = "INSERT INTO signup values('$name','$uname','$em','$pass')";


if (mysqli_query($conn,$sql) === TRUE) {
	header("Location:login.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
}
?>
