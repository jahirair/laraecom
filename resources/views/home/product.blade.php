<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Our <span>Products</span>
               </h2>
               <form action="{{url('search_product')}}" method="get"style="width:350px;">
                @csrf
                <input type="text" name="search_text"class="form-control" placeholder="Search Products" style="float:left;width:250px;border-radius:4px;">
                
                <input type="submit" value="Search" class="btn btn-success" style="float:left;height:38px;padding:5px 20px;">
              </form>
            </div>
            <div class="row">
               @foreach($products as $product_data)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('/product_details',$product_data->id)}}" class="option1" target="_blank">
                           Product Details
                           </a>
                           <form action="{{url('add_cart',$product_data->id)}}" method="post">
                              @csrf
                           <div class="row">
                              <div class="col-md-2">                                 
                                 <input type="number" name="quantity" value="1" min="1" style="width:100px; font-size:10px;padding:10px;">
                              </div>
                           </div>
                           <div class="col-md-2">
                              <input type="submit" value="Add to Cart" style="width:100px; font-size:10px;padding:10px;">
                           </div>
                           </form>
                           
                           
                        </div>
                     </div>
                     <div class="img-box">
                        <img src="{{url('ProductImages/'.$product_data->image)}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product_data->title}}
                        </h5>
                        @if($product_data->discount_price!=null)
                        <h6 style="color:green;">
                           
                           ${{$product_data->discount_price}}
                        </h6>

                        <h6 style="text-decoration:line-through;color:red;">
                           ${{$product_data->price}}
                        </h6>
                        
                        
                        @else
                        <h6 style="color:green;">
                           ${{$product_data->price}}
                        </h6>
                        
                        @endif
                     </div>
                  </div>
               </div>
               @endforeach
               <div class="col-sm-12 col-md-12 col-lg-12">
               <span style="padding-top:20px;display:block; margin:0 auto;">               
               {!!$products->appends(Request::all())->links()!!}
               </span>
               </div>
            </div>
            
         </div>
      </section>