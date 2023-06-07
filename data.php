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
function doesUserExist($connection,$oldemail,$newemail){
    $resultaat= $connection->query("SELECT * from tblgegevens where email = '".$newemail."'");
    return($resultaat->num_rows != 0 && $oldemail != $newemail)?false:true;
}
function updateUser($connection,$email,$naam,$voornaam,$oldemail,$newemail,$password){
    
}