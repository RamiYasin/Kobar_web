<?php
require_once 'Page.php';

class NewsDataView extends Page
{
    protected function GetNewsData() :array
    {
        $NewData = array();
        $sql = "SELECT * FROM news";
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
            $NewTitel = $row["new_Name"];
            $NewDes = $row["new_dis"];
            $html=$html."<section>" .
                '<h1>' . $NewTitel . '</h1>' .
                '<p>' . $NewDes . '</p>'
                . '</section>';

        }
        return $html;
    }

    static function main() :void
    {
        $new = new NewsDataView();
        $new->GenerateViewData();
    }
}

NewsDataView::main();
