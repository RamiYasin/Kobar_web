<?php
require_once 'Page.php';

class News extends Page
{
    protected function getVieData()
    {
        $news = array();
        $sql = "SELECT * FROM news";
        $recordest = $this->db->query($sql);
        if (!$recordest) {
            throw new DBException("Fehler in Abfrage: " . $this->db->error);
        }
        while ($record = $recordest->fetch_assoc()) {
            $news[] = $record;
        }
        $recordest->free();
        return $news;

    }

    protected function generateView()
    {
        $data = $this->getVieData();
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                $data[$i][$key] = htmlspecialchars($value);
            }
        }
        $this->generatePageHeader("Kobar");
        $nextNewSection = $this->generateNextNewSection($data);
        echo <<<EOT
<html>
<head>
<title>News</title>
<meta charset="UTF-8">

</head>
<body>
<div class="NAVI_bar">
    <div class="card">
        <a href="">Home</a>
        <a >News</a>
    </div>
</div>
   $nextNewSection
</body>
</html>
EOT;
    $this->generatePageFooter();

    }

    protected function generateNextNewSection(array $dataRows): string
    {
        foreach ($dataRows as $row) {

            $Kursname = $row["new_Name"];
            $Kursbes = $row["new_dis"];
            $html .= "" . '<section>'
                . '<h2>' . $Kursname . '</h2>'
                . '<h4>' . $Kursbes . '</h4>'
                . '</section>';


        }
        return $html;
    }

    public static function main()
    {
        $page = new News();
        $page->generateView();

    }
}

News::main();