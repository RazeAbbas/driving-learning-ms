<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Expr\FuncCall;
use App\Models\CartItem;
use App\Models\OrderItem;
use Auth;

class CartController extends Controller
{
    private $type = "cart";
    private $singular = "Cart";
    private $view = "cart";
    private $db_key = "id";
    
    public function index()
    {
        $user = auth()->user();
        $courses = CartItem::with('course')->where('user_id', $user->id)->get();
        $data = array(
            "page_title" => $this->singular . " List",
            "page_heading" => $this->singular . ' List',
            'courses' => $courses,
        );
        
        return view('cart', $data);
    }
    
    public function removefromcart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $cartItemId = $data['id'];
            $cartItem = CartItem::find($cartItemId);
            if (!$cartItem) {
                $response = array('flag' => false, 'msg' => 'Cart item not found.');
            } else {
                $cartItem->delete();
            }
            return redirect()->back()->with('success', 'Item is Remove sucessfully.');
        }
    }
    
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $this->cleanData($data);
            
            $existingCartItem = CartItem::where('course_id', $data['course_id'])
            ->where('user_id', $data['user_id'])
            ->first();
            
            if ($existingCartItem) {
                $response = array('flag' => false, 'msg' => 'Course already exists in the cart.');
                return response()->json($response);
            }
            
            $alreadyEnrolled = OrderItem::where('course_id', $data['course_id'])
            ->where('created_by', $data['user_id'])
            ->exists();
            
            if ($alreadyEnrolled) {
                $response = array('flag' => false, 'msg' => 'You are already enrolled in this course.');
                return response()->json($response);
            }
            
            $req = new CartItem;
            $req->insert($data);
            $response = array('flag' => true, 'msg' => $this->singular . ' is added successfully.', 'action' => 'reload');
            
            return response()->json($response);
        }
        
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
    public function update(Request $request)
    {
        Cart::clear();
        foreach ($request->products as $key => $product) {
            CartItem::add($key, $product);
        }
        return redirect()->back();
    }
    
    public function destroy(Request $request)
    {
        $delete = CartItem::remove($request->product_id);
        return $delete->json();
    }
    
    public function existingCartItem(Request $request)
    {
        $existingCartItem = CartItem::where('course_id', $request->course_id)
        ->where('user_id', Auth::id())
        ->first();
        
        if ($existingCartItem) {
            $response = array('flag' => false, 'msg' => 'Course already exists in the cart.');
            return response()->json($response);
        }
    }
    public function alreadyEnrolled(Request $request)
    {
        $alreadyEnrolled = OrderItem::where('course_id', $request->course_id)
        ->where('created_by', Auth::id())
        ->exists();
        if ($alreadyEnrolled) {
            $response = array('flag' => false, 'msg' => 'You are already enrolled in this course.');
            return response()->json($response);
        }
    }
    
    public function getCartCount()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartCount = $user->cartItems()->count();
            return response()->json(['count' => $cartCount]);
        } else {
            return response()->json(['count' => 0]);
        }
    }
    
    
}