<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\OrderItem;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private $type = "Wishlist";
    private $singular = "Wish-list";

    private $active = 'wishlist';

    public function index()
    {
        $user = Auth::user();
        $courses = Course::join('wishlists', 'courses.id', '=', 'wishlists.course_id')->where('wishlists.user_id', $user->id)->select('courses.*')->get();
        $data = array(
            "page_title" => $this->singular,
            'course_count' => $user->orderItems->count(),
            'courses' => $courses,
            'student' => $user,
            'active' => $this->active,
        );
        return view('student.wishlist', $data);
    }

    public function add(Request $request)
    {
        $user_id = Auth::user()->id;
        $course_exists = Wishlist::where('user_id', $user_id)->where('course_id', $request->id)->exists();
        if ($course_exists) {
            $response = [
                'error' => true,
                'message' => "Course already exist in wishlist"
            ];
            return response()->json($response);
        } else {
            Wishlist::create([
                'user_id' => $user_id,
                'course_id' => $request->id
            ]);
            $response = [
                'error' => false,
                'message' => 'Course added to wishlist!'
            ];
            return response()->json($response);
        }
    }

    public function remove($id){
        $user = Auth::user();
        $course =  Wishlist::where('user_id',$user->id)->where('course_id',$id)->first();
        $course->delete();
        return redirect()->back()->with('success','Course removed from the wishlist');
    }
}
