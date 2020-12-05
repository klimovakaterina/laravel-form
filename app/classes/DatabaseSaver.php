<?php

namespace App\Classes;

use App\Models\Feedback;

class DatabaseSaver implements  AppSaver
{
    public function save($request)
    {
        $feedback = Feedback::create($request);
        return true;
    }
}
