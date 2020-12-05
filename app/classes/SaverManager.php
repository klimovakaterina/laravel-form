<?php

namespace App\Classes;

use App\Classes\DatabaseSaver;
use App\Classes\FileSaver;

class SaverManager
{
    private $saverName;

    private $availableSaver = [
        'DatabaseSaver' => DatabaseSaver::class,
        'FileSaver' => FileSaver::class,
    ];


    public function __construct($saverName)
    {
        $this->saverName = $saverName;

    }

    public function getSaver()
    {
        if (array_key_exists($this->saverName, $this->availableSaver)) {
            return  new $this->availableSaver[$this->saverName];
        } else {
            return new DatabaseSaver();
        }
    }

}
