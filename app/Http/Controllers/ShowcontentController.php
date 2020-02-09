<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Arr;
use DB;

class ShowcontentController extends Controller
{
    public function index($content_id){
        $get_id_content= DB::table('contents')->where('content_id',$content_id)->get();
        $pluck_contenttitle_content=Arr::pluck($get_id_content,['content_title']);
        $implode_contenttitle_content = implode(" ",$pluck_contenttitle_content);
          
        $path = public_path().DIRECTORY_SEPARATOR."audios".DIRECTORY_SEPARATOR.$implode_contenttitle_content;
        $response = new BinaryFileResponse($path);
        BinaryFileResponse::trustXSendfileTypeHeader();
        return $response;
    }
}
