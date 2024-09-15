<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $type = "Dashboard";
    private $singular = "Student Dashboard";
    private $active = 'dashboard';

    public function index(){
        $user = Auth::user();
        $active_count = OrderItem::where('created_by',$user->id)->whereBetween('progress',[1,99])->count();
        $complete_count =OrderItem::where('created_by',$user->id)->where('progress',100)->count();

        $data = array(
            "page_title" => $this->singular,
            'course_count' => $user->orderItems->count(),
            'active_count' => $active_count,
            'complete_count' => $complete_count,
            'student' => $user,
            'active' => $this->active,
        );
        return view('student.dashboard',$data);
    }
}
