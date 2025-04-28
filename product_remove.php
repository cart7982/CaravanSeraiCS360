<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "caravanserai";

session_start();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Get the ID to be deleted from the UserPage.
$_ProductID = $_POST['ProductID'];

//This grabs the integer from the string:
$ID = intval(preg_replace('/[^0-9]+/','', $_ProductID), 10);

//Get the image filename/path from the database
$stmt = $conn->prepare("SELECT ImagePath FROM products WHERE ProductID = ?");
$stmt->bind_param("s", $_ProductID);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $imagePath = './Images/' . $row['ImagePath'];

    //Delete the image from the file system
    if (file_exists($imagePath) && $row['ImagePath'] != 'logo_1.jpg') {
        if (unlink($imagePath)) {
            echo "Image deleted successfully.<br>";
        } else {
            echo "Failed to delete image.<br>";
        }
    } else {
        echo "Image file not found.<br>";
    }
}
$stmt->close();

$sql = "DELETE FROM products WHERE ProductID='$ID'";

$conn->query($sql);

$conn->close();

header('Location:profile.php');
?>