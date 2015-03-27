<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Boards;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Library\uuid;

class BoardsController extends Controller {

    public function index(Boards $boards)
    {
        $documents = $boards->select(DB::raw('hex(id) as id'),'category','subject','content','created_time','updated_time',DB::raw('hex(user_id) as user_id'),'hits')->get();
        return $documents;
    }

    public function info(Boards $boards,$id) {
        $document = $boards->select(DB::raw('hex(id) as id'),'category','subject','content','created_time','updated_time',DB::raw('hex(user_id) as user_id'),'hits')->where(DB::raw('hex(id)'),'=',$id)->get();
        return $document;
    }

    public function writeDocument(Boards $boards) {

        $data = Input::json();
        $id = uuid::createUUID();
        $boards->insert(
            ['id'=>  DB::raw('unhex(\''.$id.'\')'), 'category' => $data->get('category'), 'subject' => $data->get('subject'), 'content' =>$data->get('content'), 'created_time' => date("Y-m-d H:i:s") , 'updated_time'=>date("Y-m-d H:i:s"), 'user_id' =>DB::raw('unhex(\''.$data->get('user_id').'\')'), 'hits' => 0]
        );

        $document = $boards->select(DB::raw('hex(id) as id'),'category','subject','content','created_time','updated_time',DB::raw('hex(user_id) as user_id'),'hits')->where(DB::raw('hex(id)'),'=',$id)->get();;
        return $document;
    }

    public function updateDocument(Boards $boards,$id) {
        $data = Input::json();
        $content = $data->get('content');
        DB::update("update boards set content = '$content' where hex(id) = '$id'");
        $document = $boards->select(DB::raw('hex(id) as id'),'category','subject','content','created_time','updated_time',DB::raw('hex(user_id) as user_id'),'hits')->where(DB::raw('hex(id)'),'=',$id)->get();;
        return $document;
    }


	public function deleteDocument(Boards $boards,$id)
	{
            $boards->where(DB::raw('hex(id)'),'=',$id)->delete();
            return 'deleted Document';
	}


}