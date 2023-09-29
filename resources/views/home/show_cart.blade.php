<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="home/images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{url('public/home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{url('public/home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{url('public/home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{url('public/home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->
<!--Success Message-->
          
@if(!empty($message))

  <div class="alert alert-success">
                  
    {{$message}}
                 
    <button type="button" class="close" data-dismiss="alert" aria-label="close" style="float:right;">x</button>
  </div>
      @endif           
  @if(count($cart_data)>0)
         <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  My <span>cart</span>
               </h2>
            </div>
            <div class="row">
                             <!--Table Start-->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Cart Table</h4>
                    
                    
                    <div class="table-responsive">
                      <table class="table table-bordered" style="color:#fff;">
                        <thead>
                          <tr >
                            <th style="color:#000;"> Ser No </th>
                            <th style="color:#000;"> Product Name </th>
                            <th style="color:#000;"> Product Quantity </th>
                            <th style="color:#000;"> Product Price </th>
                            <th style="color:#000;"> Product Image </th>
                            <th style="color:#000;"> Action </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=0;$total=0;@endphp
                        @foreach($cart_data as $product_data)
                          <tr>
                            <td style="color:#000;"> {{++$i}} </td>
                            <td style="color:#000;"> {{$product_data->product_title}} </td>
                            <td style="color:#000;"> {{$product_data->quantity}} </td>
                            <td style="color:#000;"> ${{$product_data->price}} </td>
                            <td style="color:#000;"> <img style="width:100px; height:100px;border-radius:10%;"src="{{url('ProductImages/'.$product_data->image)}}"/> </td>
                            <td style="color:#000;"> 
                              <a class="btn btn-danger"href="{{url('delete_cart',$product_data->id)}}" onclick="confirm('Are you sure to delete it?')">Delete</a>
                              
                          </td>
                          
                          </tr>
                            @php $total=$total +$product_data->price;@endphp
                          @endforeach
                          <tr><td><td></td></td>
                            <td style="color:#000;">Total</td>
                            <td style="color:#000;">${{$total}}</td>
                            <td><td></td></td>
                        </tr>
                          
                        </tbody>
                      </table>

                      <div class="order" style="margin:0 auto; display:block;width:300px;"> 
                        <h1 style="text-align:center;font-size:25px;margin-bottom:20px;">Place Order</h1>
                        <a href="{{url('cash_on_delivery')}}" class="btn btn-danger"style="color:#fff;cursor:pointer;" >Cash on Delivery</a>
                        <a href="{{url('stripe_payment',$total)}}"class="btn btn-danger"style="color:#fff;cursor:pointer;">Stripe Payment</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--Table End-->
               
         </div>
      </section>

@else
    <section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h3>
                  No product on your Cart. Visit our Product page.
               </h3>
               
            </div>
        </div>
</section>
            

@endif
<!-- footer start -->
      @include('home.footer');
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="{{url('public/home/js/jquery-3.4.1.min.js')}}"></script>
      <!-- popper js -->
      <script src="{{url('public/home/js/popper.min.js')}}"></script>
      <!-- bootstrap js -->
      <script src="{{url('public/home/js/bootstrap.js')}}"></script>
      <!-- custom js -->
      <script src="{{url('public/home/js/custom.js')}}"></script>
   </body>
</html>