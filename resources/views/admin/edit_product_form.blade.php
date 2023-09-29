

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
              
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Edit Product</h4>
                    <p class="card-description"> </p>
                    <form class="forms-sample" action="{{url('/update_product',$product_to_edit->id)}}" method='POST' enctype="multipart/form-data" >
                    @csrf
                      <div class="form-group row">
                        <label for="product_title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_title" name="product_title" placeholder="Product Name" style="color:#000;" value="{{$product_to_edit->title}}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="product_description" class="col-sm-3 col-form-label">Description</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_description" name="product_description" placeholder="Product Description" style="color:#000;"value="{{$product_to_edit->description}}">
                        </div>
                      </div>
                      

                      <div class="form-group row">
                        <label for="product_image" class="col-sm-3 col-form-label">Previous Image</label>
                        <div class="col-sm-9">
                          <img style="max-width:150px;margin-bottom:20px;"src="{{url('ProductImages/'.$product_to_edit->image)}}"/>
                          
                      </div>
                      
                      <div class="form-group row">
                        <label for="product_image" class="col-sm-3 col-form-label">New Image</label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control" id="product_image" name="product_image" placeholder="Product Image" style="color:#000;">
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label for="product_category" class="col-sm-3 col-form-label">Category</label>
                        <div class="col-sm-9">
                          <select type="text" class="form-control" id="product_category"name="product_category" placeholder="Product Category" style="color:#000;">
                            <option value="{{$product_to_edit->category}}" style="color:#000;"selected>{{$product_to_edit->category}}</option>
                            @foreach($categories as $category_data)
                            
                            <option value="{{$category_data->category_name}}" style="color:#000;">{{$category_data->category_name}}</option>

                          @endforeach

                        </select>
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label for="product_quantity" class="col-sm-3 col-form-label">Quantity</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Product Quantity" style="color:#000;"value="{{$product_to_edit->quantity}}">
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label for="product_price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Product Price" style="color:#000;"value="{{$product_to_edit->price}}">
                        </div>
                      </div>
                      
                      
                      <div class="form-group row">
                        <label for="product_discount_price" class="col-sm-3 col-form-label">Discount Price</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="product_discount_price" name="product_discount_price" placeholder="Product Discount Price" style="color:#000;"value="{{$product_to_edit->discount_price}}">
                        </div>
                      </div>
                      
                      
                      <button type="submit" class="btn btn-primary me-2">Update Now</button>
                      
                    </form>
                  </div>
                </div>
              </div>
              
              
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:../../partials/_footer.html -->
          
          <!-- partial -->
        </div>