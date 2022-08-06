<?php
require_once 'Page.php';
class AdminReadMessage extends Page{
    protected function GetNewsData() :array
    {
        $NewData = array();
        $sql = "SELECT * FROM message";
        $recordset = $this->db->query($sql);
        if (!$recordset) {
            throw new DBException("Fehler in Abfrage: " . $this->db->error);
        }
        while ($record = $recordset->fetch_assoc()) {

            $NewData[] = $record;
        }
        $recordset->free();
        // Ende Aufgabe 3a ***********************************
        return $NewData;
    }

    protected function GenerateViewData() :void
    {
        $data = $this->GetNewsData();
        for ($i = 0 ; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                $data[$i][$key] = htmlspecialchars($value);
            }
        }
        $this->generatePageHeader("News");

        $nextKurs = $this->GenerateNextNewSection($data);
        echo <<<EOT
<html>
<head>
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
  $nextKurs
</body>
</html>
EOT;
        $this->generatePageFooter();
    }
    protected function GenerateNextNewSection(array $data) :string
    {
        foreach ($data as $row) {
            $NewDes = $row["data"];
            $html=$html."<section>" .
                '<p>' . $NewDes . '</p>'
                . '</section>';

        }
        return $html;
    }

    static function main() :void
    {
        $new = new AdminReadMessage();
        $new->GenerateViewData();
    }
}
AdminReadMessage::main();
