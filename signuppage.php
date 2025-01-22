<html>
    <body>
    <head>
    <link rel="stylesheet" href="globalCSS.css">
</head>
<?php



// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "classsync"; // Change to your database name
// Create a connection
$conn = new mysqli($servername,$username,$password,$dbname);
// Check the connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
//collect data from the signuppage
if ($_SERVER["REQUEST_METHOD"]==="POST")
{
    $name=$_POST['Name'];
    $class=$_POST['Class'];
    $Semester=$_POST['Semester'];
    $department=$_POST['Department'];
    $email=$_POST['Email'];
    $role=$_POST['Role'];
    $Cpass=$_POST['createPassword'];
    $pass=$_POST['confirmPassword'];
}
    // Initialize an array to hold error messages
    $errors = [];
    // Password validation
    $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
    if (!preg_match($passwordRegex, $pass)) 
    {
        $errors[] = "Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
    }
    if ($Cpass !== $pass) 
    {
        $errors[] = "Passwords do not match";
    }
    // Check for errors
    if (empty($errors)) 
    {
        // Proceed with further processing (e.g., saving to database)
        echo "Registration successful!";
        // You can redirect or perform other actions here
    } 
    else 
    {
        // Display errors
        foreach ($errors as $error) 
        {
            echo "<p style='color: red;'>$error</p>";
        }
    }

// Hash the password for security
$hashed_password = password_hash($pass, PASSWORD_DEFAULT);

// Check for existing user with the same email

    // No existing user found, insert new user data
    $sql_insert = "INSERT INTO User_Details ('userID','name','class','semester','department','email','role','password','created_at') VALUES ((?,?,?,?,?,?,?,NOW())";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ississss",$uesrID,$name,$Semester,$department,$email,$role,$pass);
    if ($stmt_insert->execute()) 
    {
        echo "New user registered successfully!";
    } 
    else 
    {
        echo "Error: " . $stmt_insert->error;
    }
    // Close the insert statement
    $stmt_insert->close();
// Close connections
$stmt_check->close();
$conn->close();
?>
</body>
</html>