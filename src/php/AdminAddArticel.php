<?php
require_once 'Page.php';


class AdminAddArticel extends Page
{



    protected function generateView() : void
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
        <input type="submit" name="submit" class="button">
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

        if (isset($_POST["Articel_Name"])&&isset($_POST["Articel_Discrebtion"]) ) {

            $Articel_Name = $this->db->real_escape_string($_POST["Articel_Name"]);
            $Articel_dis = $this->db->real_escape_string($_POST["Articel_Discrebtion"]);//oder is_numeric prüfen
            $sql = "INSERT INTO `news` ( `new_Name` , `new_dis`) VALUES ('$Articel_Name' , '$Articel_dis');";
            if (!$this->db->query($sql)) {
                throw new Exception("INSERT failed: " . $this->db->error);
            }

    ///////////////// upload a image ///////////////////////////

           // header("Location: AdminAddArticel.php");

           /* $targetDir = "uploads/";
            $fileName = basename($_FILES['yfile']['name']);

            $targetFilePath = $targetDir.$fileName;
            $fileType = strtolower(pathinfo($targetFilePath,PATHINFO_EXTENSION));
           // Check if image file is a actual image or fake image
            echo "<pre>";
            print_r($_FILES['myfile']);
            echo "</pre>";

            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif','pdf');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetFilePath)){
                    // Insert image file name into database
                    $sql = "INSERT INTO `news` ( `new_Name` , `new_dis`,`new_img`) VALUES ('$Articel_Name' , '$Articel_dis','$fileName')";
                    if (!$this->db->query($sql)) {
                        throw new Exception("INSERT failed: " . $this->db->error);
                    }
                    if($sql){
                         echo "The file ".$fileName. " has been uploaded successfully.";
                    }else{
                        echo "File upload failed, please try again.";
                    }
                }else{
                    echo "Sorry, there was an error uploading your file.";
                }
            }else{
                echo "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
            }

            /////////////////////////// stay in Page ////////////////////////
            header('Location:AdminAddArticel.php');
            die();*/

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







