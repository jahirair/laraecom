

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
              
                            <!--Table Start-->
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Categories table</h4>
                    
                    
                    <div class="table-responsive">
                      <table class="table table-bordered" style="color:#fff;">
                        <thead>
                          <tr >
                            <th style="color:#fff;"> Ser No </th>
                            <th style="color:#fff;"> Category Name </th>
                            <th style="color:#fff;"> Action </th>
                            
                          </tr>
                        </thead>
                        <tbody>
                        @php $i=0;@endphp
                        @foreach($data as $category_data)
                          <tr>
                            <td> {{++$i}} </td>
                            <td> {{$category_data->category_name}} </td>
                            <td> 
                              <a class="btn btn-danger"href="{{url('delete_category',$category_data->id)}}" onclick="confirm('Are you sure to delete it?')">Delete</a>
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