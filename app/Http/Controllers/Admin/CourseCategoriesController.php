<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Categories;
use Storage;
use Illuminate\Support\Facades\File;

class CourseCategoriesController extends Controller
{
    private $type   =  "coursecategories";
    private $singular = "CourseCategory";
    private $plural = "CourseCategories";
    private $view = "admin.coursecategories.";
    private $db_key   =  "id";
    private $action   =  "course-categories";
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
            "active_module" => "course_categories"
        );
        /*
        GET RECORDS
        */
        $records   = new Categories;
        // $records   = $records::with('accessoryType');
        $records   = $this->search($records,$request,$data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */
        
        $data['count']  = $records->count();
        
        /*
        PAGINATE THE RECORDS
        */
        $records = $records->paginate($this->perpage);
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();
        // print_r($records); die;
        
        $records['pagination'] = $links;
        
        /*
        ASSIGN DATA FOR VIEW
        */
        $data['CourseCategories']   =   $records;
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
            $data = $request->all();
            $this->cleanData($data);
            $data['created_by'] = \Auth::id();
            if(empty($data['top'])){
                $data['top'] = 0;
            }
            //image
            if ($request->hasFile('image')) {
                $sfile=$request->file('image');
                $sfilename=Storage::putFile('/public/upload',$sfile);
                $data['image']=$sfilename;
            }
            $CourseCategories         = new Categories;
            $CourseCategories->insert($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is added sucessfully.','action'=>'reload');
            echo json_encode($response); return;
        }
        $data   = array();
        $data   = array(
            "page_title"=>"Add ".$this->singular,
            "page_heading"=>"Add ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/create'),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
        );
        return view($this->view.'create',$data);
    }
    
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\CourseCategories  $CourseCategories
    * @return \Illuminate\Http\Response
    */
    public function edit(Request $request,$id = NULL)
    {
        $data   = array();
        if($request->isMethod('post')){
            $data = $request->all();
            $this->cleanData($data);
            if(empty($data['top'])){
                $data['top'] = 0;
            }
            //image
            if ($request->hasFile('image')) {
                $sfile=$request->file('image');
                $sfilename=Storage::putFile('/public/upload',$sfile);
                $data['image']=$sfilename;
            }
            $CourseCategories   = Categories::find($id);
            // $data['updated_by'] = \Auth::id();
            $CourseCategories->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.','action'=>'reload');
            echo json_encode($response);
            return;
        }
        // echo $id = $id; die;
        $data   = array(
            "page_title"=>"Edit ".$this->singular,
            "page_heading"=>"Edit ".$this->singular,
            "breadcrumbs"=>array("dashboard"=>"Dashboard","#"=>$this->plural." List"),
            "action"=> url('admin/'.$this->action.'/edit/'.$id),
            "module"=>['type'=>$this->type,'singular'=>$this->singular,'plural'=>$this->plural,'view'=>$this->view,'action'=>'admin/'.$this->action,'db_key'=>$this->db_key]
        );
        $data['row']      = Categories::find($id)->toArray();
        // echo "<pre>";print_r($data['row']);die;
        return view($this->view.'edit',$data);
    }
    
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\CourseCategories  $CourseCategories
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id = NULL)
    {
        if($request->input('param')){
            $data['is_active'] = $request->input('param');
            $this->cleanData($data);
            $CourseCategories  = Categories::find($id);
            $CourseCategories->update($data);
            $response = array('flag'=>true,'msg'=>$this->singular.' is updated sucessfully.');
            echo json_encode($response); return;
        }
        
    }
    
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\CourseCategories  $CourseCategories
    * @return \Illuminate\Http\Response
    */
    public function delete($id) {
        
        $category = Categories::find($id);
        $courses = Course::where('cat_id',$category->id)->get();
        foreach($courses as $course){
            $filePaths = [
                public_path('storage/upload/' . $course->featured_img),
                public_path('storage/upload/370x250-' . $course->featured_img),
                public_path('storage/upload/298x200-' . $course->featured_img),
                public_path('storage/upload/270x200-' . $course->featured_img),
                public_path('storage/upload/198x200-' . $course->featured_img),
                public_path('storage/upload/110x110-' . $course->featured_img),
                public_path($course->certificate),
                public_path($course->featured_video),
            ];
            foreach ($filePaths as $filePath) {
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
            $course->delete();
        }
        $category->delete();
        $response = array('flag'=>true,'msg'=>$this->singular.' has been deleted.');
        echo json_encode($response); return;
    }
}
