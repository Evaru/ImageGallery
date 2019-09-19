
<link rel="stylesheet" href="css/cropper.css">
    <script src="js/cropper.js"></script>
<?php
require('connect.php');
if(isset($_GET['del'])) {
    $del =(int)$_GET['del'];
    
    $query1 = mysqli_query($link,"DELETE FROM img WHERE id=$del");
    var_dump($del);
    header("location: ../index.php");
    exit;
}
if($_POST['addComments']){ 
    $text = $_POST['text'];
    $author =$_POST['author'];
    $date = date('Y-m-d H:i:s');
    $img_comment=$_POST['img_id'];

mysqli_query($link,"INSERT INTO comments(`author`,`text`,`date`,`img_id`) VALUES('$author','$text','$date','$img_comment')");
header("location: ../index.php");
    exit;
}


$query = mysqli_query($link,"SELECT* FROM img  ORDER BY `name`");
$data = 0;
			while ( $img = mysqli_fetch_array($query) ) {
                  echo '
                  
                  <div class="content__look__image">
                    <a href="#image-'.$data.'"><img src="img/'.$img['name'].'" alt="'.$img['name'].'" id=img'.$data.' ></a>';
                    echo "<a class=delete name=\'del\' href='back/img.php?del={$img["id"]}' title='удалить'><img src=img/del.png alt=удалить></a>";
                    echo '<div class="lb-overlay" id="image-'.$data.'">
                       <div class="lb-over">
                            <div class="lb-overlay__img">
                                <div name=img_id class=img_id>'.$img['id'].'</div>
                               <img src="img/'.$img['name'].'" alt="'.$img['name'].'" class=im id="crop-'.$data.'" />
                                <p>'.$img['name'].'</p>
                                
                             </div>
                             <div class="lb-overlay__desc">
                               <div class="lb-overlay__desc-top">
                                    <p class=redact >'.$img['name'].'</p>
                                    
                               </div>
                               <span>'.$img['description'].' </span>
                               </div></div>    
                                <div class="description">';
                            $next=$data+1;
                            $prev=$data-1;
                    echo '<a href="#image-'.$prev.'" class="lb-prev">Prev</a>
                            <a href="#image-'.$next.'" class="lb-next">Next</a>
                        </div>
                        <a href="#page" class="lb-close">Закрыть</a>
                    </div>
                  </div> ';
                  $data++;
            }
           
            

?>
<script>
function crop(){
        this.parent().parent().find('.im').cropper('getCroppedCanvas').toBlob(function(blob){
            const formData = new FormData();

            formData.append('croppedImage', blob);
            $.ajax('upload.php', {
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success() {
                alert('Upload success');
            },
            error() {
                console.log('Upload error');
            },
            });
        }); 
      }
</script>
