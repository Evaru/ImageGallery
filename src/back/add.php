<?
require('connect.php');


$uploads_dir = '../img/';
$croppedImage = $_FILES['croppedImage'];
$to_be_upload = $croppedImage['tmp_name'];


$new_file =$GLOBALS['img'];


move_uploaded_file($to_be_upload, "$uploads_dir/$new_file");

if($_POST['add']){
    @mkdir("../img/", 0777); // создаем папку, если ее нет то ошибки не будет, задаем права

    $uploaddir = '../img/';
    $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
 

    if(copy($_FILES['uploadfile']['tmp_name'], $uploadfile)){
        echo "";
        
    }else{
        echo "<h3>Не удалось загрузить файл на сервер</h3>";
        //exit;
    }

    
    echo "<h3>Информация о загруженном на сервер файле: </h3>";
    echo "<p>Оригинальное имя загруженного файла:<b> ".$_FILES['uploadfile']['name']."</b></p>";
    echo "<p>Mime-тип загруженного файла:<b> ".$_FILES['uploadfile']['type']."</b></p>";
    echo "<p>Размер загруженного файла в байтах:<b> ".$_FILES['uploadfile']['size']."</b></p>";
    echo "<p>Временное имя файла: <b>".$_FILES['uploadfile']['tmp_name']."</b></p>";

}
?>
<form enctype="multipart/form-data" method="post" action="back/add.php"> 
    <div class="form__img">
        <div class="input-file-row-1">
            <div class="upload-file-container">
                <img id="image" src="#" alt="" />
                    <input type=file name="uploadfile" id="img">
                    <label for="img" class=for__img name=imag id=imag>Нажмите на надпись,для выбора изображения</label>
                    
                </div>
                <textarea name="desc_img" id="desc_img" cols="30" rows="10" placeholder="описание картинки"></textarea>
                <div id="add">
                    <a href="add.php"><button type="submit" name="add" value="Добавить">Добавить</button></a>
                </div>
        </div>
    </div>
</form>
<button class=redact  onclick="crop();">Обрезать</button><br/>
<span>Чтобы обрезать картинку,нажмите "обрезать", выделите область, нажмите снова обрезать,
    дождитесь всплывающего окна и нажмите кнопку добавить</span>
<script src=js/imgName.js></script>
<?

if($_POST['add']){ 

    $desc_img=$_POST['desc_img'];
    $img = $_FILES['uploadfile']['name'];
    $img1 = $new_file;
    $date = date('Y-m-d H:i:s');
    
    mysqli_query($link,"INSERT INTO img(`name`,`date`,`description`) VALUES('$img','$date','$desc_img')");
header("location: ../index.php");
    exit;
}

?>
<script>
    
function crop(){
        $('#image').cropper('getCroppedCanvas').toBlob(function(blob){
            const formData = new FormData();

            formData.append('croppedImage', blob);
            $.ajax('back/add.php', {
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


      function readURL(input) {

if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
        $('#image').attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
}
}

$("#img").change(function(){
readURL(this);
});
</script>
