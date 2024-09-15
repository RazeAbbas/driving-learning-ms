<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Assessment;
use Storage;


class LessonController extends Controller
{
    private $type   =  "lesson";
    private $singular = "Lesson";
    private $plural = "Lessons";
    private $view = "admin.lessons.";
    private $db_key   =  "id";
    private $action   =  "lesson";
    private $perpage   =  10;
    private $directory  =   '\public\images/';
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search($records,$request,&$data) {
        
        /*
        SET DEFAULT VALUES
        */
        if($request->perpage)
        $this->perpage  =   $request->perpage;
        $data['sindex']     = ($request->page != NULL)?($this->perpage*$request->page - $this->perpage+1):1;
        
        /*
        FILTER THE DATA
        */
        $params = [];
        if($request->cons_id) {
            $params['cons_id'] = $request->cons_id;
            $records = $records->where("cons_id",$params['cons_id']);
        }
        if($request->is_active) {
            $params['is_active'] = $request->is_active;
            $records = $records->where("is_active",$params['is_active']);
        }
        
        $data['request'] = $params;
        return $records;
    }
    public function index(Request $request, $id)
    {
        $data = array(
            "page_title" => $this->plural." List",
            "page_heading" => $this->plural.' List',
            "breadcrumbs" => array("#" => $this->plural." List"),
            "action" => url('admin/'.$this->action.'/'.$id),
            "module" => [
                'type' => $this->type,
                'singular' => $this->singular,
                'plural' => $this->plural,
                'view' => $this->view,
                'action' => 'admin/'.$this->action,
                'db_key' => $this->db_key
            ],
            "active_module" => "lessons"
        );
        
        /*
        GET RECORDS
        */
        $records = Lesson::with('course', 'chapters')->where('course_id', $id);
        $records = $this->search($records, $request, $data);
        
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */
        $data['count'] = $records->count();
        
        /*
        PAGINATE THE RECORDS
        */
        $records = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
        
        $records['pagination'] = $links;
        
        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Lessons'] = $records;
        
        // Retrieve the lesson ID associated with the course ID
        $lesson = Lesson::where('course_id', $id)->get();
        
        // $data['lesson_id'] = $lesson->id;
        // dd($lesson);
        
        return view($this->view.'list', $data);
    }
    
    
    public function cleanData(&$data) {
        $unset = ['q','_token'];
        foreach ($unset as $value) {
            if(array_key_exists ($value,$data))  {
                unset($data[$value]);
            }
        }
        $int = ['Price'];
        foreach ($int as $value) {
            if(array_key_exists ($value,$data))  {
                $data[$value] = (int)str_replace(['(','Rs',')',' ','-','_',','], '', $data[$value]);
            }
            
        }
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create(Request $request, $id)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            // $data['created_by'] = \Auth::id();
            // if(empty($data['top'])){
                //     $data['top'] = 0;
                // }
                //image
                if ($request->hasFile('image')) {
                    $sfile=$request->file('image');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['image']=$sfilename;
                }
                $data['course_id'] = $id;
                $Lessons = new Lesson;
                $Lessons->insert($data);
                $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
                echo json_encode($response); return;
            }
            $data = array();
            $data = array(
                "page_title"=>"Add ".$this->singular,
                "page_heading"=>"Add ".$this->singular,
                "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                "action"=> url('admin/'.$this->action.'/'.$id.'/create'),
                "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$id,'db_key'=>$this->db_key]
            );
            $data['courses'] = Course::all();
            return view($this->view.'create',$data);
        }
        
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Models\Lesson  $Lesson
        * @return \Illuminate\Http\Response
        */
        public function edit(Request $request, $course_id, $id = NULL)
        {
            $data   = array();
            if($request->isMethod('post')){
                $data = $request->all();
                $this->cleanData($data);
                //image
                if ($request->hasFile('image')) {
                    $sfile=$request->file('image');
                    $sfilename=Storage::putFile('/public/upload',$sfile);
                    $data['image']=$sfilename;
                }
                $Lessons   = Lesson::find($id);
                // $data['updated_by'] = \Auth::id();
                $Lessons->update($data);
                $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
                echo json_encode($response);
                return;
            }
            // echo $id = $id; die;
            $data = array(
                "page_title"=>"Edit ".$this->singular,
                "page_heading"=>"Edit ".$this->singular,
                "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
                "action"=> url('admin/'.$this->action.'/'.$course_id.'/edit/'.$id),
                "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action.'/'.$course_id,'db_key'=>$this->db_key]
            );
            $data['row'] = Lesson::find($id)->toArray();
            $data['courses'] = Course::all();
            // echo "<pre>";print_r($data['row']);die;
            return view($this->view.'edit',$data);
        }
        
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\Models\Lesson  $Lesson
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request,$id = NULL)
        {
            if($request->input('param')){
                $data['is_active'] = $request->input('param');
                $this->cleanData($data);
                $Lessons  = Lesson::find($id);
                $Lessons->update($data);
                $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
                echo json_encode($response); return;
            }
            
        }
        
        /**
        * Remove the specified resource from storage.
        *
        * @param  \App\Models\Lesson  $Lesson
        * @return \Illuminate\Http\Response
        */
        public function delete($id) {
            $item = Lesson::find($id);
            $item->delete();
            $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
            echo json_encode($response);
            return redirect()->back();
        }
    }
    