<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
//use PDF;
use Barryvdh\DomPDF\Facade\Pdf;

use Notification;
use App\Notifications\SendEmailNotification;



class AdminController extends Controller
{
    

    public function add_category(){
        return view('admin.add_category');
    }

    public function save_category(Request $request){
        $data = new Category;
        $data->category_name = $request->cat_name;
        $data->save();
        return view('admin.add_category')->with('message','Category Added Successfully');
    }

    public function view_category(){
        $data = category::all();
        return view('admin.view_category', compact('data'));
    }

    public function delete_category($id){
        $category_to_delete = category::find($id);
        $category_to_delete->delete();
        $data = category::all();        
        return view('admin.view_category', compact('data'))->with('message','Category Deleted Successfully');
        //return redirect()->back();
        //return view('admin.view_category')->with('message','Category Added Successfully');;
    }

    public function add_product(){
         $data = category::all();
        return view('admin.add_product', compact('data'));
    }

    public function save_product(Request $request){
        $data = new Product;
        $data->title = $request->product_title;
        $data->description = $request->product_description;
        $image = $request->product_image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $request->product_image->move('ProductImages',$imageName);
        $data->image = $imageName;
        $data->category = $request->product_category;
        $data->quantity = $request->product_quantity;
        $data->price = $request->product_price;
        $data->discount_price = $request->product_discount_price;
        $data->save();
        $data = category::all();        
        return view('admin.add_product', compact('data'))->with('message','Product Added Successfully');
    }

    public function view_product(){
        $products = product::all();
        return view('admin.view_product', compact('products'));
    }

    public function delete_product($id){
        $product_to_delete = product::find($id);
        $product_to_delete->delete();
        $products = product::all();        
        return view('admin.view_product', compact('products'))->with('message','Product Deleted Successfully');
        //return redirect()->back();
        //return view('admin.view_category')->with('message','Category Added Successfully');;
    }

    public function edit_product($id){
         $categories = category::all();
         $product_to_edit = product::find($id);
        return view('admin.edit_product', compact('categories','product_to_edit'));
    }

    public function update_product(Request $request, $id){
        $data = product::find($id);
        $data->title = $request->product_title;
        $data->description = $request->product_description;
        $image = $request->product_image;
        if($image){
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $request->product_image->move('ProductImages',$imageName);
        $data->image = $imageName;
        }
        $data->category = $request->product_category;
        $data->quantity = $request->product_quantity;
        $data->price = $request->product_price;
        $data->discount_price = $request->product_discount_price;
        $data->save();
        // to return Edit Product Page
        $product_to_edit = product::find($id);
        $categories = category::all();        
        return view('admin.edit_product', compact('categories','product_to_edit'))->with('message','Product Updated Successfully');
        
        // to return view Product Page
        //$products = product::all();        
        //return view('admin.view_product', compact('data','products'))->with('message','Product Updated Successfully');
        
    }

    public function view_all_orders(){
        $order_datas = new order;
        $order_datas = order::all();
        return view('admin.view_all_orders', compact('order_datas'));

    }

    public function deliver_order($id){
        $update_order = order::find($id);
        $update_order->delivery_status = 'Delivered';
        $update_order->save();
        //$order_datas = order::all();
        //return view('admin.view_all_orders', compact('order_datas'));
        return redirect()->back();

    }
    
    public function cash_received($id){
        $update_order = order::find($id);
        $update_order->payment_status = 'Cash Received';
        $update_order->save();
        //$order_datas = order::all();
        //return view('admin.view_all_orders', compact('order_datas'));
        return redirect()->back();

    }

    public function print_pdf($id){
        $order_datas = order::find($id);
        $data=[
            'title'=> 'Monthly Sale',
            'date'=>date('m/d/y'),
            'order_datas'=>$order_datas
        ];
        $pdf = PDF::loadView('admin.pdf',$data);
        return $pdf->stream('order_details.pdf');
    }
    
    public function download_orders_pdf(){
        $order_datas = order::all();
        $data=[
            'title'=> 'Monthly Sale',
            'date'=>date('m/d/y'),
            'order_datas'=>$order_datas
        ];
        $pdf = PDF::loadView('admin.download_orders',$data);
        return $pdf->stream('monthly_order_details.pdf');

    }

    public function send_email($id){
        $order_datas = order::find($id);
        return view ('admin.email_info',compact('order_datas'));
    }

    public function send_buyer_email(Request $request, $id){
        $order_datas = order::find($id);

        $details=[
            'greeting'=> $request->greeting,
            'firstline'=> $request->firstline,
            'body'=> $request->body,
            'button'=> $request->button,
            'url'=> $request->url,
            'lastline'=> $request->lastline
        ];

        Notification::send($order_datas, new SendEmailNotification($details));
        //return redirect()->back();
        return view ('admin.email_info',compact('order_datas'))->with('message','Email Sent Successfully');;
    }

    public function search_order(Request $request){
        $search_text =$request->search_text;
        $order_datas = order:: where('name','LIKE',"%$search_text%")->orwhere('product_title','LIKE',"%$search_text%")->orwhere('phone','LIKE',"%$search_text%")->get();
        return view('admin.view_all_orders', compact('order_datas'));
    }



}
