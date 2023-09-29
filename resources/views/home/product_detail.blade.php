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
<section class="product_section layout_padding">
         <div class="container">
            <div class="heading_container heading_center">
               <h2>
                  Product <span>details</span>
               </h2>
            </div>
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div class="box">
                     <div class="img-box">
                        <img src="{{url('ProductImages/'.$product_data->image)}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           {{$product_data->title}}
                        </h5>
                        <h6>
                           ${{$product_data->price}}
                        </h6>
                        
                     </div>
                     <div>
                        <p>{{$product_data->description}}</p>
                     </div>
                  </div>
               </div>
               
         </div>
      </section>

      <section class="product_section layout_padding">
         <div class="container">
            
            <div class="row">
               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div style="text-align:center;">
                  <h1 style="font-size:20px;font-weight:bold;">Comments</h1>

                  <form action="{{url('add_comment')}}" method="POST">
                     @csrf
                     <textarea name="comment"style="height:150px; width:500px;"placeholder="Comment here....."></textarea>
                     <br>
                     <input type="submit" value="Comment" class="btn btn-primary">
                  </form>
               </div>

               <div class="col-sm-12 col-md-12 col-lg-12">
                  <div style="text-align:left;padding-bottom:30px;">
                     <h1 style="font-size:20px;font-weight:bold;">All Comments</h1>
                  </div>



                  @foreach($comments as $comment)
                  <div style="text-align:left;margin-bottom:20px;">
                     <b>{{$comment->name}}</b>
                     <p>{{$comment->comment}}</p>
                     <a href="javascript::void(0);"onclick="reply(this)" data-CommentId="{{$comment->id}}">Reply</a>
                  </div>
                  @foreach($replies as $reply)
                  @if($comment->id==$reply->comment_id)

                  <div style="text-align:left;margin-bottom:20px;padding-left:50px;">
                     <b>{{$reply->name}}</b>
                     <p>{{$reply->reply}}</p>
                     <a href="javascript::void(0);"onclick="reply(this)" data-CommentId="{{$comment->id}}">Reply</a>
                  </div>
                  @endif

                  @endforeach



                  @endforeach
                  

                  <div style="display:none;" class="replyDiv">
                  <form action="{{url('add_reply')}}" method="post">
                     @csrf
                  <input type="text" name="commentId" id="commentId" hidden="">
                     <textarea name="reply"style="height:150px; width:500px;" placeholder="Write Something Here"></textarea>
                     <br>
                     <button type="submit" class="btn btn-secondary" style="background-color:#111;">Reply</button>
                     <a href="javascript::void(0);"class="btn btn-secondary" onclick="reply_close(this)">Close</a>

                     </form>
                  </div>




                  
               </div>


               

               </div>
               
         </div>
      </section>

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


      <script type="text/javascript">
         function reply(caller){
            document.getElementById('commentId').value=$(caller).attr('data-CommentId')
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }
         function reply_close(caller){
            
            $('.replyDiv').hide();
         }
      </script>

      <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });


        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>

   </body>
</html>