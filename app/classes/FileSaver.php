<?php

namespace App\Classes;

use Storage;

class FileSaver implements  AppSaver
{

    public function save($request)
    {
        $fileContent = $this->formattedDataToFile($request);
        Storage::disk('local')->append('feedback.txt', $fileContent);
        return true;
    }

    private function formattedDataToFile($data)
    {
        $fileContent = date("Y-m-d H:m:s") . ' ';
        foreach ($data as $key => $item) {
            $fileContent .= $key.": ".$item.', ';
        }
        return $fileContent.'\n';
    }
}
