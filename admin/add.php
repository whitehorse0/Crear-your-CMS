<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['logged_in'])) {
    //menampilkan halaman Add
    if (isset($_POST['title'], $_POST['content'])) {
        $title = $_POST['title'];
        $content = nl2br($_POST['content']);

        if(empty($title) or empty($content)) {
          $error = 'All Field are required !';
        } else {
              $query = $pdo->prepare('INSERT INTO articles (article_title, article_content, article_timestamp) VALUES (?, ?, ?)');

              $query->bindValue(1, $title);
              $query->bindValue(2, $content);
              $query->bindValue(3, time());

              $query->execute();

              header('Location: index.php');
        }
    }
    ?>

    <html>
    <head>
      <title>CMS</title>
      <link rel="stylesheet" href="../assets/style.css" />
    </head>

    <body>
          <div class="container">
            <a href="index.php" id="logo">CMS</a>
            <br />

            <h4>Tambah Artikel</h4>

            <?php if (isset($error)) { ?>
            <small style="color: #aa0000;"><?php echo $error ?></small>
            <br /><br />
            <?php } ?>


            <form action="add.php" method="post" autocomplete="off">
                  <input type="text" name="title" placeholder="Title" /> <br /><br />
                  <textarea rows="10" cols="40" placeholder="Content" name="content" ></textarea><br /><br />
                  <input type="submit" value="Add Artikel"/>
            </form>
			
          </div>
    </body>
    </html>


    <?php
} else {
    header('Location: index.php');

}
?>
