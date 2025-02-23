<?php

namespace Arax\Core\Commands;

use Arax\Core\Helpers\Config;
use Arax\Core\Helpers\Lang;

class DbStarter
{

    public static Lang $lang;
    public static array $classesTables = [];

    public function __construct(Lang $lang)
    {
        DbStarter::$lang = $lang;
    }

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


    public static function migrate()
    {
        $directories = Config::$directoryModels;
        if (sizeof($directories) == 0) {
            $directories = [__DIR__ . '/../Models'];
        }
        $classesExluded = get_declared_classes();
        $classesExluded = array_merge($classesExluded, [
            'Arax\Core\Sql\Table',
            'Arax\Core\Sql\Database'
        ]);
        $classesModel = [];
        foreach ($directories as $directory) {
            $files = scandir($directory);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                $path = $directory . '/' . $file;
                require_once $path;

                $allClasses = get_declared_classes();
                $newClasses = array_diff($allClasses, $classesExluded);
                $classesExluded = array_merge($classesExluded, $newClasses);
                //$classesModel = array_merge($classesModel, $newClasses);
                foreach ($newClasses as $classModelAssumption) {
                    $tmpClass = new $classModelAssumption();
                    if ($tmpClass instanceof \Arax\Core\Sql\Table) {
                        $classesModel[] = $classModelAssumption;
                        $tmpClass->processDDL();
                    }
                }
            }
        }
        self::$classesTables = $classesModel;
    }
}
