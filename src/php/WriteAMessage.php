<?php
require_once 'Page.php';

class WriteAMessage extends Page
{
    protected function GenerateMessageView()
    {
        $this->generatePageHeader("Message");

        echo <<<EOT
<head xmlns="http://www.w3.org/1999/html">
<title>Angebote</title>
<meta charset="UTF-8">

</head>
<body>
<div class="NAVI_bar">
    <div class="card">
        <a href="">Kurs Erstellen</a>
        <a >Aktule Angebote</a>
        <a href="">Meine Belegungen</a>
    </div>
</div>
<form form accept-charset="UTF-8" method="post">
<h1>Write A Message </h1>
<input type="text" name="Message" id="Message">
 <input type="submit" name="submit" class="button">
</form>
</body>
</html>
EOT;
        $this->ProssestData();
    }

    protected function ProssestData()
    {
        if (isset($_POST["Message"])) {
            $Message = $this->db->real_escape_string($_POST["Message"]);
            $sql = "INSERT INTO message (`data`) VALUES ('$Message');";
            if (!$this->db->query($sql)) {
                throw new Exception("INSERT failed: " . $this->db->error);
            }
        }
    }

    static function main()
    {
        $t = new WriteAMessage();
        $t->GenerateMessageView();
    }
}

WriteAMessage::main();
