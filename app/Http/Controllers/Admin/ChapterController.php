<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Chapter;
use Storage;
use getID3;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    private $type = "chapter";
    private $singular = "Chapter";
    private $plural = "Chapters";
    private $view = "admin.chapters.";
    private $db_key = "id";
    private $action = "chapter";
    private $perpage = 10;
    private $directory = '\public\images/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function search($records, $request, &$data)
    {

        /*
        SET DEFAULT VALUES
        */
        if ($request->perpage)
            $this->perpage = $request->perpage;
        $data['sindex'] = ($request->page != NULL) ? ($this->perpage * $request->page - $this->perpage + 1) : 1;

        /*
        FILTER THE DATA
        */
        $params = [];
        if ($request->cons_id) {
            $params['cons_id'] = $request->cons_id;
            $records = $records->where("cons_id", $params['cons_id']);
        }
        if ($request->is_active) {
            $params['is_active'] = $request->is_active;
            $records = $records->where("is_active", $params['is_active']);
        }

        $data['request'] = $params;
        return $records;
    }
    public function index(Request $request, $id, $lesson_id)
    {
        $data = array();
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action . '/' . $id . '/' . $lesson_id),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "chapters"
        );
        /*
        GET RECORDS
        */
        $records = new Chapter;
        $records = $records::with('course', 'lesson')->where('course_id', $id)->where('lesson_id', $lesson_id);
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
        // print_r($records); die;

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Chapters'] = $records;
        $data['course_id'] = $id;
        /*
        DEFAUTL VALUES
        */
        // dd($data['list']);
        // echo "<pre>"; print_r($data['list']); die();


        return view($this->view . 'list', $data);
    }
    public function cleanData(&$data)
    {
        $unset = ['q', '_token'];
        foreach ($unset as $value) {
            if (array_key_exists($value, $data)) {
                unset($data[$value]);
            }
        }
        $int = ['Price'];
        foreach ($int as $value) {
            if (array_key_exists($value, $data)) {
                $data[$value] = (int) str_replace(['(', 'Rs', ')', ' ', '-', '_', ','], '', $data[$value]);
            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Request $request, $id, $lesson_id)
    // {
    //     if ($request->isMethod('post')) {
    //         $validator = Validator::make($request->all(), [
    //             'upload_type' => ['required', Rule::in(['pdf', 'video'])],
    //             'file' => [
    //                 'required',
    //                 function ($attribute, $value, $fail) use ($request) {
    //                     if ($request->input('upload_type') === 'pdf' && !in_array($value->getClientOriginalExtension(), ['pdf'])) {
    //                         $fail('The file must be a PDF.');
    //                     }
    //                     if ($request->input('upload_type') === 'video' && !in_array($value->getClientOriginalExtension(), ['mp4'])) {
    //                         $fail('The file must be an MP4 video.');
    //                     }
    //                 },
    //             ],
    //         ]);
    //         if ($validator->fails()) {
    //             $response = [
    //                 'flag' => false,
    //                 'msg' => $validator->errors()->first(),
    //             ];
    //             echo json_encode($response);
    //             return;
    //         }

    //         $data = $request->all();

    //         $this->cleanData($data);
    //         //image
    //         if ($request->hasFile('file')) {
    //             $sfile = $request->file('file');
    //             $course_name = Course::find($id)->course_name;
    //             if ($data['upload_type'] == "video") {
    //                 $sfile = $request->file('file');
    //                 $sfilename = $sfile->store('courses/video/' . $course_name, 'public');
    //                 $data['file'] = 'storage/' . $sfilename;
    //             } else if ($data['upload_type'] == "pdf") {
    //                 $sfile = $request->file('file');
    //                 $sfilename = $sfile->store('courses/pdf/' . $course_name, 'public');
    //                 $data['file'] = 'storage/' . $sfilename;
    //             }

    //             $data['duration'] = 0;
    //         }
    //         $data['course_id'] = $id;
    //         $data['lesson_id'] = $lesson_id;
    //         $Chapter = new Chapter;
    //         $Chapter->insert($data);
    //         $response = array('flag' => true, 'msg' => $this->singular . ' is added sucessfully.', 'action' => 'reload');
    //         echo json_encode($response);
    //         return;
    //     }
    //     $data = array();
    //     $data = array(
    //         "page_title" => "Add " . $this->singular,
    //         "page_heading" => "Add " . $this->singular,
    //         "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
    //         "action" => url('admin/' . $this->action . '/' . $id . '/' . $lesson_id . '/create'),
    //         "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action . '/' . $id . '/' . $lesson_id, 'db_key' => $this->db_key]
    //     );
    //     $data['courses'] = Course::all();
    //     $data['lessons'] = Lesson::where("course_id", $id)->get();

    //     return view($this->view . 'create', $data);
    // }
    public function create(Request $request, $id, $lesson_id)
    {
        if ($request->isMethod('post')) {
            
            // $validator = Validator::make($request->all(), [
            //     'upload_type' => ['required', Rule::in(['pdf', 'video'])],
            //     'file' => [
            //         'required',
            //         function ($attribute, $value, $fail) use ($request) {
            //             if ($request->input('upload_type') === 'pdf' && !in_array($value->getClientOriginalExtension(), ['pdf'])) {
            //                 $fail('The file must be a PDF.');
            //             }
            //             if ($request->input('upload_type') === 'video' && !in_array($value->getClientOriginalExtension(), ['mp4'])) {
            //                 $fail('The file must be an MP4 video.');
            //             }
            //         },
            //     ],
            // ]);
            // if ($validator->fails()) {
            //     $response = [
            //         'flag' => false,
            //         'msg' => $validator->errors()->first(),
            //     ];
            //     echo json_encode($response);
            //     return;
            // }

            $data = $request->all();

            $this->cleanData($data);
            //image
            // if ($request->hasFile('file')) {
            //     $sfile = $request->file('file');
            //     $course = Course::find($id);
            //    $course_name = $course->course_name;
               
            //     if ($data['upload_type'] == "video") {
            //         $sfile = $request->file('file');
            //         $sfilename = $sfile->store('courses/video/' . $course_name, 'public');
            //         $data['file'] = 'storage/' . $sfilename;
            //         $duration = $this->getVideoDuration(storage_path('app/public/' . $sfilename));
            //         $data['duration'] = $duration;
            //         $course = Course::find($id);
            //         $course_duration = $course->course_duration + $duration;
            //         $course->update(['course_duration' => $course_duration]);
            //     } else if ($data['upload_type'] == "pdf") {
            //         $sfile = $request->file('file');
            //         $sfilename = $sfile->store('courses/pdf/' . $course_name, 'public');
            //         $data['file'] = 'storage/' . $sfilename;
            //     }
            // }
            $data['course_id'] = $id;
            $data['lesson_id'] = $lesson_id;
            $Chapter = new Chapter;
            $Chapter->insert($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is added sucessfully.', 'action' => 'reload');
            echo json_encode($response);
            return;
        }
        $data = array();
        $data = array(
            "page_title" => "Add " . $this->singular,
            "page_heading" => "Add " . $this->singular,
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action . '/' . $id . '/' . $lesson_id . '/create'),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action . '/' . $id . '/' . $lesson_id, 'db_key' => $this->db_key]      
        );
        $data['courses'] = Course::all();
        $data['lessons'] = Lesson::where("course_id", $id)->get();

        return view($this->view . 'create', $data);
    }
    public function getVideoDuration($filePath)
    {
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($filePath);

        if (isset($fileInfo['playtime_seconds'])) {
            $duration = $fileInfo['playtime_seconds'];
            return $duration;
        } else {
            return null; // or handle the case when duration is not available
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chapter  $Chapter
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $course_id, $lesson_id, $id = NULL)
    {
        $data = array();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->cleanData($data);
            //image
            if ($request->hasFile('file')) {
                $sfile = $request->file('file');
                $course_name = Course::find($id)->course_name;
                if ($data['upload_type'] == "video") {
                    $sfile = $request->file('file');
                    $sfilename = $sfile->store('courses/video/' . $course_name, 'public');
                    $data['file'] = 'storage/' . $sfilename;
                } else if ($data['upload_type'] == "pdf") {
                    $sfile = $request->file('file');
                    $sfilename = $sfile->store('courses/pdf/' . $course_name, 'public');
                    $data['file'] = 'storage/' . $sfilename;
                }
                $data['duration'] = 0;
            }

            $Chapter = Chapter::find($id);
            $Chapter->update($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is updated sucessfully.', 'action' => 'reload');
            echo json_encode($response);
            return;
        }
        $data = array(
            "page_title" => "Edit " . $this->singular,
            "page_heading" => "Edit " . $this->singular,
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action . '/' . $course_id . '/' . $lesson_id . '/edit/' . $id),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action . '/' . $course_id . '/' . $lesson_id, 'db_key' => $this->db_key]
        );
        $data['row'] = Chapter::find($id)->toArray();
        $data['courses'] = Course::all();
        $data['lessons'] = Lesson::where("course_id", $course_id)->get();

        return view($this->view . 'edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chapter  $Chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = NULL)
    {
        if ($request->input('param')) {
            $data['is_active'] = $request->input('param');
            $this->cleanData($data);
            $Lessons = Chapter::find($id);
            $Lessons->update($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is updated sucessfully.');
            echo json_encode($response);
            return;
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chapter  $Chapter
     * @return \Illuminate\Http\Response
     */

     public function delete($course_id, $lesson_id, $id)
    {
        $item = Chapter::find($id);
        $course = Course::find($course_id);
        $course_duration = $course->course_duration - $item->duration;
        $course->update(['course_duration'=>$course_duration]);
        $item->delete();
        $response = array('flag' => true, 'msg' => $this->singular . ' has been deleted.');
        echo json_encode($response);
        return;
        // return redirect()->back()->with('success','Chapter deleted successfully');
    }
    // public function delete($id)
    // {
    //     // dd($id);
    //     $item = Chapter::find($id);
    //     $item->delete();
    //     $response = array('flag' => true, 'msg' => $this->singular . ' has been deleted.');
    //     echo json_encode($response);
    //     return;
    // }

    public function upload_subtitle(Request $request, $id)
    {
        $data = array();

        if ($request->isMethod('post')) {
            $data = $request->all();
            $this->cleanData($data);

            $chapter = Chapter::where("id", $id)->first();
            //image
            if ($request->hasFile('file')) {
                $sfile = $request->file('file');
                $file_content = file_get_contents($sfile);

                if (!empty ($file_content)) {
                    $curl = curl_init();

                    curl_setopt_array(
                        $curl,
                        array(
                            CURLOPT_URL => 'https://api.vimeo.com' . $chapter->vimeo_id . '/texttracks',
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => '',
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => 'POST',
                            CURLOPT_POSTFIELDS => '{"name": "Subtitle Track", "language": "' . $data['language'] . '", "type": "subtitles", "active": true}',
                            CURLOPT_HTTPHEADER => array(
                                'Authorization: Bearer d9ea76aff38896a351a7a5d375715e94',
                                'Content-Type: application/json'
                            ),
                        )
                    );

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $response = json_decode($response);

                    if (!empty ($response->link)) {
                        $curl = curl_init();

                        curl_setopt_array(
                            $curl,
                            array(
                                CURLOPT_URL => $response->link,
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'PUT',
                                CURLOPT_POSTFIELDS => $file_content,
                                CURLOPT_HTTPHEADER => array(
                                    'Authorization: Bearer d9ea76aff38896a351a7a5d375715e94',
                                    'Content-Type: text/vtt'
                                ),
                            )
                        );

                        $response = curl_exec($curl);

                        curl_close($curl);

                        $response = array('flag' => true, 'msg' => $this->singular . ' is updated sucessfully.', 'action' => 'reload');
                        echo json_encode($response);
                        return;
                    } else {
                        $response = array('flag' => false, 'msg' => 'Something went wrong!');
                        echo json_encode($response);
                        return;
                    }
                } else {
                    $response = array('flag' => false, 'msg' => 'Something went wrong!');
                    echo json_encode($response);
                    return;
                }
            }
        }
        // echo $id = $id; die;
        $data = array(
            "page_title" => "Upload Subtitle",
            "page_heading" => "Upload Subtitle",
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => "Upload Subtitle"),
            "action" => url('admin/upload-subtitle/' . $id),
            "module" => ['type' => 'upload-subtitle', 'singular' => 'Upload Subtitle', 'plural' => 'Upload Subtitle', 'view' => $this->view, 'action' => 'admin/upload-subtitle/' . $id, 'db_key' => $this->db_key],
            "active_module" => "courses"
        );

        $chapter = Chapter::where("id", $id)->first();

        if (!empty ($chapter->vimeo_id)) {
            $curl = curl_init();

            curl_setopt_array(
                $curl,
                array(
                    CURLOPT_URL => 'https://api.vimeo.com' . $chapter->vimeo_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer d9ea76aff38896a351a7a5d375715e94',
                        'Cookie: __cf_bm=xGcIeJ3eyvMK_WJQjiiSQx53B3JLUqgLfMDioJndOGo-1704718745-1-AeGhWQzrVFFxODTr/hgf5ew/bg43GI3qtQlP+I7LOmcJt+0zp6UNpw6OMjVcbhmAzPY7MMRiy7z4o0lFePhB1Fs='
                    ),
                )
            );

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response);

            $data['is_playable'] = "0";
            if (!empty ($response->is_playable)) {
                if ($response->is_playable) {
                    $data['is_playable'] = "1";
                }
            }
        } else {
            $data['is_playable'] = "0";
        }
        $data['chapter'] = $chapter;
        // echo "<pre>";print_r($data['row']);die;
        return view($this->view . 'upload-subtitle', $data);
    }
}
