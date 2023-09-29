

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
              <h3 class="page-title"> Products </h3>
              
            </div>
            <div class="row">
              
                            <!--Table Start-->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Products Table</h4>
                    
                    
                    <div class="table-responsive">
                      <table class="table table-bordered" style="color:#fff;">
                        <thead>
                          <tr >
                            <th style="color:#fff;"> Ser No </th>
                            <th style="color:#fff;"> Product Name </th>
                            <th style="color:#fff;"> Product Price </th>
                            <th style="color:#fff;"> Product Image </th>
                            <th style="color:#fff;"> Action </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=0;@endphp
                        @foreach($products as $product_data)
                          <tr>
                            <td> {{++$i}} </td>
                            <td> {{$product_data->title}} </td>
                            <td> {{$product_data->price}} </td>
                            <td> <img style="width:100px; height:100px;border-radius:10%;"src="{{url('ProductImages/'.$product_data->image)}}"/> </td>
                            <td> 
                              <a class="btn btn-danger"href="{{url('delete_product',$product_data->id)}}" onclick="confirm('Are you sure to delete it?')">Delete</a>
                              <a style="margin-left:15px;" class="btn btn-success"href="{{url('edit_product',$product_data->id)}}">Edit</a>
                          </td>
                          
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