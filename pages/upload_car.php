<?php
session_start();
include "../includes/database.php";

// Vetëm admini mund të upload
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: services.php");
    exit;
}

if(isset($_POST['add_car'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $transmission = $_POST['transmission'];

    $imagePaths = [];

    // Folder ku do ruhen fotot
    $uploadDir = "../images/cars/";

    // Krijo folder nëse nuk ekziston
    if(!file_exists($uploadDir)){
        mkdir($uploadDir, 0777, true);
    }

    // Loop për multiple images
    foreach($_FILES['images']['tmp_name'] as $key => $tmpName){

        if($_FILES['images']['error'][$key] === 0){

            $fileName = time() . "_" . basename($_FILES['images']['name'][$key]);
            $targetFile = $uploadDir . $fileName;

            if(move_uploaded_file($tmpName, $targetFile)){
                // Ruaj path relativ për databazë
                $imagePaths[] = "images/cars/" . $fileName;
            }
        }
    }

    // Kthe array në JSON
    $imagesJSON = json_encode($imagePaths);

    // Insert në databazë
    $stmt = $conn->prepare("INSERT INTO cars (name, price, type, transmission, images) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsss", $name, $price, $type, $transmission, $imagesJSON);

    if($stmt->execute()){
        header("Location: services.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>
