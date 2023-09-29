

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
              <h3 class="page-title"> Categories </h3>
              
            </div>
            <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Category</h4>
                    <p class="card-description"> </p>
                    <form class="forms-sample" action="{{url('save_category')}}" method='POST'>
                    @csrf
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="cat_name" placeholder="Category Name" style="color:#fff;">
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary me-2">Add Now</button>
                      
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