<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash, Storage, Excel;

class ProfileController extends Controller
{
    private $type = "Profile";
    private $singular = "Student Profile";
    private $directory = '/public/images';
    private $active = 'profile';

    public function index(Request $request){
        if ($request->isMethod('post')) {

            $data = $request->all();
            $this->cleanData($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = Storage::putFile($this->directory, $file);
                $data['image'] = basename($filename);
            }

            if (!empty ($data['confirm_password'])) {
                if ($data['password'] == $data['confirm_password']) {
                    $data['password'] = Hash::make($data['password']);
                } else {
                    return redirect()->back()->with('error','Password does not match.');
                }
            } else {
                unset($data['password']);
            }

            unset($data['confirm_password']);

            User::where("id", auth()->user()->id)->update($data);
            return redirect()->back()->with('success','Profile updated successfully!');
        }
        $user = Auth::user();
        $data = array(
            "page_title" => $this->singular,
            'course_count' => $user->orderItems->count(),
            'student' => $user,
            'active' => $this->active,
        );
        return view('student.profile',$data);
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
}
