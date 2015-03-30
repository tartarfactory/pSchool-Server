<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Studies;
use DB;
use Illuminate\Support\Facades\Input;
use App\Library\uuid;
use Illuminate\Http\Request;

class StudiesController extends Controller {


    public function findMultiResult (Studies $studies) {
        $multiResult = $studies->select(DB::raw('hex(id) as id'),'name','created_at','updated_at')->get();
        return $multiResult;
    }

    public function findSingleResult(Studies $studies, $id) {
        $singleResult = $studies->select(DB::raw('hex(id) as id'),'name','created_at','updated_at')->where(DB::raw('hex(id)'),'=',$id)->get();
        return $singleResult;
    }

    public function inputStudy(Studies $studies) {
        $data = Input::Json();
        $id = uuid::createUUID();
        $now = date("Y-m-d H:i:s");
        $studies->insert(
            ['id'=>DB::raw('unhex(\''.$id.'\')'),'name'=>$data->get('name'),'created_at'=>$now,'updated_at'=>$now]
        );
        return StudiesController::findSingleResult($studies,$id);
    }

    public function deleteStudy(Studies $studies, $id) {
        $studies->where(DB::raw('hex(id)'),'=',$id)->delete();
        return 'deletedStudy';
    }

    public function modificationStudy(Studies $studies, $id) {

        $data = Input::Json();
        $studies->where(DB::raw('hex(id)'),'=',$id)->update(
            ['name' => $data->get('name')]
        );
        return StudiesController::findSingleResult($studies,$id);
    }

}
