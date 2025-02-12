<?php

namespace Arax\Core\Commands;

class DbStarter
{

    public static function createTable(string $modele, string $tablename, string $description = '')
    {
        $path = __DIR__ . '/model.template.txt';
        $content = file_get_contents($path);
        if ($content === false) {
            throw new \Exception("The template model $path does not exist");
        }
        $content =  str_replace(':Model', $modele, $content);
        $content =  str_replace(':tableName', $tablename, $content);
        $content =  str_replace(':description', $description, $content);
        $pathModele = __DIR__ . "/../Models/$modele.php";
        $res = file_put_contents($pathModele, $content);
    }
}
