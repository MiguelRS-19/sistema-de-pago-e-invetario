<?php
include_once 'Conexion.php';

class Backup
{
    private $acceso;

    public function __construct()
    {
        $db = new Conexion();
        $this->acceso = $db->pdo;
    }

    /**
     * @function    backupDatabase
     * @link        http://www.codexworld.com
     * @usage       Backup database tables and save in SQL file
     */
    public function backupDatabase($servidor, $usuario, $contrasena, $dbname, $tables = '*')
    {
        $db = new mysqli($servidor, $usuario, $contrasena, $dbname);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        if ($tables == '*') {
            $tables = array();
            $result = $db->query("SHOW TABLES");
            while ($row = $result->fetch_row()) {
                $tables[] = $row[0];
            }
        } else {
            $tables = is_array($tables) ? $tables : explode(',', $tables);
        }

        $return = '';

        foreach ($tables as $table) {
            $return .= "DROP TABLE IF EXISTS $table;\n";
            $result2 = $db->query("SHOW CREATE TABLE $table");
            $row2 = $result2->fetch_row();
            $return .= $row2[1] . ";\n";

            $result = $db->query("SELECT * FROM $table");
            while ($row = $result->fetch_assoc()) {
                $row = array_map('addslashes', $row);
                $row = array_map('htmlspecialchars', $row);
                $return .= "INSERT INTO $table VALUES('" . implode("', '", $row) . "');\n";
            }

            $return .= "\n";
        }

        date_default_timezone_set('America/Lima');
        //$fecha_actual = date('d-m-Y');
        // Save to file
        $backupFileName = 'db-backup-' . date('Y-m-d_H-i-s') . '.sql';
        $backupFilePath = "../database/" . $backupFileName;
        $handle = fopen($backupFilePath, 'w+');
        fwrite($handle, $return);
        fclose($handle);

        $db->close();
        return $backupFilePath;
    }
}

