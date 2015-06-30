<?php
$content = new TemplatePower("../html/registratie.tpl");
$content->prepare();


if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

switch($action) {
    case "registreren":
        if (!empty($_POST['voornaam'])
            && !empty($_POST['achternaam'])
            && !empty($_POST['gebruikersnaam'])
            && !empty($_POST['email'])
            && !empty($_POST['password1'])
            && !empty($_POST['password2'])
        ) {
            // insert
            if ($_POST['password1'] == $_POST['password2']) {
                // insert
                $insert_user = $db->prepare("INSERT INTO users SET
                  Surename = :achternaam,
                  Name = :voornaam,
                  Email = :email");
                $insert_user->bindParam(":achternaam", $_POST['achternaam']);
                $insert_user->bindParam(":voornaam", $_POST['voornaam']);
                $insert_user->bindParam(":email", $_POST['email']);
                $insert_user->execute();

                $userid = $db->lastInsertId();

                $insert_account = $db->prepare("INSERT INTO accounts SET
                  Username = :username,
                  Password = :password,
                  salt = :salt,
                  Users_idUsers = :userid,
                  Role_idRole = :roleid");
                $insert_account->bindParam(":username", $_POST['gebruikersnaam']);
                $password = sha1($_POST['password1']);
                $insert_account->bindParam(":password", $password);
                $insert_account->bindParam(":salt", $userid);
                $insert_account->bindParam(":userid", $userid);
                $insert_account->bindValue(":roleid", 1);
                $insert_account->execute();

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Gebruiker is toegevoegd");
                print "Gelukt";


            } else {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Wachtwoord komt niet overeen!");
                $content->newBlock("FORMULIER");
                $content->assign("ACTION", "index.php?pageid=1&action=registreren");
                $content->assign("BUTTON", "Toevoegen Gebruiker");
            }

        } else {
            // formulier
            $content->newBlock("FORMULIER");
            $content->assign("ACTION", "index.php?pageid=3&action=registreren");
            $content->assign("BUTTON", "Toevoegen Gebruiker");
        }
        break;
}
