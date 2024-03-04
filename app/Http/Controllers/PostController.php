<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\InsertController;

class PostController extends Controller
{

    public function send(Request $request)
    {
        $client = new Client();

        $method = "POST";
        $url = 'http://example.com/';

        $data = array(
            "image_path" => url('/'). $request->image_path
        );
        $options = [
            'json' => $data,
            'headers' => [
                'Content-Type' => 'application/json',
            ]
        ];

        $request_timestamp = time();
        $response = $client->request($method, $url, $options);
        $response_timestamp = time();

        $post = $response->getBody();
        $post = json_decode($post, true);

// //実APIリクエスト時
//         $success = $post['success'] == true ? 'true':'false';
//         $message = $post['message'];
//         $estimated_data = $post['estimated_data'];

//APIダミー（成功時）
        $success = true ? 'true':'false';
        $message = 'success';
        $estimated_data = array('class' => '3','confidence' => '0.8683');

// //APIダミー（失敗時）
//         $success = false ? 'true':'false';
//         $message = 'Error:E50012';
//         $estimated_data = [];

        $insertData = array('image_path' => str_replace(url('/'), '', $data['image_path']), 
                            'success' => $success, 'message' => $message);
        if ($success == 'true') {
            $insertData += array('class' => $estimated_data['class'], 'confidence' => $estimated_data['confidence'], 
                                 'request_timestamp' => $request_timestamp, 'response_timestamp' => $response_timestamp);
        } else {
            $insertData += array('class' => null, 'confidence' => null, 
                                 'request_timestamp' => $request_timestamp, 'response_timestamp' => $response_timestamp);
        }

        $insertController = new InsertController();
        $insertController->insert($insertData);

        return redirect('/ai_analysis')->with('flash_message', $insertData['image_path'] . ' を解析しました')
                                       ->with('success', $insertData['success'] == 'true' ? '成功' : '失敗')
                                       ->with('message',$insertData['message'])
                                       ->with('class',$insertData['class'])
                                       ->with('confidence',$insertData['confidence']);
    }
}