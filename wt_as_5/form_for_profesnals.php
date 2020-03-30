<?php
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$cname=$_POST['cname'];
$email=$_POST['email'];
$password=$_POST['password'];
$degree=$_POST['degree'];
$compony=$_POST['compony'];
$gender=$_POST['gender'];
$phonecode=$_POST['phonecode'];
$phone=$_POST['phone'];
$Address=$_POST['Address'];
if(!empty($fname)||!empty($lname)||!empty($cname)||!empty($email)||!empty($password)||!empty($degree)||!empty($compony)||!empty($gender)||!empty($phonecode)||!empty($phone)||!empty($Address))
{
#code...
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="tufel";
	$conn=new mysqli($host,$dbusername,$dbpassword,$dbname)
if(mysqli_connect_error())
{
die('connect error('.mysqli_connect_errorno().')'.mysqli_connect_error());
}
else
{
	$SELECT="SELECT email from pro Where email =? Limit 1";
	$INSERT="INSERT Into pro (fname,lname,cname,email,password,degree,compony,gender,phonecode,phone,Address) values (?,?,?,?,?,?,?,?,?,?,?)";
//prepare statement...
	$stmt=$conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;

	if($rnum==0)
	{
     $stmt->close();

     
$stmt=$conn->prepare($INSERT);
$stmt->bind_param("ssssssssiis",$fname,$lname,$cname,$email,$password,$degree,$compony,$gender,$phonecode,$phone,$Address);
$stmt->execute();
echo "new record inserted sucessfully";
	}
	else
	{
		echo "some one alrady register using this email";

	}
$stmt->close();
$conn->close();
}
}
else
{
echo "All field are required";
die();
}
?>
