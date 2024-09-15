<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\CartItem;
use App\Models\Coupon;
use Auth;
class CheckoutController extends Controller
{
    private $singular = "Checkout";
    private $view = "checkout";
    
    
    
    public function index()
    {
        $stripe_public = Setting::find('1')->value;
        $user = auth()->user();
        $courses = CartItem::with('course')->where('user_id', $user->id)->get();
        $subtotal= Cart::subTotal();
        $grandtotal = Cart::grandTotal();
        $stripe_secret = Setting::where("key", "stripe_secret")->first()->value;
        \Stripe\Stripe::setApiKey(@$stripe_secret);
        $data = array(
            "page_title" => $this->singular . " List",
            "page_heading" => $this->singular . ' List',
            'courses' => $courses,
            'subtotal' => $subtotal,
            'grandtotal' => $grandtotal,
            'stripe_public'=>$stripe_public,
        );
        $data['stripe_key'] = Setting::where("key", "stripe_key")->first()->value;
        return view('checkout',$data);
    }
    
    public function removeCoupon()
    {
        if (session()->has('coupon_applied')) {
            session()->forget('coupon_applied');
        }
        return redirect()->back()->with('success', 'Coupon removed successfully.');
    }
    
    
    
    
    
    public function applyCoupon(Request $request)
    {
        $cartItems = CartItem::all();
        $couponCode = $request->input('code');
        $coupon = Coupon::where('code', $couponCode)->first();
        
        if (!$coupon) {
            return redirect(url('/checkout'))->with('coupon_error', 'Invalid coupon code.');
        }
        $now = now();
        if ($coupon->valid_from > $now  || $coupon->valid_until < $now) {
            return redirect(url('/checkout'))->with('coupon_error', 'Coupon is expired.');
        }
        
        if ($coupon->max_uses > 0 && $coupon->used >= $coupon->max_uses) {
            return redirect(url('/checkout'))->with('coupon_error', 'Coupon has reached its maximum usage limit.');
        }
        
        foreach ($cartItems as $cartItem) {
            $coursePrice = $cartItem->course->price; // Fetch the price of the course
            if ($cartItem->id == $coupon->course_id) {
                if ($coupon->type_raw === 'percentage') {
                    $discount = ($coursePrice * $coupon->value) / 100;
                } else {
                    $discount = min($coupon->value, $coursePrice);
                }
                $cartItem->price -= $discount;
            }
        }
        
        $coupon->used += 1;
        // $coupon->save();
        // Store coupon information in session
        session()->put('coupon_applied', [
            'code' => $couponCode,
            'value' => ($coupon->type_raw === 'percentage') ? $coupon->value . '%' : '$' . $discount,
        ]);
        // Redirect to the checkout page
        return redirect(url('/checkout'))->with('success_coupon', 'Coupon applied successfully.');
    }
    
    
    
    
}
