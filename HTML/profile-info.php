<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

session_start();

include "../APIs/services/DBconnect.php";
include "../APIs/services/usrCheck.php";
require_once "../APIs/usr/get.php";

$dati = getUserInfo($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Tue Informazioni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/segoe-ui-variable-static-display" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../CSS/fontSettings.css">
    <link rel="stylesheet" href="../CSS/interCSS.css">
    <link rel="stylesheet" href="../CSS/detailedCSS.css">
    <link rel="stylesheet" href="../CSS/calendario.css">

    <style>

        .profile-title {
        margin-top: 40px;
        font-size: 20px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: #9F9F9F;
        }
        .avatar-upload {
            position: relative;
            display: inline-block;
            margin-bottom: 20px;
        }
        .avatar-image {
            width: 150px;  /* Dimensioni dell'avatar */
            height: 150px;
            border-radius: 50%; /* Rende l'immagine circolare */
            object-fit: cover; /* Assicura che l'immagine non si deformi */
            border: 3px solid #ccc;
            cursor: pointer; /* Mostra la manina */
            transition: all 0.3s ease;
        }
        #avatar-input {
            display: none;
        }
        .confirm-Btn {
            width: 100%;
            padding: 17px;
            background: #f5a623;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 4px;
            font-family: inherit;
            transition: background 0.15s;
            letter-spacing: 0.3px;
            }
    </style>

</head>
<body>
    <div class="navBar">
        <div class="navBar-L">
            <a class="navBar-Brand" href="./homePage.html">MyOrganized</a>
            <div class="navBar-Link">
                <a href="#" class="Active">Panoramica</a>
                <a href="./store.html">Store</a>
                <a href="./planner.html">Planner</a>
            </div>
        </div>
    </div>
    <div class="mainView">
        <div class="mainLayout plannerLayout">
            <div class="rightColumn">
                <p class="superTitle">Le Tue Informazioni</p>
                <p class="subTitle">Modifica nome, cognome e Informazioni.</p>

                <form action="../APIs/usr/edit.php" method="post" enctype="multipart/form-data" >
                    <h3 class="profile-title">ANAGRAFICA</h3>
                    <div class="avatar-upload">
                
                        <label for="avatar-input" class="avatar-label">
                            <!-- Da modificare con php -->
                            <img src="<?php echo isset($dati["avatar"]) ? $dati["avatar"] : "img/defaultProfile.jpg" ?>" alt="Avatar Utente" id="avatar-preview" class="avatar-image">
                        </label>

                        <input type="file" name="avatar" id="avatar-input" accept="image/png, image/jpeg, image/jpg">
                        <span class="title">Avatar</span>
                        <span class="eventSubtitle">Cambia il tuo avatar</span>
                    </div>
                    <!-- Da modificare con php -->
                    <div>
                        <label for="usr-name">Nome</label><br>
                        <input type="text" name="name" id="usr-name" value="<?php echo $dati["name"] ?>">
                    </div>
                    <div>
                        <label for="usr-surname">Cognome</label><br>
                        <input type="text" name="surname" id="usr-surname" value="<?php echo $dati["surname"] ?>">
                    </div>
                    <div>
                        <label for="usr-email">eMail</label><br>
                        <input type="text" name="email" id="usr-email" value="<?php echo $dati["email"] ?>">
                    </div>
                    <button type="submit" class="confirm-Btn">Conferma</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>