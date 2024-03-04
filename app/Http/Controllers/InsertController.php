<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ai_analysis_log;
use Illuminate\Support\Facades\DB;

class InsertController extends Controller
{
    
    public function insert($insertData)
    {
        $param = [
            'image_path' => $insertData['image_path'],
            'success' => $insertData['success'],
            'message' => $insertData['message'],
            'class' => $insertData['class'],
            'confidence' => $insertData['confidence'],
            'request_timestamp' => $insertData['request_timestamp'],
            'response_timestamp' => $insertData['response_timestamp'],
        ];
        DB::insert('insert into ai_analysis_log(image_path,success,message,class,confidence,request_timestamp,response_timestamp) 
                                        values (:image_path,:success,:message,:class,:confidence,:request_timestamp,:response_timestamp)', $param);

        return redirect("/create");
    
    }

}
