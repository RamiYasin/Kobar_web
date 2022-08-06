<?php
require_once 'Page.php';

class AdminLogin extends Page
{
    protected function GetAdminData()
    {
        $news = array();
        $sql = "SELECT * FROM admin";
        $recordset = $this->db->query($sql);
        if (!$recordset) {
            throw new DBException("Fehler in Abfrage: " . $this->db->error);
        }
        while ($record = $recordset->fetch_assoc()) {

            $news[] = $record;
        }
        $recordset->free();
        // Ende Aufgabe 3a ***********************************
        return $news;
    }

    protected function AdminDatascheck()
    {
        $data = $this->GetAdminData(); // NOSONAR ignore unused $data

        // just to be sure - escape all html-values...
        for ($i = 0; $i < count($data); $i++) {
            foreach ($data[$i] as $key => $value) {
                $data[$i][$key] = htmlspecialchars($value);
            }
        }
        $this->generatePageHeader("Loginformular");
        echo <<<EOT



<body>
<div class="NAVI_bar">
  <div class="card">
    <a>log in as Admin</a>
    <a href="Angebote.php">Aktule Angebote</a>
    <a href="Belegungen.php">Meine Belegungen</a>
  </div>

  <h1>Login</h1>
  <form accept-charset="UTF-8" method="post">
  <input type="text" name="user" placeholder="Benutzername">
  <input type="password" name="password" placeholder="Passwort"><br>
  <button type="submit" name="submit" class="button">Login</button>
  </form>
</body>
</html>
EOT;
        $this->go_to_admin_site($data);

    }
    protected function go_to_admin_site(array $data){
        error_reporting(E_ALL);
        foreach($data as $row) {

            if ($_POST["user"] == $row["name"] && $_POST["password"] == $row["pass"]) {
                header('Location: AdminAddArticel.php');
                exit();

            }

        }
    }

    static function main(){
        $login=new AdminLogin();
        $login->GetAdminData();
        $login->AdminDatascheck();
    }

}
AdminLogin::main();
