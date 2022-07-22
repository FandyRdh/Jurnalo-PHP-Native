<?php
// Session
session_start();

// Connection
$hostName = 'localhost';
$usernameDB = 'root';
$passwrodDB = '';
$nameDB = 'jurnals-app';

$conn = mysqli_connect($hostName, $usernameDB, $passwrodDB, $nameDB);

function registerUser($data)
{
    global $conn;
    // var_dump($data);

    $ID_USER = "IU-" . uniqid();
    $IDTYPE = "it-002";
    $NAME = htmlspecialchars($data['name-register']);
    $BIRTH = htmlspecialchars($data['birth-register']);
    $EMAIL = htmlspecialchars($data['email-register']);
    $PASSWORD = htmlspecialchars($data['password-register']);
    $PHOTO_PROFILE = "profile-default.jpg";

    // enc
    $PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

    // $query = "INSERT INTO jurnals(judul, date, body1, body2) VALUES ('$judul',CURDATE(),'$body1','$body2')";
    $query = "INSERT INTO user(ID_USER, IDTYPE, NAME, BIRTH, EMAIL, PASSWORD, PHOTO_PROFILE, REGISTRATION_DATE) 
        VALUES ('$ID_USER','$IDTYPE','$NAME','$BIRTH','$EMAIL','$PASSWORD','$PHOTO_PROFILE',CURDATE());";
    mysqli_query($conn, $query);


    if (mysqli_affected_rows($conn) > 0) {
        return true;
    } else {

        return false;
    }
}

function login($data)
{
    global $conn;
    $email = $data['email-login'];
    $password = $data['password-login'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");

    // CEK USERNAME
    if (mysqli_num_rows($result) === 1) {
        // CEK PASSWORD
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['PASSWORD'])) {
            // Set session
            $_SESSION["login"] = true;
            $_SESSION["ID_USER"] =  $row['ID_USER'];
            $_SESSION["NAME"] =  $row['NAME'];
            $_SESSION["EMAIL"] =  $row['EMAIL'];
            $_SESSION["PHOTO_PROFILE"] =  $row['PHOTO_PROFILE'];

            header("Location: index.php");
            exit;
        }
    }
    return true;
}

function logout()
{
    $_SESSION = []; //tidak wajib biar yakin aj
    session_unset(); // tidak wajib
    session_destroy();

    header("Location: index.php");
    exit;
}

function journalCreate($data)
{
    global $conn;
    // var_dump($data);
    $ID_JURNAL = "JID-" . uniqid();
    $ID_USER = $_SESSION['ID_USER'];
    $ID_JURNAL_VISIBILITY = "jv_001";
    $TITILE = htmlspecialchars($data['title-create']);
    $BODY1 = "";
    $BODY2 = $data['body1-create'];
    // Upload Gambar
    // $gambar = upload();
    // if (!$gambar) {
    //     return false;
    // }


    $query = "INSERT INTO jurnals(ID_JURNAL, ID_USER, ID_JURNAL_VISIBILITY, TITILE, DATE, BODY1, BODY2) 
    VALUES ('$ID_JURNAL','$ID_USER','$ID_JURNAL_VISIBILITY','$TITILE',CURDATE(),'$BODY1','$BODY2');";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function journalView()
{
    global $conn;
    $query = "SELECT jurnals.ID_JURNAL,jurnals.ID_USER,jurnals.TITILE,jurnals.DATE,jurnals.BODY1,jurnals.BODY2,USER.NAME 
    FROM jurnals
    JOIN USER
    ON jurnals.ID_USER = USER.ID_USER;";

    $result =  mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}
