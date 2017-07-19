<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class IndexController extends Controller
{
//    验证token
    public function checkToken(Request $request)
    {
        $signature = $request->input("signature");
        $timestamp = $request->input("timestamp");
        $nonce = $request->input("nonce");
        $echostr=$request->input("echostr");

        $token = getenv('WXCHECK_TOKEN');
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            return $echostr;
        } else {
            return 0;
        }
    }

//    保存对话
    public function saveChat(Request $request){
        $req=$request->all();
        file_put_contents("temp_chat.log", "This is all.".json_encode($req).PHP_EOL, FILE_APPEND);
        return 'success';
    }
}
