<?php

namespace Arax\Core\Helpers;

class Config
{
    // all properties will be in static for speed purpose

    public static array $drivers = [
        // 'connectionName' => ['driver' => 'mysql', 'host' => 'localhost', 'database' => 'test] config
    ];

    public static string $defaultConnection = 'mysql';
    public static array $directoryModels = [];

    private static Lang $lang;

    public static function readConfigFile(string $path, Lang $lang)
    {
        self::$lang = $lang;
        $content = file_get_contents($path);
        if ($content === false) {
            throw new \Exception(self::$lang->getMessage('configfileormnotfound', ['path' => $path]));
        }
        $config = json_decode($content, true);
        if ($config === null) {
            throw new \Exception(self::$lang->getMessage('invalidDecodeConfigFileJson', ['path' => $path]));
        }
        if (!isset($config['connections'])) {
            throw new \Exception(self::$lang->getMessage('connectionsConfigNotFound', ['path' => $path]));
        }
        self::$defaultConnection = isset($config['defaultConnection']) ?  $config['defaultConnection'] : self::$defaultConnection;
        self::$drivers = $config['connections'];
        self::$directoryModels = isset($config['migrations']['directories']) ? $config['migrations']['directories'] : [];
    }
}
