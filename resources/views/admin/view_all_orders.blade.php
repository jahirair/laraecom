<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.header');
  </head>
  <body>
    
    <div class="container-scroller">
      
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar');
        <!-- partial -->


<div class="main-panel">
          <div class="content-wrapper">
            <!--Success Message-->
          
@if(!empty($message))

  <div class="alert alert-success">
                  
    {{$message}}
                 
    <button type="button" class="close" data-dismiss="alert" aria-label="close" style="float:right;">x</button>
  </div>
      @endif           
  

            <div class="page-header">
              <h3 class="page-title"> Orders </h3>

              <form action="{{url('search_order')}}" method="get"style="width:300px;">
                @csrf
                <input type="text" name="search_text"class="form-control" placeholder="Search Orders" style="float:left;width:225px;border-radius:4px;">
                
                <input type="submit" value="Search" class="btn btn-success" style="float:right;height:36px;">
              </form>
              <a href="{{url('download_orders_pdf')}}" class="btn btn-primary">Download Orders PDF</a>
            </div>
            <div class="row">
              
                            <!--Table Start-->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Orders table</h4>
                    
                    
                    <div class="table-responsive">
                      <table class="table table-bordered" style="color:#fff;">
                        <thead>
                          <tr >
                            <th style="color:#fff;"> Ser No </th>
                            <th style="color:#fff;"> Name </th>
                            <th style="color:#fff;"> Email </th>
                            <th style="color:#fff;"> Phone </th>
                            <th style="color:#fff;"> Address </th>
                            <th style="color:#fff;"> User ID </th>
                            <th style="color:#fff;"> Product Title </th>
                            <th style="color:#fff;"> Price </th>
                            <th style="color:#fff;"> Quantity </th>
                            <th style="color:#fff;"> Image </th>
                            <th style="color:#fff;"> Product ID </th>
                            <th style="color:#fff;"> Payment Status </th>
                            <th style="color:#fff;"> Delivery Status </th>
                            <th style="color:#fff;"> Action </th>
                            <th style="color:#fff;"> Download PDF </th>
                            <th style="color:#fff;"> Send Email</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=0;@endphp
                        @foreach($order_datas as $order_data)

                          <tr>
                            <td> {{++$i}} </td>
                            <td> {{$order_data->name}} </td>
                            <td> {{$order_data->email}} </td>
                            <td> {{$order_data->phone}} </td>
                            <td> {{$order_data->address}} </td>
                            <td> {{$order_data->user_id}} </td>
                            <td> {{$order_data->product_title}} </td>
                            <td> {{$order_data->price}} </td>
                            <td> {{$order_data->quantity}} </td>
                            <td> <img style="width:100px; height:100px;border-radius:10%;"src="{{url('ProductImages/'.$order_data->image)}}"/></td>
                            <td> {{$order_data->product_id}} </td>
                            <td> {{$order_data->payment_status}} </td>
                            <td> {{$order_data->delivery_status}} </td>
                            
                            <td>
                                @if($order_data->delivery_status=='Pending')
                              <a class="btn btn-danger"href="{{url('deliver_order',$order_data->id)}}" onclick="confirm('Are you sure to deliver it?')">Deliver Now</a>
                              @endif
                              @if($order_data->delivery_status=='Delivered'&&$order_data->payment_status=='Cash On Delivery')
                              <a class="btn btn-info"href="{{url('cash_received',$order_data->id)}}" onclick="confirm('Are you sure you received cash?')">Receive Cash</a>
                              @endif
                              @if($order_data->delivery_status=='Delivered'&&$order_data->payment_status=='Cash Received')
                              <a class="btn btn-success">Cash Received</a>
                              @endif
                          </td>
                          <td><a href="{{url('print_pdf',$order_data->id)}}" class="btn btn-primary">Print PDF</a></td>
                          <td><a href="{{url('send_email',$order_data->id)}}" class="btn btn-primary">Send Email</a></td>
                            
                          </tr>

                          @endforeach
                          
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!--Table End-->
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          
          <!-- partial -->
        </div>
</div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
  </body>
</html>