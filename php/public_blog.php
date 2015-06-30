<?php
$content = new TemplatePower("../html/public_blog.tpl");
$content->prepare();

if(isset($_GET['blogid'])){
// controleren of alles er is
    $content->newBlock("DETAILS");

    $check_blog = $db->prepare("SELECT count(*) FROM blog
                                WHERE idBlog = :blogid");
    $check_blog->bindParam(":blogid", $_GET['blogid']);
    $check_blog->execute();

    if($check_blog->fetchColumn() == 1){
        $get_blog = $db->prepare("SELECT b.*, a.Username FROM blog b, accounts a
                                        WHERE b.idblog = :blogid
                                And b.Accounts_idAccounts = a.idAccounts");

        $get_blog->bindParam(":blogid", $_GET['blogid']);
        $get_blog->execute();

        $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

        $content->assign(array("TITLE" => $blog['Title'],
            "CONTENT" => $blog['Content'],
            "USERNAME" => $blog['Username']));

        if(isset($_SESSION['accountid'])){
            $content->newBlock("COMMENTFORM");
            $content->assign("BLOGID", $blog['idBlog']);


            if (!empty($_POST['comment'])) {
                // heb comment ingevuld
                $insert_comment = $db->prepare("INSERT INTO comments SET
                        Text = :comment ,
                        Accounts_idAccounts = :accountid,
                        blog_idblog = :blogidd");
                $insert_comment->bindParam(":comment", $_POST['comment']);
                $insert_comment->bindParam(":accountid", $_SESSION['accountid']);
                $insert_comment->bindParam(":blogidd", $_POST['blogid']);
                $insert_comment->execute();

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Comment toegevoegd");
            }

        }


        // comments ophalen
        $check_comments = $db->prepare("SELECT count(*) FROM comments
                                      WHERE Blog_idBlog = :blogid");
        $check_comments->bindParam(":blogid", $_GET['blogid']);
        $check_comments->execute();

        if($check_comments->fetchColumn() > 0){
            // ik heb comments !!!!!!
            $get_comments = $db->prepare("SELECT comments.*, accounts.Username
                                          FROM comments, accounts
                                          WHERE comments.Blog_idBlog = :blogid
                                          AND comments.Accounts_idAccounts = accounts.idAccounts");
            $get_comments->bindParam(":blogid", $_GET['blogid']);
            $get_comments->execute();

            while($comments = $get_comments->fetch(PDO::FETCH_ASSOC)){
                $content->newBlock("COMMENT");
                $content->assign(array("USERNAME" => $comments['Username'],
                    "COMMENT" => $comments['Text']));
            }


        }

    }else{
// error
        echo "hallo";
    }
}else{
    $check_blog = $db->query("SELECT count(*) FROM blog");

    if($check_blog->fetchColumn() > 0 ){
        $get_blog = $db->query("SELECT b.*, a.Username FROM blog b, accounts a
                                        WHERE b.Accounts_idAccounts = a.idAccounts");
        $teller = 0;

        while($blogs = $get_blog->fetch(PDO::FETCH_ASSOC)){
            $teller++;
            if($teller % 3 == 1){
// div openen
                $content->newBlock("BEGIN");
            }
// block van een element oproepen
            $blogcontent = substr($blogs['Content'], 0, 150)." ...";
            $content->newBlock("BLOG");
            $content->assign(array("TITLE" => $blogs['Title'],
                "CONTENT" => $blogcontent,
                "USERNAME" => $blogs['Username'],
                "BLOGID" => $blogs['idBlog']));
            if($teller % 3 == 0){
// div sluiten
                $content->newBlock("END");
            }

        }

    }else{
// geen projecten gevonden
    }
}
