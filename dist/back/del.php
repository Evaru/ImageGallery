
<?
require('connect.php');

if(isset($_POST['del'])) {
    $del =(int)$_POST['del'];
    
    $query1 = mysqli_query($link,"DELETE FROM `img` WHERE id=$del");
    header("location: /index.php");
    exit;
}

?>
