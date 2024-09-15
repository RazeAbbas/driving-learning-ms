<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\AssessmentResult;
use App\Models\Assessment;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\OrderItem;
use App\Models\CourseProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $type = "Course";
    private $singular = "Student Course";
    private $plural = "Student Courses";
    private $active = "enrolled_courses";
    
    // public function index()
    // {
        //     $user = Auth::user();
        //     $enrolledCourses = Course::join('order_items', 'courses.id', '=', 'order_items.course_id')
        //     ->where('order_items.created_by', $user->id)
        //     ->select('courses.*', 'order_items.progress')
        //     ->get();
        //     $data = array(
            //         "page_title" => $this->plural,
            //         'course_count' => $user->orderItems->count(),
            //         "enrolled_courses" => $enrolledCourses,
            //         'student' => $user,
            //         'active' => $this->active,
            //     );
            //     return view('student.courses', $data);
            // }
            public function index()
            {
                $user = Auth::user();
                $enrolledCourses = Course::join('order_items', 'courses.id', '=', 'order_items.course_id')
                ->where('order_items.created_by', $user->id)
                ->select('courses.*', 'order_items.progress')
                ->get();
                
                foreach ($enrolledCourses as $course) {
                    $course->progress = $this->calculateProgress($course, $user);
                    $course->isCompleted = $this->isCompleted($course, $user);
                    // dd($course->progress);
                }
                
                $data = array(
                    "page_title" => $this->plural,
                    'course_count' => $user->orderItems->count(),
                    "enrolled_courses" => $enrolledCourses,
                    'student' => $user,
                    'active' => $this->active,
                );
                // dd($data);
                return view('student.courses', $data);
            }
            private function calculateProgress($course, $user)
            {
                $totalAssessments = $course->lessons->count(); // Assuming each lesson is an assessment
                
                if ($totalAssessments == 0) {
                    return 0; // If no assessments, progress is 0%
                }
                
                $completedAssessments = 0;
                
                foreach ($course->lessons as $lesson) {
                    foreach ($lesson->chapters as $chapter) {
                        $assessment = Assessment::where('course_id', $course->id)
                        ->where('lesson_id', $chapter->id)
                        ->first();
                        
                        if ($assessment) {
                            $result = AssessmentResult::where('assessment_id', $assessment->id)
                            ->where('user_id', $user->id)
                            ->first();
                            
                            if ($result && $result->status == 'Pass') {
                                $completedAssessments++;
                            }
                        }
                    }
                }
                
                return ($completedAssessments / $totalAssessments) * 100;
            }
            private function isCompleted($course, $user)
            {
                $totalAssessments = $course->lessons->count(); // Assuming each lesson is an assessment
                $completedAssessments = 0;
                
                foreach ($course->lessons as $lesson) {
                    foreach ($lesson->chapters as $chapter) {
                        $assessment = Assessment::where('course_id', $course->id)
                        ->where('lesson_id', $chapter->id)
                        ->first();
                        
                        if ($assessment) {
                            $result = AssessmentResult::where('assessment_id', $assessment->id)
                            ->where('user_id', $user->id)
                            ->first();
                            
                            if ($result && $result->status == 'Pass') {
                                $completedAssessments++;
                            }
                        }
                    }
                }
                
                return $completedAssessments == $totalAssessments;
            }
            public function checkCourseCompletion($courseId, $userId) {
                $course = Course::find($courseId);
                $allPassed = true;
                
                foreach ($course->lessons as $lesson) {
                    foreach ($lesson->chapters as $chapter) {
                        $assessment = Assessment::where('course_id', $courseId)
                        ->where('lesson_id', $chapter->id)
                        ->first();
                        
                        if ($assessment) {
                            $result = AssessmentResult::where('assessment_id', $assessment->id)
                            ->where('user_id', $userId)
                            ->first();
                            
                            if (!$result || $result->status != 'Pass') {
                                $allPassed = false;
                                break 2;
                            }
                        }
                    }
                }
                
                return $allPassed;
            }
            
            
            
            public function watch($id) {
                $user = Auth::user();
                $course = Course::find($id);
                $first_video = "";
                $first_chapter_id = "";
                $first_chapter_detail = "";
                $chapter_name = "";
            
                $orderItem = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.created_by', $user->id)
                    ->where('order_items.course_id', $id)
                    ->select('order_items.*')
                    ->first();
            
                $allPassed = true;
                $assessmentResults = [];
            
                foreach ($course->lessons as $lesson) {
                    foreach ($lesson->chapters as $chapter) {
                        $assessment = Assessment::where('course_id', $id)->where('lesson_id', $chapter->id)->first();
                        $result = AssessmentResult::where('assessment_id', optional($assessment)->id)->where('user_id', $user->id)->first();
            
                        if ($result) {
                            $assessmentResults[] = $result; // Collect all assessment results
                            if ($result->status == 'Fail') {
                                $first_chapter_detail = $chapter->description;
                                $chapter_name = $chapter->chapter_name;
                                $allPassed = false;
                                break 2;
                            }
                        } else {
                            $first_chapter_detail = $chapter->description;
                            $chapter_name = $chapter->chapter_name;
                            $allPassed = false;
                            break 2;
                        }
                    }
                }
            
                $data = array(
                    "page_title" => "Course Details",
                    "course" => $course,
                    'first_video' => $first_video,
                    'first_chapter_id' => $first_chapter_id,
                    'chapter_name' => $chapter_name,
                    'first_chapter_detail' => $first_chapter_detail,
                    'order_item' => $orderItem,
                    'user' => $user,
                    'allPassed' => $allPassed,
                    'assessmentResults' => $assessmentResults, // Pass assessment results to the view
                );
            
                return view('student.course-details', $data);
            }
            
            
            
            // public function watch($id){
                //     $user = Auth::user();
                //     $course = Course::find($id);
                //     $orderItem = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                //                             ->where('orders.created_by', $user->id)
                //                             ->where('order_items.course_id', $id)
                //                             ->select('order_items.*')
                //                             ->first();
                
                //     $first_chapter_detail = "";
                //     $chapter_name = "";
                
                //     foreach ($course->lessons as $lesson) {
                    //         foreach ($lesson->chapters as $chapter) {
                        //             // Fetch the assessment directly related to the chapter
                        //             $assessment = Assessment::where('course_id', $id)
                        //                                     ->where('lesson_id', $chapter->id)
                        //                                     ->first();
                        //             // If the assessment exists, fetch the corresponding assessment result for the user
                        //             if ($assessment) {
                            //                 $result = $assessment->results()->where('user_id', $user->id)->first();
                            //                 // If the result exists and is 'Fail', set the chapter details and break the loop
                            //                 if ($result && $result->status == 'Fail') {
                                //                     $first_chapter_detail = $chapter->description;
                                //                     $chapter_name = $chapter->chapter_name;
                                //                     break 2; // Exit both foreach loops
                                //                 }
                                //             }
                                //         }
                                //     }
                                
                                //     $data = [
                                    //         "page_title" => "Course Details",
                                    //         "course" => $course,
                                    //         'first_chapter_detail' => $first_chapter_detail,
                                    //         'chapter_name' => $chapter_name,
                                    //         'order_item' => $orderItem,
                                    //     ];
                                    
                                    //     return view('student.course-details', $data);
                                    // }
                                    
                                    
                                    public function chapter(Request $request){
                                        $order_item = OrderItem::where('course_id', $request->id)->first();
                                        $chapter = Chapter::find($request->id);
                                        $data = array(
                                            "page_title" => "Course Details",
                                            'order_item' => $order_item,
                                        );
                                        return response()->json($chapter);
                                    }
                                    
                                    public function progress(Request $request){
                                        $user = Auth::user();
                                        $chapter = Chapter::find($request->chapterId);
                                        $percent_watched = ($request->currentTime / $chapter->duration ) * 100;
                                        $course_progress = CourseProgress::where('course_id', $request->courseId)->where('user_id',$user->id)->where('chapter_id', $request->chapterId)->first();
                                        if($course_progress){
                                            if($course_progress->watch_time < $request->currentTime){
                                                $course_progress->update([
                                                    'watch_time' => $request->currentTime,
                                                    'percent_watched' => $percent_watched,
                                                ]);
                                            }
                                        }else{
                                            CourseProgress::create([
                                                'user_id' => $user->id,
                                                'course_id' => $request->courseId,
                                                'chapter_id' => $request->chapterId,
                                                'watch_time' => $request->currentTime,
                                                'percent_watched' => $percent_watched,
                                            ]);
                                        }
                                        
                                        $watch_time = CourseProgress::where('user_id', $user->id)->where('course_id', $request->courseId)->sum('watch_time');
                                        $course = Course::find($request->courseId);
                                        
                                        $course_watch_percentage = ($watch_time/$course->course_duration) * 100;
                                        
                                        $orderItem = OrderItem::join('orders', 'order_items.order_id', '=', 'orders.id')
                                        ->where('orders.created_by', $user->id)
                                        ->where('order_items.course_id', $request->courseId)
                                        ->select('order_items.*')
                                        ->first();
                                        
                                        if($course_watch_percentage >= 95){
                                            $orderItem->update([
                                                'progress' => '100',
                                            ]);
                                        }else{
                                            $orderItem->update([
                                                'progress' => $course_watch_percentage,
                                            ]);
                                        }
                                        
                                        return response()->json($orderItem);
                                    }
                                }
                                