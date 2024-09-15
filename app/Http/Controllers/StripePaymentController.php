<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use Auth;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{
    
    private $stripeSecretKey;
    public function __construct()
    {
        $this->stripeSecretKey = Setting::where("key", "stripe_secret")->first()->value;
    }
    
    
    /*public function index(Request $request)
    {
        $CartItems = CartItem::with('course', 'user')->where("user_id", Auth::user()->id)->get();
        $totalAmount = 0;
        $order_discount = 0;
        foreach ($CartItems as $cartItem) {
            $totalAmount += $cartItem->course->price;
        }
        if (session()->has('coupon_applied')) {
            $couponData = session('coupon_applied');
            $order_discount = floatval(str_replace(['%', ' '], '', $couponData['value']));
        }
        $totalAmount -= $totalAmount * ($order_discount / 100);
        session()->put('order_amount', $totalAmount);
        $stripe_secret = Setting::where("key", "stripe_secret")->first()->value;
        \Stripe\Stripe::setApiKey(@$stripe_secret);
        $customer = \Stripe\Customer::create([
            'email' => Auth::user()->email,
            'source' => $request->stripeToken,
        ]);
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $totalAmount * 100,
            'currency' => 'usd',
        ]);
        $stripe = new StripeClient($this->stripeSecretKey);
        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $totalAmount * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            return response()->json($output);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        
        if($request->isMethod('POST'))
        {
            $user = Auth::user();
            $cartItems = CartItem::with('user', 'course')->where('user_id', $user->id)->get();
            $discount_amount = 0;
            foreach($cartItems as $item){
                $discount_amount += $item->course->price;
            }
            $orderAmount = 0;
            $order = [
                "discount_amount"=>$discount_amount,
                "amount"=>$orderAmount,
                "payment_type"=>"online",
                "created_by"=>Auth::user()->id
            ];
            $Order = Order::create($order);
            foreach($cartItems as $item){
                $course_price = $item->course->price;
            }
            $orderitems = [
                "course_id"=>$item->course->id,
                "order_id"=>$Order->id,
                "discount"=>$discount_amount,
                "amount"=>$course_price,
                "created_by"=>Auth::user()->id,
            ];
            $order_item = OrderItem::create($orderitems);
            CartItem::where(["course_id"=>$cartItems->course->id,"user_id"=>Auth::user()->id])->delete();
            
            if (session()->has('coupon_applied')) {
                $code = session('coupon_applied')['code'];
                if (!empty($code)) {
                    $coupon = Coupon::where('code', $code)->first();
                    if ($coupon) {
                        $coupon->used += 1;
                        $coupon->save();
                    }
                }
            }
            session()->forget('coupon_applied');
            
        }
    } */
    public function index(Request $request)
    {
        // Retrieve cart items for the authenticated user
        $cartItems = CartItem::with('course')->where('user_id', Auth::id())->get();
        
        // Calculate total amount and discount
        $totalAmount = 0;
        $order_discount = 0;
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->course->price;
        }
        if (session()->has('coupon_applied')) {
            $couponData = session('coupon_applied');
            $order_discount = floatval(str_replace(['%', ' '], '', $couponData['value']));
        }
        $totalAmount -= $totalAmount * ($order_discount / 100);
        
        // Store order amount in session
        session()->put('order_amount', $totalAmount);
        
        // Stripe setup
        $stripe_secret = Setting::where("key", "stripe_secret")->first()->value;
        \Stripe\Stripe::setApiKey($stripe_secret);
        
        // Create a customer in Stripe
        $customer = \Stripe\Customer::create([
            'email' => Auth::user()->email,
            'source' => $request->stripeToken,
        ]);
        
        // Create a payment intent in Stripe
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $totalAmount * 100,
            'currency' => 'usd',
        ]);
        
        // Handle payment intent creation and return client secret
        $stripe = new StripeClient($this->stripeSecretKey);
        try {
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $totalAmount * 100,
                'currency' => 'usd',
                'payment_method_types' => ['card'],
            ]);
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
            return response()->json($output);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
        
        // Return the response
        // return response()->json(['success' => true, 'message' => 'Order placed successfully']);
    }
    
    
    public function handleResponse(Request $request)
    {
        $order_discount =0;
        $totalAmount = 0;
        $subtotal =0;
        $cartItems = CartItem::with('course')->where('user_id', Auth::id())->get();
        foreach ($cartItems as $cartItem) {
            $totalAmount += $cartItem->course->price;
        }
        $subtotal = $totalAmount;
        if (session()->has('coupon_applied')) {
            $couponData = session('coupon_applied');
            $order_discount = floatval(str_replace(['%', ' '], '', $couponData['value']));
        }
        if ($order_discount){
            $totalAmount -= $totalAmount * ($order_discount / 100);
        }
        // Create an order
        $order = Order::create([
            'discount_amount' => $order_discount,
            'amount' => $totalAmount,
            'subtotal' => $subtotal,
            'payment_type' => 'online',
            'created_by' => Auth::id(),
        ]);
        
        // Convert cart items into order items and associate with the order
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'course_id' => $cartItem->course->id,
                'order_id' => $order->id,
                'discount' => 0,
                'amount' => $cartItem->course->price,
                'created_by' => Auth::id(),
            ]);
        }
        // Remove cart items associated with the user
        CartItem::where('user_id', Auth::id())->delete();
        
        // Handle coupon usage
        if (session()->has('coupon_applied')) {
            $code = session('coupon_applied')['code'];
            if (!empty($code)) {
                $coupon = Coupon::where('code', $code)->first();
                if ($coupon) {
                    $coupon->used += 1;
                    $coupon->save();
                }
            }
            session()->forget('coupon_applied');
        }
        return redirect("student/dashboard")->with('success', 'you have successfully registered');
        
        
    }
    
    
}
