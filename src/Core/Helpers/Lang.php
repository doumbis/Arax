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

    public  function getMessage(string $key): string
    {
        if (!isset($this->dictionary[$key])) {
            throw new \Exception("The key $key does not exist in the language file");
        }
        return $this->dictionary[$key];
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
