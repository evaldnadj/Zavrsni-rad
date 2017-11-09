<?php
try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=blogpro', 'root', 'vivify');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $statement = $conn->prepare("SELECT * FROM posts WHERE Id = {$_GET['post_id']}");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $post = $statement->fetch();
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>

<?php include ('header.php'); ?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">
                <h2 class="blog-post-title"><a href="single-post.php?post_id=<?php echo($post['Id']) ?>"><?php echo $post['Title']?></a></h2>
                <p class="blog-post-meta"><?php echo $post['Created_at']?> <a href="#"><?php echo $post['Author']?></a></p>

            <?php echo $post['Body'];?>
            </div><!-- /.blog-post -->
            <?php
               $statement = $conn->prepare("SELECT * FROM comments WHERE Post_id = {$_GET['post_id']}");
               $statement->execute();
               $statement->setFetchMode(PDO::FETCH_ASSOC);
               $comments = $statement->fetchall();

           foreach ($comments as $singleCom){
           ?>
           <div class ="removecomm">

             <input type="button" value="hide-show" onclick="hide()"> 

           </div>
           <div class = "comments" id="comments">
               <ul>
                   <li> <?php echo $singleCom['Author'];?> </li> <br>
                   <li> <?php echo $singleCom['Text'];?> </li> <hr>
               </ul>
           </div>
           <?php
           } ?>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div><!-- /.row -->
        <?php include ('sidebar.php') ?>
        </div><!-- /.blog-main -->



</main><!-- /.container -->

<?php include ('footer.php'); ?>
<script src="function.js"></script>
</body>
</html>