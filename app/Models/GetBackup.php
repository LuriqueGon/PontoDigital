<?php

namespace App\Models;

use DateTime;
use MF\Model\DAO;

class GetBackup extends DAO
{

    protected $path = "../vendor/Config/backup";

    public function startBackup()
    {
        $tables = $this->selectAll('show tables');

        foreach ($tables as $key => $table) {
            $this->backupAll($table['Tables_in_pontodigital']);
        }
    }

    private function backupAll(String $table)
    {
        $$table = $this->getTable($table);
        $headers = $this->setHeaders($$table);

        if (!is_dir($this->path)) mkdir($this->path);

        $file = fopen("$this->path/$table.csv", "w+");
        
        fwrite($file, implode(' | ', $headers) . "\n");

        $this->setData($$table, $file);
        fclose($file);
    }

    private function getTable(String $table)
    {
        $query = "SELECT * FROM $table";
        return $this->selectAll($query);
    }

    private function setHeaders(array $array): array
    {
        
        $headers = array();
        foreach ($array[0] as $key => $value) {
            array_push($headers, ucfirst($key));
        }
        return $headers;
    }

    private function setData(array $data, $file)
    {
        
        foreach ($data as $row) {
            $data = array();

            foreach ($row as $value) {
                array_push($data, $value);
            }

            fwrite($file, implode(' | ', $data) . "\n");
        }
    }

    private function setDate($file)
    {
        $date = new DateTime();
        fwrite($file, "Backups do Dia ". $date->format('d/m/Y H:i:s')." | \n\n\n\n");
    }
}
