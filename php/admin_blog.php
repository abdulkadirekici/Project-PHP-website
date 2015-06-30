<?php

$content = new TemplatePower("../html/blog.tpl");
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
                if (!empty($_POST['title']) AND !empty($_POST['content'])) { // voorwaarde => insert
                    $insert = $db->prepare("INSERT INTO blog
                                            SET Title = :title,
                                            Content = :content,
                                            Accounts_idAccounts = :account");
                    $insert->bindParam(":title", $_POST['title']);
                    $insert->bindParam(":content", $_POST['content']);
                    $insert->bindParam(":account", $_SESSION['accountid']);
                    $insert->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog toegevoegd");
                } else {
// formulier
                    $content->newBlock("BLOGFORM");
                    $content->assign(array("ACTION" => "index.php?pageid=7&action=toevoegen",
                        "BUTTON" => "Toevoegen Blog"));
                }
                break;
            case "wijzigen":
                if (isset($_GET['blogid'])) {
// ophalen project
                    $check_project = $db->prepare("SELECT count(*) FROM
                                                  accounts a, blog b
                                                  WHERE a.idAccounts = b.Accounts_idAccounts
                                                  AND b.idBlog = :blogid");
                    $check_project->bindParam(":blogid", $_GET['blogid']);
                    $check_project->execute();
                    if ($check_project->fetchColumn() == 1) {
// hij bestaat in db
                        $get_project = $db->prepare("SELECT * FROM
                                                    accounts a, blog b
                                                    WHERE a.idAccounts = b.Accounts_idAccounts
                                                    AND b.idBlog = :blogid");
                        $get_project->bindParam(":blogid", $_GET['blogid']);
                        $get_project->execute();
                        $project = $get_project->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("BLOGFORM");
                        $content->assign(array(
                            "TITLE" => $project['Title'],
                            "CONTENT" => $project['Content'],
                            "BLOGID" => $project['idBlog'],
                            "ACTION" => "index.php?pageid=7&action=wijzigen",
                            "BUTTON" => "Blog Wijzigen"
                        ));
                    } else {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Waarom heb je het blogid in de url veranderd???");
                    }
                } elseif (!empty($_POST['title'])
                    AND !empty($_POST['content'])
                    AND !empty($_POST['blogid'])
                ) {
                    $update = $db->prepare("UPDATE blog SET Title = :title,
                                                            Content = :content
                                              WHERE idBlog = :idblog");
                    $update->bindParam(":title", $_POST['title']);
                    $update->bindParam(":content", $_POST['content']);
                    $update->bindParam(":idblog", $_POST['blogid']);
                    $update->execute();
                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog gewijzigd");
                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "WTF doe je hier");
                }
                break;
            case "verwijderen":
                if (isset($_GET['blogid'])) {
                    $check_user = $db->prepare("SELECT count(*) FROM blog WHERE idBlog = :blogid");
                    $check_user->bindParam(":blogid", $_GET['blogid']);
                    $check_user->execute();

                    if ($check_user->fetchColumn() == 1) {

                        $get_user = $db->prepare("SELECT * FROM blog b , accounts a
                                        WHERE a.idAccounts = b.Accounts_idAccounts
                                        AND  b.idBlog = :blogid");
                        $get_user->bindParam(":blogid", $_GET['blogid']);
                        $get_user->execute();
                        $user = $get_user->fetch(PDO::FETCH_ASSOC);
                        $content->newBlock("BLOGFORM");
                        $content->assign(array(
                            "ACTION" => "index.php?pageid=7&action=verwijderen",
                            "BUTTON" => "Verwijderen Blog",
                            "BLOGID" => $user['idBlog'],
                            "TITLE" => $user['Title'],
                            "CONTENT" => $user['Content']
                        ));
                    } else {
                        $errors->newBlock("ERRORS");
                        $errors->assign("ERROR", "Deze blog bestaat niet. Hoe ben je hier gekomen???");
                    }
                } elseif (isset($_POST['blogid'])) {
// formulier verstuurd
                    $delete = $db->prepare("DELETE FROM blog WHERE idBlog = :blogid");
                    $delete->bindParam(":blogid", $_POST['blogid']);
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
                        $check_projects = $db->prepare("SELECT count(blog.idBlog)
                                            FROM accounts, blog
                                            WHERE accounts.idAccounts = blog.Accounts_idAccounts
                                            AND (blog.Title LIKE :search
                                            OR blog.Content LIKE :search2)
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

                        $content->newBlock("BLOGLIST");

                        $get_projects = $db->prepare("SELECT accounts.Username,
                                                          accounts.idAccounts,
                                                          blog.Title,
                                                          blog.Content,
                                                          blog.idBlog
                                                FROM  blog, accounts
                                                WHERE accounts.idAccounts = blog.Accounts_idAccounts
                                                AND (blog.Title LIKE :search
                                                OR blog.Content LIKE :search2)
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
                    $check_projects = $db->query("SELECT count(blog.idBlog)
                                            FROM accounts, blog
                                            WHERE accounts.idAccounts = blog.Accounts_idAccounts");
                    if ($check_projects->fetchColumn() > 0) {
                        // jaaaa, we hebben projecten
                        $content->newBlock("BLOGLIST");

                        $get_projects = $db->query("SELECT accounts.Username,
                                                          accounts.idAccounts,
                                                          blog.Title,
                                                          blog.Content,
                                                          blog.idBlog
                                                FROM  blog, accounts
                                                WHERE accounts.idAccounts = blog.Accounts_idAccounts");
                    }else {
                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Geen projecten gevonden met de ingevulde criteria");
                        break;
                    }
                }
                while ($projects = $get_projects->fetch(PDO::FETCH_ASSOC)) {
                    $content->newBlock("BLOGROW");
                    $inhoud = $projects['Content'];
                    if (strlen($inhoud) > 30) {
                        $inhoud = substr($projects['Content'], 0, 30) . "...";
                    }

                    $content->assign(array(
                        "USERNAME" => $projects['Username'],
                        "TITLE" => $projects['Title'],
                        "CONTENT" => $inhoud,
                        "BLOGID" => $projects['idBlog'],
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
