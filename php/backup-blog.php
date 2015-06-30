<?php

$content = new TemplatePower("../html/blog.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

switch($action)
{
    case "toevoegen":
        if(!empty($_POST['title'])
            && !empty($_POST['content'])){

// insert
            $insert_blog = $db->prepare("INSERT INTO blog SET
                                                    Title = :title,
                                                Content = :content,
                                                Accounts_idAccounts = :accounts");
            $insert_blog->bindParam(":title", $_POST['title']);
            $insert_blog->bindParam(":content", $_POST['content']);
            $insert_blog->bindValue(":accounts", 5);
            $insert_blog->execute();
            print "Yeahhhhhhh";

        }else{
// formulier
            $content->newBlock("ADDBLOG");
            $content->assign("ACTION", "index.php?pageid=7&action=toevoegen");
            $content->assign("BUTTON", "Toevoegen Blog");
        }
        break;
    case "wijzigen":
        if(isset($_POST['blogid']))
        {
            $update_blog = $db->prepare("UPDATE blog
                                        SET Title = :title,
                                            Content = :content
                                            WHERE idBlog = :blogid");
            $update_blog->bindParam(":title", $_POST['title']);
            $update_blog->bindParam(":content", $_POST['content']);
            $update_blog->bindParam(":blogid", $_POST['blogid']);
            $update_blog->execute();
            print "ohhhhhhhhhh";
        }else{
            $get_user = $db->prepare("SELECT blog.Title,
                                                blog.Content,
                                                blog.idBlog
                                                FROM blog
                                                WHERE idBlog = :idblog");
            $get_user->bindParam(":idblog", $_GET['blogid']);
            $get_user->execute();
            $user = $get_user->fetch(PDO::FETCH_ASSOC);
            $content->newBlock("ADDBLOG");
            $content->assign("ACTION", "index.php?pageid=7&action=wijzigen");
            $content->assign("BUTTON", "Wijzigen Blog");
            $content->assign(array(
                "TITLE" => $user['Title'],
                "CONTENT" => $user['Content']
            ));
        }
        break;
    case "verwijderen":
        if(isset($_GET['accountid']))
        {
            $check_user = $db->prepare("SELECT count(*) FROM accounts WHERE idAccounts = :accountid");
            $check_user->bindParam(":accountid", $_GET['accountid']);
            $check_user->execute();
            if($check_user->fetchColumn() == 1){
                $get_user = $db->prepare("SELECT blog FROM users, accounts
                                        WHERE users.idUsers=accounts.Users_idUsers
                                        AND accounts.idAccounts = :accountid");
                $get_user->bindParam(":accountid", $_GET['accountid']);
                $get_user->execute();
                $user = $get_user->fetch(PDO::FETCH_ASSOC);
                $content->newBlock("USERFORM");
                $content->assign(array(
                    "ACTION" => "index.php?pageid=1&action=verwijderen",
                    "BUTTON" => "Verwijderen Gebruiker",
                    "ACCOUNTID" => $user['idAccounts'],
                    "USERID" => $user['idUsers'],
                    "VOORNAAM" => $user['Name'],
                    "ACHTERNAAM" => $user['Surename'],
                    "EMAIL" => $user['Email'],
                    "USERNAME" => $user['Username']
                ));
            }else{
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Deze gebruiker bestaat niet. Hoe ben je hier gekomen???");
            }
        }elseif(isset($_POST['accountid'])){
// formulier verstuurd
            $delete = $db->prepare("DELETE FROM accounts WHERE idAccounts = :accountid");
            $delete->bindParam(":accountid", $_POST['accountid']);
            $delete->execute();

            $delete = $db->prepare("DELETE FROM users WHERE idUsers = :userid");
            $delete->bindParam(":userid", $_POST['userid']);
            $delete->execute();

            $content->newBlock("MELDING");
            $content->assign("MELDING", "Gebruiker is verwijderd");
        }else{
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "Deze gebruiker bestaat helemaal niet. Hoe ben je hier gekomen???");
        }
        break;
    default:
        $content->newBlock("BLOGSEARCH");
        if(!empty($_POST['search'])){
            $get_blog = $db->prepare("SELECT blog.Title,
                                                blog.Content,
                                                blog.idBlog
                                                FROM blog
                                                WHERE (blog.Title LIKE :search
                                                OR blog.Content LIKE :search2)
                                                ");
            $search = "%".$_POST['search']."%";
            $get_blog->bindParam(":search", $search);
            $get_blog->bindParam(":search2", $search);
            $get_blog->execute();
            $content->assign("SEARCH", $_POST['search']);
        }else{
            $get_blog = $db->query("SELECT blog.Title,
                                            blog.Content,
                                            blog.idBlog
                                            FROM blog");
        }
        while($blog = $get_blog->fetch(PDO::FETCH_ASSOC)){
            $content->newBlock("BLOG");
            $content->assign(array(
                "TITLE" => $blog['Title'],
                "CONTENT" => $blog['Content'],
                "BLOGID" => $blog['idBlog']
            ));
        }
}