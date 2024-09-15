<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Course;
use App\Models\OrderItem;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private $type = "course";
    private $singular = "Course";
    private $plural = "Courses";
    private $view = "courses";
    private $db_key = "id";
    private $action = "course";
    private $perpage = 10;

    public function index()
    {
        $courses = Course::paginate($this->perpage);
        $categories = Categories::all();
        $authors = User::whereIn('role', ['1', '2'])->get();
        $data = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            'courses' => $courses,
            'categories' => $categories,
            'authors' => $authors,
        );
        return view($this->view, $data);
    }

    public function filter(Request $request)
    {
        $course = Course::query();

        if ($request->categoryids) {
            $course->whereIn('cat_id', $request->categoryids);
        }
        $courses = $course->with('instructor')->withCount('lessons')->paginate($this->perpage);
        return response()->json($courses);
    }

    public function list()
    {
        $courses = Course::with('instructor')
            ->withCount('lessons')
            ->withCount('OrderItems')
            ->paginate($this->perpage);

        return response()->json($courses);
    }

    public function sort(Request $request)
    {
        $course = Course::query();
        if ($request->sort == '1') {
            $course->orderBy('course_name', 'asc');
        } else if ($request->sort == '2') {
            $course->orderBy('course_name', 'desc');
        }
        $courses = $course->with('instructor')
            ->withCount('lessons')->paginate($this->perpage);
        return response()->json($courses);
    }

    public function details($id)
    {

        $course = Course::find($id);
        $related_courses = Course::where('cat_id', $course->cat_id)->get();
        $instructor = $course->instructor;
        $lessons = $course->lessons;
        $hasDiscount = true;
        $discountPrice = 0;
        $daysleft = 0;

        if ($course->discount && $course->discount_end_date >= Carbon::now()) {
            $hasDiscount = true;
            $discountPrice = $course->price - $course->price * ($course->discount / 100);
            $startDate = Carbon::parse($course->discount_end_date);
            $endDate = Carbon::now();
            $daysleft = $startDate->diffInDays($endDate);
        } else {
            $hasDiscount = false;
        }

        $data = array(
            "page_title" => $this->singular . " Details",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "course" => $course,
            "related_courses" => $related_courses,
            "instructor" => $instructor,
            "lessons" => $lessons,
            'hasDiscount' => $hasDiscount,
            'discountPrice' => $discountPrice,
            'daysleft' => $daysleft,
        );
        return view('course-details', $data);
    }


    public function enrolledCourse(Request $request)
    {
        $user_id = Auth::user()->id;
        $enrolledCourse = OrderItem::where('created_by', $user_id)->where('course_id', $request->course_id)->exists();
        if ($enrolledCourse) {
            return true;
        } else {
            return false;
        }
    }
}
