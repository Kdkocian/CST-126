<?php
session_start();
include_once("db.php");

?>
<html>
    <head>
</head>
<body>
    <?php
    require_once("nbbc/nbbc.php");


    $bbcode = new BBCode;

    $sql = "SELECT * FROM posts ORDER BY id DESC";

    $res = mysqli_query($db, $sql) or die (mysqli_error());

    $posts = "";
    if(mysqli_num_rows($res) > 0){
        while($row = mysqli_fetch_assoc($res)){
            $id = $row['post_ID'];
            $date = $row['post_date'];
            $content = $row['post_content'];
            $title = $row['article_title'];

            $admin = "<div><a href='del_post.php?pid=$id'>Delete</a>&nbsp; <a href='edit_post.php?pid=$id'>Edit</a></div>";

            $output = $bbcode->Parse($content);

            $post .= "<div><h2><a href='view_post.php?pid=$id'></a></h2><h3>$date</h3><p>$output</p>$admin</div>";
        }
        echo $posts;
    } else {
        echo "There are no posts to display!";
    }
    ?>
</body>
</html>
