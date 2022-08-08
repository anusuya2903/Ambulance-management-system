<?php
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $email = $_POST['email'];
  $age = $_POST['age'];
  $mc = $_POST['mc'];
  $phno = $_POST['phno'];
  
  if (!empty($name) || !empty($dob) || !empty($email) || !empty($age) || !empty($mc) || !empty($phno))
{

$host = "";
$dbusername = "id19024219_kaarunya";
$dbpassword = "Anusuya@2903";
$dbname = "id19024219_anu";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From data Where email = ? Limit 1";
  $INSERT = "INSERT Into data (name , dob , email , age, mc , phno )values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssisi", $name ,$dob ,$email ,$age, $mc ,$phno);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>