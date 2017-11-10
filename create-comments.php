<?php
try {
        $conn = new PDO('mysql:host=127.0.0.1;dbname=blogpro', 'root', 'vivify');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
 
if (empty($_POST['Author']) or empty($_POST['comments'])) {
   echo "Morate uneti sve podatke!";
} else {
   $statement = $conn->prepare ("INSERT INTO comments(Author, Text, Post_id) values ('{$_POST['Author']}','{$_POST['comments']}',{$_POST['Post_id']} )");
    $statement->execute();
    header('Location: http://example.com/script.php');
}
    

?>
