<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;

class AssessmentController extends Controller
{
    private $type   =  "assessment";
    private $singular = "Assessment";
    private $plural = "Assessments";
    private $view = "admin.assessments.";
    private $db_key   =  "id";
    private $action   =  "assessment";
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
    public function index(Request $request)
    {
        $data   = array();
        $data   = array(
            "page_title"=>$this->plural." List",
            "page_heading"=>$this->plural.' List',
            "breadcrumbs"=>array("#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key],
            "active_module" => "assessments"
        );
        /*
        GET RECORDS
        */
        $records = new Assessment;
        $records = $records::with('course');
        $records = $this->search($records,$request,$data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */
        
        $data['count']      = $records->count();
        
        /*
        PAGINATE THE RECORDS
        */
        $records            = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
        // print_r($records); die;
        
        $records['pagination'] = $links;
        
        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Assessments']   =   $records;
        /*
        DEFAUTL VALUES
        */        
        // dd($data['list']);
        // echo "<pre>"; print_r($data['list']); die();
        
        
        return view($this->view.'list',$data);
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
    public function create(Request $request)
    {
        if($request->isMethod('post')){
            // dd($request);
            $data = $request->all();
            $this->cleanData($data);
            $data['created_by'] = \Auth::id();
            
            // Image handling
            if ($request->hasFile('image')) {
                $sfile = $request->file('image');
                $sfilename = Storage::putFile('/public/upload', $sfile);
                $data['image'] = $sfilename;
            }
            
            // Check if assessment for this lesson already exists
            $check = Assessment::where('lesson_id', $data['lesson_id'])->count();
            if ($check > 0) {
                $response = array('flag' => false, 'msg' => 'Assessment for this lesson already exists!');
                echo json_encode($response);
                return;
            }
            
            // Insert new assessment
            $assessment = new Assessment;
            $assessment->fill($data);
            $assessment->save();
            
            $response = array('flag' => true, 'msg' => $this->singular.' is added successfully.', 'action' => 'reload');
            echo json_encode($response);
            return;
        }
        
        $data = array(
            "page_title" => "Add ".$this->singular,
            "page_heading" => "Add ".$this->singular,
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural." List"),
            "action" => url('admin/'.$this->action.'/create'),
            "module" => array('type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/'.$this->action, 'db_key' => $this->db_key)
        );
        
        $data['courses'] = Course::all();
        $data['course_id'] = $request->course_id;
        $data['lesson_id'] = $request->lesson_id;
        $data['chapters'] = Chapter::all();
        
        return view($this->view.'create', $data);
    }
    
    
    public function fetchChapters(Request $request)
    {
        $courseId = $request->course_id;
        $chapters = Chapter::where('course_id', $courseId)->get();
        return response()->json($chapters);
    }
    
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Assessment  $Assessment
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request, $id = NULL)
    {
        $data = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            //image 
            if ($request->hasFile('image')) {
                $sfile=$request->file('image');
                $sfilename=Storage::putFile('/public/upload',$sfile);
                $data['image']=$sfilename;
            }
            
            // Check if 'lesson_id' exists in the $data array
            if (!isset($data['lesson_id'])) {
                // Handle the error here, such as returning an error response
                $response = array('flag' => false, 'msg' => 'Lesson ID is missing!');
                echo json_encode($response); return;
            }
            
            // Proceed with your assessment update logic
            $check = Assessment::where("lesson_id", $data['lesson_id'])->where("id", "!=", $id)->first();
            if ($check) {
                $response = array('flag'=>false,'msg'=>'Assessment for this course is already exists!');
                echo json_encode($response); return;
            }
            $Assessment   = Assessment::find($id);
            // $data['updated_by'] = \Auth::id();
            $Assessment->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response); 
            return;
        }
        // Load the edit form view
        $data = array(
            "page_title"=>"Edit ".$this->singular,
            "page_heading"=>"Edit ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/edit/'.$id),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
        );
        $data['row'] = Assessment::find($id)->toArray();
        $data['courses'] = Course::all();
        // Return the edit form view
        return view($this->view.'edit',$data);
    }
    
    
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Assessment  $Assessment
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');        
            $this->cleanData($data);
            $Assessments  = Assessment::find($id);
            $Assessments->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Assessment  $Assessment
    * @return \Illuminate\Http\Response
    */
    public function delete($id) {
        $item = Assessment::find($id);
        $item->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
        echo json_encode($response); return redirect(url('admin/assessment'));
    }
}
