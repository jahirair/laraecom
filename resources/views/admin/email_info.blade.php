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
              <h3 class="page-title"> Send Email </h3>
              
            </div>
            <div class="row">
              
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="">Send Email to {{$order_datas->email}}</h4>
                    <p class="card-description" style="margin-top:20px;"> </p>
                    <form class="forms-sample" action="{{url('send_buyer_email',$order_datas->id)}}" method='POST'>
                    @csrf
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Email Greeting</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="greeting" placeholder="Greetings" style="color:#fff;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Email First Line</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="firstline" placeholder="First Line/Subject" style="color:#fff;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Email Body</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="body" placeholder="Message Body" style="color:#fff;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Email Button</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="button" placeholder="Button Text" style="color:#fff;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">My url</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="url" placeholder="Your Website url" style="color:#fff;">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="category_name" class="col-sm-3 col-form-label">Last Line</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="category_name" name="lastline" placeholder="Last Line" style="color:#fff;">
                        </div>
                      </div>
                      
                      <button type="submit" class="btn btn-primary me-2">Send Email Now</button>
                      
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
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
  </body>
</html>