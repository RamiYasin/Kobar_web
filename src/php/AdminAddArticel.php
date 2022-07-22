<?php
require_once 'Page.php';

class AdminAddArticel extends Page
{
    protected function upload_image(){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }


    protected function generateView()
    {

        $this->generatePageHeader("Add Articel");
        echo <<<EOT


<html>
<head>
    <title>Kurs Hinzufuegen</title>
    <meta charset="UTF-8">

</head>
<body>

<div class="NAVI_bar">
    <div class="card">
        <a>Add Articel</a>
        <a href="">Delete a Articel</a>
        <a href="">Edit a Articel</a>
    </div>
</div>
<form accept-charset="UTF-8" method="post">
    <div class="Articel Info">
        <h1>Articel Name</h1>
        <input type="text" name="Articel_Name" placeholder="Articel_Name">
        <h1>Articel Discrebtion</h1>
        <textarea name="Articel_Discrebtion" placeholder="Articel_Discrebtion"></textarea>
        <button type="submit" name="submit" class="button">Add</button>
    </div>
</form>
</body>
</html>
EOT;
        $this->generatePageFooter();

    }

    protected function processReceivedData(): void
    {
        parent::processReceivedData();
        if (isset($_POST["Articel_Name"]) && isset($_POST["Articel_Discrebtion"])) {

            $Articel_Name = $this->db->real_escape_string($_POST["Articel_Name"]);
            $Articel_dis = $this->db->real_escape_string($_POST["Articel_Discrebtion"]);//oder is_numeric prüfen

            $sql = "INSERT INTO `news` ( `new_Name` , `new_dis`) VALUES ('$Articel_Name' , '$Articel_dis')";
            if (!$this->db->query($sql)) {
                throw new Exception("INSERT failed: " . $this->db->error);
            }
            header('Location:AdminAddArticel.php');
            die();

            //header();

        }
    }

    public static function main()
    {
        try {
            $page = new AdminAddArticel();
            $page->processReceivedData();
            $page->generateView();
        } catch (Exception $e) {
            //header("Content-type: text/plain; charset=UTF-8");
            header("Content-type: text/html; charset=UTF-8");
            echo $e->getMessage();
        }
    }
}

AdminAddArticel::main();







