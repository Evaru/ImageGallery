

<?php
require('connect.php');


$query = mysqli_query($link,"SELECT* FROM img");
			while ( $img = mysqli_fetch_array($query) ) {
                  echo '
                    <form action="proba.php" method="post" >
                        <a href="#image-1"><img src="img/'.$img['name'].'" alt="'.$img['name'].'"></a>';
                        echo "<a name=\'del\' href='proba.php?del={$img["id"]}'>Удалить</span></a><br/>";
                   '</form>';
            }
           
if(isset($_GET['del'])) {
    $del =(int)$_GET['del'];
    
    $query1 = mysqli_query($link,"DELETE FROM img WHERE id=$del");
    var_dump($del);
    header("location: ../index.php");
    exit;
}

?>
