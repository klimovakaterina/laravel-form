<?php

namespace App\Http\Controllers;

use App\Classes\SaverManager;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    private $saved = array();

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'feedback' => 'required',
        ]);


        if (!empty($request)){
            foreach (SAVER_METHODS as $saverMethod) {
                $factory = new SaverManager($saverMethod);
                $factoryClass = $factory->getSaver();
                $this->saved[$saverMethod] = $factoryClass->save($request->all());
            }

            if (!in_array(false, $this->saved)) return true;
        }
        return false;
    }

    public function index(){
        $feedbacks = Feedback::orderBy('created_at', 'DESC')->get();
        return view('welcome', compact('feedbacks'));
    }

}
