<?php

$content = new TemplatePower("../html/admin_comments.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}
if(isset($_SESSION['roleid'])){
    if($_SESSION['roleid'] == 2){
        switch($action) {
            case "toevoegen":
                if (!empty($_POST['comment'])) { // voorwaarde => insert
                    $insert = $db->prepare("INSERT INTO comments
                                            SET Text = :text,
                                            Accounts_idAccounts = :account");
                    $insert->bindParam(":text", $_POST['comment']);
                    $insert->bindParam(":account", $_SESSION['accountid']);
                    $insert->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "comment toegevoegd");
                } else {
// formulier
                    $content->newBlock("COMMENTFORM");
                    $content->assign(array("ACTION" => "index.php?pageid=8&action=toevoegen",
                        "BUTTON" => "Toevoegen Blog"));
                }
                break;
            case "wijzigen":
                if (isset($_GET['commentid'])) {
// ophalen project
                    $check_project = $db->prepare("SELECT count(*) FROM
                                                  accounts a, comments c
                                                  WHERE a.idAccounts = c.Accounts_idAccounts
                                                  AND c.idComments = :commentsid");
                    $check_project->bindParam(":commentsid", $_GET['commentid']);
                    $check_project->execute();
                    if ($check_project->fetchColumn() == 1) {
// hij bestaat in db
                        $get_project = $db->prepare("SELECT * FROM
                                                    accounts a, comments c
                                                    WHERE a.idAccounts = c.Accounts_idAccounts
                                                    AND c.idComments = :commentsid");
                        $get_project->bindParam(":commentsid", $_GET['commentid']);
                        $get_project->execute();
                        $project = $get_project->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("COMMENTFORM");
                        $content->assign(array(
                            "COMMENT" => $project['Text'],
                            "COMMENTID" => $project['idComments'],
                            "ACTION" => "index.php?pageid=8&action=wijzigen",
                            "BUTTON" => "Blog Wijzigen"
                        ));
                    } else {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Waarom heb je het blogid in de url veranderd???");
                    }
                } elseif (!empty($_POST['comment'])
                    AND !empty($_POST['commentid'])
                ) {
                    $update = $db->prepare("UPDATE comments
                                              SET Text = :text
                                              WHERE comments.idComments = :commentsid");
                    $update->bindParam(":text", $_POST['comment']);
                    $update->bindParam(":commentsid", $_POST['commentid']);
                    $update->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog gewijzigd");
                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "WTF doe je hier");
                }
                break;
            case "verwijderen":
                if (isset($_GET['commentid'])) {
                    $check_user = $db->prepare("SELECT count(*) FROM comments WHERE comments.idComments = :idcomments");
                    $check_user->bindParam(":idcomments", $_GET['commentid']);
                    $check_user->execute();

                    if ($check_user->fetchColumn() == 1) {

                        $get_user = $db->prepare("SELECT * FROM comments c , accounts a
                                        WHERE a.idAccounts = c.Accounts_idAccounts
                                        AND  c.idComments = :idcomments");
                        $get_user->bindParam(":idcomments", $_GET['commentid']);
                        $get_user->execute();
                        $user = $get_user->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("COMMENTFORM");
                        $content->assign(array(
                            "ACTION" => "index.php?pageid=8&action=verwijderen",
                            "BUTTON" => "Verwijderen Blog",
                            "COMMENTID" => $user['idComments'],
                            "COMMENT" => $user['Text']
                        ));
                    } else {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Deze blog bestaat niet. Hoe ben je hier gekomen???");
                    }
                } elseif (isset($_POST['commentid'])) {
// formulier verstuurd
                    $delete = $db->prepare("DELETE FROM comments WHERE comments.idComments = :idcomments");
                    $delete->bindParam(":idcomments", $_POST['commentid']);
                    $delete->execute();

//                    $delete = $db->prepare("DELETE FROM users WHERE idUsers = :userid");
//                    $delete->bindParam(":userid", $_POST['userid']);
//                    $delete->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is verwijderd");
                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "Deze blog bestaat helemaal niet. Hoe ben je hier gekomen???");
                }
                break;
            default:
// checken of er projecten zijn
                if (!empty($_POST['search'])) {
                    // heb ik resultaten met de search
                    // check of ik resultaten heb

                    try {
                        $check_projects = $db->prepare("SELECT count(comments.idComments)
                                            FROM accounts, comments
                                            WHERE accounts.idAccounts = comments.Accounts_idAccounts
                                            AND (comments.Text LIKE :search)
                                            ");
                        $search = "%" . $_POST['search'] . "%";
                        $check_projects->bindParam(":search", $search);
                        $check_projects->bindParam(":search2", $search);
                        $check_projects->execute();

                    } catch (PDOException $error) {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Er gaat wat fout");
                        break;
                    }
                    if ($check_projects->fetchColumn() > 0) {
                        // jaaaa, we hebben projecten

                        $content->newBlock("COMMENTLIST");

                        $get_projects = $db->prepare("SELECT accounts.Username,
                                                          accounts.idAccounts,
                                                          comments.Text,
                                                          comments.idComments
                                                FROM  comments, accounts
                                                WHERE accounts.idAccounts = comments.Accounts_idAccounts
                                                AND (comments.Text LIKE :search)
                                                ");
                        $search = "%" . $_POST['search'] . "%";
                        $get_projects->bindParam(":search", $search);
                        $get_projects->bindParam(":search2", $search);
                        $get_projects->execute();
                        $content->assign("SEARCH", $_POST['search']);
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Zoek criteria gevonden, tabel weergeven");
                    }else {
// melding laten zien, geen resultaten (geen tabel)
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Geen projecten gevonden met de ingevulde criteria");
                        break;
                    }

                }else{
                    // overzicht laten zien alles uit db
                    $check_projects = $db->query("SELECT count(comments.idComments)
                                            FROM accounts, comments
                                            WHERE accounts.idAccounts = comments.Accounts_idAccounts");
                    if ($check_projects->fetchColumn() > 0) {
                        // jaaaa, we hebben projecten
                        $content->newBlock("COMMENTLIST");

                        $get_projects = $db->query("SELECT accounts.Username,
                                                          accounts.idAccounts,
                                                           comments.Text,
                                                          comments.idComments
                                                FROM  comments, accounts
                                                WHERE accounts.idAccounts = comments.Accounts_idAccounts");
                    }else {
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Geen comments gevonden met de ingevulde criteria");
                        break;
                    }
                }
                while ($projects = $get_projects->fetch(PDO::FETCH_ASSOC)) {
                    $content->newBlock("COMMENTROW");
                    $inhoud = $projects['Text'];
                    if (strlen($inhoud) > 30) {
                        $inhoud = substr($projects['Content'], 0, 30) . "...";
                    }

                    $content->assign(array(
                        "USERNAME" => $projects['Username'],
                        "CONTENT" => $inhoud,
                        "COMMENTID" => $projects['idComments'],
                        "ACCOUNTID" => $projects['idAccounts']
                    ));
                }
        }


    }else{
// je hebt niet de goede rechten
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Je hebt niet de goede rechten");
    }

}else{
// je bent niet ingelogd
    $errors->newBlock("ERRORS");
    $errors->assign("ERROR", "Je bent niet ingelogd");
}
