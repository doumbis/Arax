<?php

namespace Arax\Core\Helpers;

class Lang
{

    private string $lang;
    private string $pathLang;
    private array $dictionary = [];

    public function __construct(string $lang = 'en')
    {
        $this->changeLang($lang);
    }

    public  function getMessage(string $key, $param = []): string
    {
        if (!isset($this->dictionary[$key])) {
            throw new \Exception("The key $key does not exist in the language file");
        }
        if (sizeof($param) == 0) {
            return $this->dictionary[$key];
        } else {
            $text = $this->dictionary[$key];
            foreach ($param as $name => $value) {
                $text = str_replace(':' . $name, $value, $text);
            }
            return $text;
        }
    }

    public function changeLang(string $lang)
    {
        $this->lang = $lang;
        $this->pathLang = __DIR__ . '/../../langs/' . $lang . '.json';
        $this->loadTransalations();
    }

    private function loadTransalations()
    {
        $content = file_get_contents($this->pathLang);
        if ($content === false) {
            throw new \Exception("The file $this->pathLang does not exist");
        }
        $this->dictionary =  json_decode($content, true);
    }
}
