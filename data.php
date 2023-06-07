<?php
function noData($data){
    print'
    <div class="data">
    <p>There is no '.$data.' data.</p>
    </div>
    ';
}
function getCartAmount($connection, $email) {
    $aantal = 0;
    $resultaat = $connection->query("SELECT * FROM tblbestelling WHERE email = '" . $email . "'");
    while ($row = $resultaat->fetch_assoc()) {
        $aantal += $row["aantal"];
    }
    return $aantal;
}
function getAllProducts($connection) {
    $resultaat = $connection->query("SELECT * from tblproducten");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function getAllUsers($connection){
$resultaat = $connection->query("SELECT * from tblgegevens where admin is null");
return($resultaat->num_rows == 0)? false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getAllAdmins($connection){
    $resultaat = $connection->query("SELECT * from tblgegevens where admin = 1");
    return($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getAllSales($connection){
    $resultaat = $connection->query("SELECT * from tblfacturen order by tijd desc");
    return($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function isEmailInUse($connection,$oldemail,$newemail){
    $resultaat= $connection->query("SELECT * from tblgegevens where email = '".$newemail."'");
    return($resultaat->num_rows != 0 && $oldemail != $newemail)?true:false;
}
function checkIfAdmin($connection, $email){
    $resultaat = $connection->query("SELECT * from tblgegevens where email = '".$email."' AND admin = 1");
    return ($resultaat->num_rows == 0)?false:true;
}
function updateUser($connection,$naam,$voornaam,$oldemail,$newemail,$password){
    if(empty($password)){
        $sql = "UPDATE tblgegevens SET naam ='" . $naam . "',voornaam ='" . $voornaam . "',email ='" . $newemail."' WHERE email = '".$oldemail."'";
    }else{
        $sql = "UPDATE tblgegevens SET naam ='" . $naam . "',voornaam ='" . $voornaam . "',email ='" . $newemail."',password ='" .$hashedPassword."' WHERE email = '".$oldemail."'";
    }
    $resultaat = $connection->query($sql);
}
function deleteUser($connection,$email){
    $connection->query("DELETE from tblgegevens where email = '".$email."'");
}
function isImageUploaded($imageFile,$error,$tmpName,$imageFileName){
    if (isset($imageFile) && $error == 0) {
        $targetDir = "../fotos/"; // Specify the directory where you want to store the uploaded images
        $targetFile = $targetDir . basename($imageFileName);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Check if the uploaded file is an image
        $validExtensions = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $validExtensions)) {
            // Move the temporary uploaded file to the desired location
            if (move_uploaded_file($tmpName, $targetFile)) {
                return true;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        return false;
    }
}
function updateProduct($conection,$image,$naam,$prijs,$id){
    if(empty($image)){
        $sql = "UPDATE tblproducten SET naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$id."'";
    }else{
        $sql = "UPDATE tblproducten SET image ='" . $image . "',naam ='" . $naam . "',prijs ='" . $prijs."' WHERE id = '".$id."'";
    }
        $resultaat = $conection->query($sql);
}