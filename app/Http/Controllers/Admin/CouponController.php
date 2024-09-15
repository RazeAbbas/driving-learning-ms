<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreCouponRequest;
use App\Http\Requests\UpdateCouponRequest;
use App\Imports\CouponImport;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class CouponController extends Controller
{

    private $type   =  "Coupon";
    private $singular = "Coupon";
    private $plural = "Coupons";
    private $view = "admin.coupons.";
    private $db_key   =  "id";
    private $action   =  "coupon";
    private $perpage   =  10;
    private $directory  =   '\public\images/';
    /**
     * Display a listing of the coupons.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = array(
            "page_title" => $this->plural . " List",
            "page_heading" => $this->plural . ' List',
            "breadcrumbs" => array("#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key],
            "active_module" => "coupons"
        );

        $data['coupons'] = Coupon::with('courses')->latest()->paginate($this->perpage);

        return view('admin.coupons.list', $data);
    }

    /**
     * Show the form for creating a new coupon.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            "page_title" => "Add " . $this->singular,
            "page_heading" => "Add " . $this->singular,
            "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
            "action" => url('admin/' . $this->action . '/store'),
            "module" => [
                'type' => $this->type,
                'singular' => $this->singular,
                'plural' => $this->plural,
                'view' => $this->view,
                'action' => 'admin/' . $this->action,
                'db_key' => $this->db_key
            ],
        ];
        $data['courses'] = Course::get();
        $data['users'] = User::where('role', '3')->get();
        return view('admin.coupons.create', $data);
    }

    /**
     * Store a newly created coupon in storage.
     *
     * @param  \App\Http\Requests\StoreCouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {

        Coupon::create($request->validated());

        return response()->json([
            'flag' => true,
            'msg' => $this->singular . ' is added successfully.',
            'action' => 'reload'
        ]);
    }

    /**
     * Show the form for editing the specified coupon.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon, $id = NULL)
    {
        $data   = array(
            "page_title" => "Edit " . $this->singular,
            "page_heading" => "Edit " . $this->singular,
            "breadcrumbs" => array("dashboard" => "Dashboard", "#" => $this->plural . " List"),
            "action" => url('admin/' . $this->action . '/update'),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key]
        );


        $data['coupon'] = $coupon::find($id);


        $data['courses'] = Course::get();
        $data['users'] = User::where('role', '3')->get();


        return view('admin.coupons.edit', $data);
    }

    /**
     * Update the specified coupon in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCouponRequest $request, Coupon $coupon)
    {

        $data = $request->validated();

        if (!isset($data['course_id'])) {
            $data['course_id'] = null;
        }

        // if (!isset($data['gap_analysis_id'])) {
        //     $data['gap_analysis_id'] = null;
        // }

        $res = $coupon->where('id', $request->id)->update($data);

        if ($res) {
            return response()->json([
                'flag' => true,
                'msg' => $this->singular . ' is updated successfully.',
                'action' => 'reload'
            ]);
        } else {
            return response()->json([
                'flag' => false,
                'msg' => 'Failed to update ' . $this->singular . '.',
                'action' => 'none'
            ]);
        }
    }

    /**
     * Remove the specified coupon from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function delete(Coupon $coupon, $id = NULL)
    {
        $coupon::find($id)->delete();

        return response()->json([
            'flag' => true,
            'msg' => $this->singular . ' is deleted successfully.',
            'action' => 'reload'
        ]);
    }

    /**
     * Import coupons from an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        $data = [
            "page_title" => "Add " . $this->singular,
            "page_heading" => "Add " . $this->singular,
            "breadcrumbs" => ["dashboard" => "Dashboard", "#" => $this->plural . " List"],
            "action" => url('admin/' . $this->action . '/import-coupon'),
            "module" => ['type' => $this->type, 'singular' => $this->singular, 'plural' => $this->plural, 'view' => $this->view, 'action' => 'admin/' . $this->action, 'db_key' => $this->db_key]
        ];

        return view($this->view . 'import', $data);


    }
    /**
     * Import coupons from an Excel file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importCoupons(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:xlsx,xls,csv']);

        Excel::import(new CouponImport, $request->file('file'));

        return response()->json([
            'flag' => true,
            'msg' => 'Coupons are imported successfully.',
            'action' => 'reload'
        ]);
    }
}
