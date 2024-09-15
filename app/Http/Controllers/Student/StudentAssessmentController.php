<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Assessment;
use App\Models\Reviews;
use Session;
use PDF;
use App\Models\Question;
use App\Models\Answer;
use App\Models\AssessmentResultDetail;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentResult;
use Illuminate\Support\Facades\Auth;

class StudentAssessmentController extends Controller
{
    private $type = "Assessment";
    private $singular = "Student Assessment";
    private $active = 'Assessment';
    
    public function index($id, $lesson_id){
        // dd($lesson_id);
        
        $user = Auth::user();
        $assessment = Assessment::with('questions')->where('course_id',$id)->where("lesson_id", $lesson_id)->first();
        $courses = Course::find($id);
        
        $data = array(
            "page_title" => $this->singular,
            'student' => $user,
            'assessment' => $assessment,
            'courses' => $courses,
        );
        return view('student.start-assessment', $data);
    }
    public function view_assessment($id){
        $questions = Question::where('assessment_id',$id)->get();
        $assessment = Assessment::find($id);
        
        $data = array(
            "page_title" => $this->singular,
            'assessment_id' => $id,
            'questions' => $questions,
            'assessment' => $assessment,
        );
        // dd($data);
        return view('student.assessment', $data);
    }
    
    public function question(Request $request) {
        $currentPage = $request->has('page') ? $request->page : 1;
        $questions = Question::where('assessment_id', $request->id)->with('answers')->paginate(1, ['*'], 'page', $currentPage);
        return response()->json($questions);
    }
    
    
    public function assessment(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $assessment = Assessment::with('questions', 'questions.answers')->findOrFail($id);
            
            $assessment_result = new AssessmentResult;
            $assessment_result->assessment_id = $id;
            $assessment_result->course_id = $assessment->course_id;
            $assessment_result->user_id = \Auth::id();
            $assessment_result->save();
            
            $correct = 0;
            $wrong = 0;
            $unanswered = 0;
            
            foreach ($request->questions as $key => $value) {
                if (!empty($data['answer_'.$value])) {
                    $correct_answer = Answer::where("question_id", $value)->where("is_correct", "1")->first();
                    
                    if (@$correct_answer->id == $data['answer_'.$value]) {
                        $is_correct = "1";
                        $correct++;
                    } else {
                        $is_correct = "0";
                        $wrong++;
                    }
                    
                    $assessment_result_detail = new AssessmentResultDetail;
                    $assessment_result_detail->assessment_result_id = $assessment_result->id;
                    $assessment_result_detail->question_id = $value;
                    $assessment_result_detail->answer_id = $data['answer_'.$value];
                    $assessment_result_detail->is_correct = $is_correct;
                    $assessment_result_detail->save();
                } else {
                    $unanswered++;
                    
                    $assessment_result_detail = new AssessmentResultDetail;
                    $assessment_result_detail->assessment_result_id = $assessment_result->id;
                    $assessment_result_detail->question_id = $value;
                    $assessment_result_detail->answer_id = "0";
                    $assessment_result_detail->is_correct = "0";
                    $assessment_result_detail->save();
                }
            }
            
            $percentage = ($correct / count($request->questions)) * 100;
            $status = ($percentage >= $assessment->passing_percentage) ? "Pass" : "Fail";
            
            $assessment_result->update([
                "total_questions" => count($request->questions),
                "total_correct" => $correct,
                "total_wrong" => $wrong,
                "total_unanswered" => $unanswered,
                "status" => $status,
                
            ]);
            
            return redirect()->route('show_assessment_result', $assessment_result->id);
        }
        
        $questions = Question::where('assessment_id', $id)->get();
        $assessment = Assessment::with('questions', 'questions.answers')->findOrFail($id);
        $course = Course::findOrFail($assessment->course_id);
        
        $data = [
            "page_title" => $this->singular,
            'assessment_id' => $id,
            'questions' => $questions,
            'assessment' => $assessment,
            'course' => $course,
        ];
        
        if (!Session::has("assessment_attempt_id")) {
            $assessment_attempt = new AssessmentAttempt;
            $assessment_attempt->assessment_id = $assessment->id;
            $assessment_attempt->course_id = $id;
            $assessment_attempt->user_id = \Auth::id();
            $assessment_attempt->save();
            Session::put("assessment_attempt_id", $assessment_attempt->id);
        } else {
            $attempt_id = Session::get('assessment_attempt_id');
            $assessment_attempt = AssessmentAttempt::find($attempt_id);
            
            if ($assessment_attempt && $id == $assessment_attempt->course_id) {
                $start_date = new \DateTime($assessment_attempt->created_at);
                $since_start = $start_date->diff(new \DateTime(date("Y-m-d H:i:s")));
                $minutes = $since_start->i;
                $seconds = $since_start->s / 60;
                $minutes = $minutes + $seconds;
                $assessment->time_duration -= $minutes;
                
                if ($assessment->time_duration < 0) {
                    Session::forget('assessment_attempt_id');
                }
            }
        }
        
        return view('student.assessment', $data);
    }
    
    public function showAssessmentResult($assessmentResultId)
    {
        $user = Auth::user();
        $assessmentResult = AssessmentResult::with('course')->findOrFail($assessmentResultId);
        $course = $assessmentResult->course;
        $allPassed = true;
        
        foreach ($course->lessons as $lesson) {
            foreach ($lesson->chapters as $chapter) {
                $assessment = Assessment::where('course_id', $course->id)
                ->where('lesson_id', $chapter->id)
                ->first();
                
                if ($assessment) {
                    $result = AssessmentResult::where('assessment_id', $assessment->id)
                    ->where('user_id', $user->id)
                    ->first();
                    
                    if (!$result || $result->status != 'Pass') {
                        $allPassed = false;
                        break 2;
                    }
                }
            }
        }
        
        $showCertificateButton = $allPassed;
        
        return view('student.assessment-result', [
            'assessment_result' => $assessmentResult,
            'show_certificate_button' => $showCertificateButton
        ]);
    }
    
    // public function assessment_result($id)
    // {
        //     Session::forget('assessment_attempt_id');
        //     $data = array(
            //         "page_title" => $this->singular,
            //     );
            //     $data['assessment_result'] = AssessmentResult::with('assessment_result_details', 'assessment_result_details.question', 'assessment_result_details.answer', 'course')->where("id", $id)->first();
            
            //     if (count($data['assessment_result']->assessment_result_details) > 0) {
                //         foreach ($data['assessment_result']->assessment_result_details as $key => $value) {
                    //             $correct_answer = Answer::where("question_id", $value->question->id)->where("is_correct", "1")->first();
                    //             $value->correct_answer = $correct_answer;
                    //         }
                    //     }
                    
                    //     return view('student.assessment-result',$data);
                    // }
                    public function assessment_result($id)
                    {
                        Session::forget('assessment_attempt_id');
                        $data = array(
                            "page_title" => $this->singular,
                        );
                        $data['assessment_result'] = AssessmentResult::with('assessment_result_details', 'assessment_result_details.question', 'assessment_result_details.answer', 'course')->where("id", $id)->first();
                        if (count($data['assessment_result']->assessment_result_details) > 0) {
                            foreach ($data['assessment_result']->assessment_result_details as $key => $value) {
                                $correct_answer = Answer::where("question_id", $value->question->id)->where("is_correct", "1")->first();
                                $value->correct_answer = $correct_answer;
                            }
                        }
                        // Get the authenticated user's assessment results
                        $user_assessment_results = Auth::user()->assessmentResults;
                        $total_assessment_results = 0;
                        $passed_assessments_count = 0;
                        
                        if ($user_assessment_results !== null) {
                            // Count the total number of assessment results associated with the user
                            $total_assessment_results = $user_assessment_results->count();
                            
                            // Count the number of passed assessments by the user
                            $passed_assessments_count = $user_assessment_results->where('status', 'Pass')->count();
                        }
                        // dd([
                            //     'total_assessment_results' => $total_assessment_results,
                            //     'passed_assessments_count' => $passed_assessments_count,
                            //     'user_assessment_results' => $user_assessment_results,
                            //     'show_certificate_button' => $passed_assessments_count == $total_assessment_results && $total_assessment_results > 0,
                            // ]);
                            
                            // Check if the user has passed all assessments
                            $show_certificate_button = ($total_assessment_results > 0 && $passed_assessments_count == $total_assessment_results);
                            
                            // Pass the flag indicating whether to show the certificate button to the view
                            $data['show_certificate_button'] = $show_certificate_button;
                            
                            return view('student.assessment-result',$data);
                        }
                        public function createreviews(Request $request)
                        {
                            if($request->isMethod('post')){
                                $data = $request->all();
                                $data['created_by'] = Auth::user()->id;
                                $course_id = $data['course_id'];
                                
                                // Check if the user has already reviewed this course
                                $existingReview = Reviews::where('created_by', Auth::user()->id)
                                ->where('course_id', $course_id)
                                ->first();
                                
                                // If the user has already reviewed the course, show an error
                                if ($existingReview) {
                                    $response = [
                                        'flag' => false,
                                        'msg' => 'You have already reviewed this course.',
                                    ];
                                    return response()->json($response);
                                }
                                $this->cleanData($data);
                                $CourseCategories         = new Reviews;
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
                        // public function download_certificate(Request $request, $id)
                        // {
                            //     $data['result'] = AssessmentResult::with('course', 'user')->where("id", $id)->first();
                            //     $pdf = PDF::loadView('student.certificate', $data);
                            
                            //     if ($data['result']->course->cpd_certificate == "No") {
                                //         $pdf = $pdf->setPaper('a4', 'landscape');
                                //     }
                                
                                //     // return view('student.certificate', $data);
                                //     return $pdf->download('certificate.pdf');
                                // }
                                
                                public function download_certificate(Request $request, $id)
                                {
                                    $data['result'] = AssessmentResult::with('course', 'user')->where("id", $id)->first();
                                    
                                    // Load the certificate view into PDF
                                    $pdf = PDF::loadView('student.certificate', $data);
                                    
                                    // Check if the certificate is not CPD
                                    if ($data['result']->course->cpd_certificate == "No") {
                                        // Set paper size to A4 and orientation to landscape
                                        $pdf = $pdf->setPaper('a4', 'landscape');
                                    }
                                    
                                    // Download the PDF certificate
                                    // return view('student.certificate', $data);
                                    return $pdf->download('certificate.pdf');
                                }
                                
                                
                            }
                            