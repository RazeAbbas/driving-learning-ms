<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Categories;
use Auth, Hash, Storage, Excel;
use App\Exports\ArrayExport;

class DashboardController extends Controller
{
    private $directory = '/public/images';
    private $perpage = 10;
    /**
     * Show the application admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['active_module'] = "home";
        $data['page_title'] = "Dashboard";
        $data['sales'] = OrderItem::sum('amount');
        ;
        $data['orderitem_count'] = Order::with('student', 'orderitems.course')->orderBy("id", "desc")->get()->count();
        $data['courses'] = Course::all();
        $data['course_count'] = Course::get()->count();
        $data['users_count'] = User::get()->count();
        return view('admin.dashboard', $data);
    }
    public function admin_login()
    {
        return view('auth.admin-login');
    }
    public function orders()
    {
        $orders = Order::with('student', 'orderitems.course')->orderBy("id", "desc")->get();
        // dd($orders->toArray()[0]);
        $data = [
            "page_title" => "Admin Orders",
            "orders" => $orders,
            "active_module" => "orders"
        ];
        return view('admin.orders', $data);
    }
    public function order_invoice(Request $request, $id = NULL)
    {
        $req = $request->all();
        $order_data = Order::with('orderitems', 'course', 'student', 'GapAnalysis')->where('id', $id)->first();
        $data = [
            "page_title" => "Order Invoice",
            "order_invoice" => $order_data,
            "active_module" => "orders"
        ];
        return view('admin.order_invoice', $data);
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
    public function profile(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd('hello mom');
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
                    $response = array('flag' => false, 'msg' => 'Password does not match.', 'action' => 'reload');
                    echo json_encode($response);
                    return;
                }
            } else {
                unset($data['password']);
            }

            unset($data['confirm_password']);

            User::where("id", auth()->user()->id)->update($data);
            $response = array("flag" => true, "msg" => "Profile updated successfully!", "action" => "reload");
            echo json_encode($response);
            return ;
        }
        $data['active_module'] = "home";
        $data['page_title'] = "Admin profile";
        return view('admin.profile', $data);
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
        // if(!empty(@$request->search)) {
        //     $params['search'] = $request->search;
        //     $data['search'] = $request->search;
        //     $search = $request->search;
        //     $records = $records->where( function($q) use($search) {
        //         $q->where("course_name","like",'%'.$search.'%')
        //         ->orWhere("course_duration","like",'%'.$search.'%')
        //         ->orWhere("price","like",'%'.$search.'%')
        //         ->orWhere("discount","like",'%'.$search.'%')
        //         ->orWhere("is_feature","like",'%'.$search.'%')
        //         ->orWhere("start_date","like",'%'.$search.'%')
        //         ->orWhere("end_date","like",'%'.$search.'%');
        //     });
        // }
        $total_sales = new OrderItem;
        if (!empty ($request->course_id) && $request->course_id !== "all") {
            $params['course_id'] = $request->course_id;
            $data['course_id'] = $request->course_id;
            $records = $records->where("course_id", $request->course_id);
            $total_sales = $total_sales->where("course_id", $request->course_id);
        }
        if (!empty ($request->user_id) && $request->user_id !== "all") {
            $params['user_id'] = $request->user_id;
            $data['user_id'] = $request->user_id;
            $records = $records->where("created_by", $request->user_id);
            $total_sales = $total_sales->where("created_by", $request->user_id);
        }
        if (!empty ($request->training_type) && $request->training_type !== "all") {
            $params['training_type'] = $request->training_type;
            $data['training_type'] = $request->training_type;
            $records = $records->where("training_type", $request->training_type);
        }
        if (!empty ($request->payment_type) && $request->payment_type !== "all") {
            $params['payment_type'] = $request->payment_type;
            $data['payment_type'] = $request->payment_type;
            $payment_type = $request->payment_type;
            $records = $records->whereHas("orders", function ($q) use ($payment_type) {
                $q->where("payment_type", $payment_type);
            });
            $total_sales = $total_sales->whereHas("orders", function ($q) use ($payment_type) {
                $q->where("payment_type", $payment_type);
            });
        }
        // if(!empty($request->month_year) && $request->month_year !== "all") {
        //     $params['month_year'] = $request->month_year;
        //     $data['month_year'] = $request->month_year;
        //     $month_year = explode("-", $request->month_year);
        //     $records = $records->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        //     $total_sales = $total_sales->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        // }
        if (!empty ($request->start_date)) {
            $params['start_date'] = $request->start_date;
            $data['start_date'] = $request->start_date;
            $records = $records->where("created_at", ">=", $request->start_date);
            $total_sales = $total_sales->where("created_at", ">=", $request->start_date);
        }
        if (!empty ($request->end_date)) {
            $params['end_date'] = $request->end_date;
            $data['end_date'] = $request->end_date;
            $records = $records->where("created_at", "<=", $request->end_date);
            $total_sales = $total_sales->where("created_at", "<=", $request->end_date);
        }
        $data["total_sales"] = $total_sales->sum("amount");
        $data['request'] = $params;
        return $records;
    }

    public function course_report(Request $request)
    {
        $data = array();
        $data = array(
            "active_module" => "reports"
        );
        /*
        GET RECORDS
        */
        $records = new OrderItem;
        $records = $records::with('course', 'course.category', 'orders', 'user');
        $records = $this->search($records, $request, $data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count'] = $records->count();

        /* PAGINATE THE RECORDS */
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Course'] = $records;
        $data['courses'] = Course::all();
        $data['users'] = User::where("role", "3")->get();
        $data['cat_id'] = $request->cat_id;

        return view('admin.reports.course-report', $data);
    }

    public function sales_report(Request $request)
    {
        $data = array();
        $data = array(
            "active_module" => "reports"
        );
        /*
        GET RECORDS
        */
        $records = new OrderItem;
        $records = $records::with('course', 'course.category', 'orders', 'user');
        $records = $this->search($records, $request, $data);
        /*
        GET TOTAL RECORD BEFORE BEFORE PAGINATE
        */

        $data['count'] = $records->count();

        /*
        PAGINATE THE RECORDS
        */
        $records = $records->paginate($this->perpage);
        $data['total'] = $records->total();
        $data['perPage'] = $records->perPage();
        $data['currentPage'] = $records->currentPage();
        $records->appends($request->all())->links();
        $links = $records->links();
        $records = $records->toArray();

        $records['pagination'] = $links;

        /*
        ASSIGN DATA FOR VIEW
        */
        $data['Course'] = $records;
        $data['courses'] = Course::all();
        $data['users'] = User::where("role", "3")->get();
        $data['cat_id'] = $request->cat_id;

        return view('admin.reports.sales-report', $data);
    }

    public function download_order_report(Request $request)
    {
        $order_data = OrderItem::with('course', 'course.category', 'orders', 'user');
        if (!empty ($request->course_id) && $request->course_id !== "all") {
            $order_data = $order_data->where("course_id", $request->course_id);
        }
        if (!empty ($request->user_id) && $request->user_id !== "all") {
            $order_data = $order_data->where("created_by", $request->user_id);
        }
        if (!empty ($request->training_type) && $request->training_type !== "all") {
            $order_data = $order_data->where("training_type", $request->training_type);
        }
        // if(!empty($request->month_year) && $request->month_year !== "all") {
        //     $month_year = explode("-", $request->month_year);
        //     $order_data = $order_data->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        // }
        if (!empty ($request->start_date)) {
            $order_data = $order_data->where("created_at", ">=", $request->start_date);
        }
        if (!empty ($request->end_date)) {
            $order_data = $order_data->where("created_at", "<=", $request->end_date);
        }
        $order_data = $order_data->get();
        $data_array[] = array('#', 'Course Name', 'Training Type', 'User Name', 'Enroll Date', 'Progress');
        foreach ($order_data as $key => $order) {
            $data_array[] = array(
                '#' => $key + 1,
                'Course Name' => $order->course->course_name,
                'Training Type' => (($order->training_type == "session") ? "One-to-One Session" : "Recorded Training"),
                'User Name' => $order->user->name,
                'Enroll Date' => date("d, M Y", strtotime($order->created_at)),
                'Progress' => $order->progress . "%"
            );
        }
        return Excel::download(new ArrayExport($data_array), 'course_report.xlsx');
    }

    public function download_sales_report(Request $request)
    {
        $order_data = OrderItem::with('course', 'course.category', 'orders', 'user');
        if (!empty ($request->course_id) && $request->course_id !== "all") {
            $order_data = $order_data->where("course_id", $request->course_id);
        }
        if (!empty ($request->user_id) && $request->user_id !== "all") {
            $order_data = $order_data->where("created_by", $request->user_id);
        }
        if (!empty ($request->payment_type) && $request->payment_type !== "all") {
            $payment_type = $request->payment_type;
            $order_data = $order_data->whereHas("orders", function ($q) use ($payment_type) {
                $q->where("payment_type", $payment_type);
            });
        }
        // if(!empty($request->month_year) && $request->month_year !== "all") {
        //     $month_year = explode("-", $request->month_year);
        //     $order_data = $order_data->whereMonth('created_at', $month_year[1])->whereYear('created_at', $month_year[0]);
        // }
        if (!empty ($request->start_date)) {
            $order_data = $order_data->where("created_at", ">=", $request->start_date);
        }
        if (!empty ($request->end_date)) {
            $order_data = $order_data->where("created_at", "<=", $request->end_date);
        }
        $order_data = $order_data->get();
        $data_array[] = array('#', 'User Name', 'Course Name', 'Training Type', 'Price', 'Payment Date', 'Payment Method');
        foreach ($order_data as $key => $order) {
            $data_array[] = array(
                '#' => $key + 1,
                'User Name' => $order->user->name,
                'Course Name' => $order->course->course_name,
                'Training Type' => (($order->training_type == "session") ? "One-to-One Session" : "Recorded Training"),
                'Price' => "$" . $order->amount,
                'Payment Date' => date("d, M Y", strtotime($order->created_at)),
                'Payment Method' => (($order->orders->payment_type == "online") ? "Credit Card" : "Paypal")
            );
        }
        return Excel::download(new ArrayExport($data_array), 'sales_report.xlsx');
    }
}
