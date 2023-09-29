<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
//for stripe
use Session;
use Stripe;
use App\Models\Comment;
use App\Models\Reply;

class HomeController extends Controller
{
    public function frontpage(){
        //$products = product::all();
        $products = product::paginate(6);
		return view ('home.frontpage', compact('products'));
	}
	
	public function redirect(){
        $usertype = Auth::user()->usertype;

        if ($usertype=='1'){
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user = Auth::user()->count();
            $order_all= order::all();
            $total_revenue = 0;
            foreach($order_all as $order)
            {
                $total_revenue = $total_revenue + $order->price;
            }
            $delivered_order_count=order::where('delivery_status','=','delivered')->get()->count();
            $delivered_processing_count=order::where('delivery_status','=','pending')->get()->count();

            return view ('admin.dashboard',compact('total_product','total_order','total_user','total_revenue','delivered_order_count','delivered_processing_count'));
        }
        else{
            //$products = product::all();
            $products = product::paginate(6);
		    return view ('home.frontpage', compact('products'));
        }
    }
    public function products(){
            $products = product::paginate(6);
		    return view ('home.products', compact('products'));

    }
    public function product_details($id){
        $product_data = product::find($id);
        //$comments = comment::all();
        $comments = comment::orderby('id','desc')->get();
        $replies = reply::all();
        return view ('home.product_detail', compact('product_data','comments','replies'));
    }

    public function add_cart(Request $request,$id){

        if(Auth::id()){
            $user_data = Auth::user();
            $user_id=$user_data->id;            
            $product_data = product::find($id);                       ;;
            $existingIdofCart_ofThisProduct= cart::where('product_id','=',$id)->where('user_id','=',$user_id)->get('id')->first();
           
            if($existingIdofCart_ofThisProduct){
                
                $cartData=cart::find($existingIdofCart_ofThisProduct)->first();
                $exist_quanttity = $cartData->quantity;
                $cartData->quantity = $exist_quanttity + $request->quantity;                
                if($product_data->discount_price!=null){
                $cartData->price = $product_data->discount_price*$cartData->quantity;
                }
                else{
                $cartData->price = $product_data->price*$cartData->quantity;
                }
                $cartData->save();
                return redirect()->back();

            }
            else{
            $cart = new cart;
            $cart->name = $user_data->name;
            $cart->email = $user_data->email;
            $cart->phone = $user_data->phone;
            $cart->address = $user_data->address;
            $cart->product_title = $product_data->title;
            if($product_data->discount_price!=null){
                $cart->price = $product_data->discount_price*$request->quantity;
            }else{
                $cart->price = $product_data->price*$request->quantity;;
            }
            
            $cart->quantity = $request->quantity;
            $cart->image = $product_data->image;
            $cart->product_id = $product_data->id;
            $cart->user_id = $user_data->id;

            $cart->save();
            return redirect()->back();
            
            }


            

        }else{
            return redirect('login');
        }
        
    }

    public function show_cart(){
        if(Auth::id()){
            $user_id = Auth::id();
            $cart_data = cart:: where('user_id','=',$user_id)->get();
            return view('home.show_cart',compact('cart_data'));
            
        }else{
            return redirect('login');
        }       
    }

    public function show_order(){
        if(Auth::id()){
            $user_id = Auth::id();
            $order_data = order:: where('user_id','=',$user_id)->get();
            return view('home.show_order',compact('order_data'));
            
        }else{
            return redirect('login');
        }       
    }

    public function delete_cart($id){
        $cart_to_delete = cart::find($id);
        $cart_to_delete->delete();
        $user_id = Auth::id();
        $cart_data = cart:: where('user_id','=',$user_id)->get();      
        return view('home.show_cart', compact('cart_data'))->with('message','Cart Deleted Successfully');
        //return redirect()->back();
        
    }
    public function delete_order($id){
        $order_to_delete = order::find($id);
        $order_to_delete->delete();
        $user_id = Auth::id();
        $order_data = order:: where('user_id','=',$user_id)->get();      
        return view('home.show_order', compact('order_data'))->with('message','Order Deleted Successfully');
        //return redirect()->back();
        
    }


    public function cash_on_delivery(){
        $user_data = Auth::user();
        $user_id = $user_data->id;        
        $cart_data = cart:: where('user_id','=',$user_id)->get();        
        foreach($cart_data as $cart_data){
            $order = new order;
            $order->name = $cart_data->name;
            $order->email = $cart_data->email;
            $order->phone = $cart_data->phone;
            $order->address = $cart_data->address;
            $order->user_id = $cart_data->user_id;
            $order->product_title = $cart_data->product_title;
            $order->price = $cart_data->price;
            $order->quantity = $cart_data->quantity;
            $order->image = $cart_data->image;
            $order->product_id = $cart_data->product_id;
            $order->payment_status = 'Cash On Delivery';
            $order->delivery_status = 'Pending';

            $order->save();

            //deletin data from cart table
            $cart_id=$cart_data->id;

            $cart=cart::find($cart_id);

            $cart->delete();
            
            }
            //return redirect()->back(); 
            return view('home.show_cart', compact('cart_data'))->with('message','Your Order placed successfully.');

    }

    public function stripe_payment($total){

        return view('home.stripe',compact('total'));

    }

    public function stripePost(Request $request,$total)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => $total * 100,//100 for cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for Payment." 
        ]);

        $user_data = Auth::user();
        $user_id = $user_data->id;        
        $cart_data = cart:: where('user_id','=',$user_id)->get();        
        foreach($cart_data as $cart_data){
            $order = new order;
            $order->name = $cart_data->name;
            $order->email = $cart_data->email;
            $order->phone = $cart_data->phone;
            $order->address = $cart_data->address;
            $order->user_id = $cart_data->user_id;
            $order->product_title = $cart_data->product_title;
            $order->price = $cart_data->price;
            $order->quantity = $cart_data->quantity;
            $order->image = $cart_data->image;
            $order->product_id = $cart_data->product_id;
            $order->payment_status = 'Paid';
            $order->delivery_status = 'Pending';

            $order->save();

            //deletin data from cart table
            $cart_id=$cart_data->id;

            $cart=cart::find($cart_id);

            $cart->delete();
            
            }
            
        Session::flash('success', 'Payment successful!');
              
        return back();


    }

    public function search_product(Request $request){
        $search_text =$request->search_text;

        $products = product:: where('title','LIKE',"%$search_text%")->orwhere('category','LIKE',"%$search_text%")->orwhere('description','LIKE',"%$search_text%")->paginate(3);
        
        return view('home.products', compact('products'));
    }

    public function add_comment(Request $request){
        if(Auth::id()){
            $comment= new Comment;
            $comment->name=Auth::user()->name;
            $comment->comment=$request->comment;
            $comment->user_id=Auth::user()->id;
            $comment->save();
            return redirect()->back();        }
        else{
            return redirect('login');
        }

    }

    public function add_reply(Request $request){
        if(Auth::id()){
            $reply= new Reply;
            $reply->name=Auth::user()->name;
            $reply->comment_id=$request->commentId;
            $reply->reply=$request->reply;
            $reply->user_id=Auth::user()->id;
            $reply->save();
            return redirect()->back();        }
        else{
            return redirect('login');
        }

    }


}
