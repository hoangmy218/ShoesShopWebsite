@extends('shop_layout')
@section('content')
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xl-10 ftco-animate">
             <div class="col-md-6">
            <h3 class="mb-4 billing-heading">Login</h3>
            <?php
                $message=Session::get('message');
                 if($message){
                  echo $message;
                  Session::put('message',null);
               }
            ?> 
                  <form action="{{URL::to('user_home')}}" method="post">
                    {{csrf_field()}}
                     
                <!--/<div class="row align-items-end">  --> 
            
                    <div class="form-group">
                        <label for="firstname">Email</label>
                      <input type="text" class="form-control" name="user_email" placeholder="" required> 
                    </div>
                    <div class="form-group">
                        <label for="lastname">Password</label>
                      <input type="password" name="user_password" class="form-control" placeholder="" required><br>
                    </div>

                    <div class="sign-btn text-center">
                        <button type="submit" class="btn btn-theme btn-primary py-3 px-4">Login</button>
                   </div>
                
                  
                </form>

                 <div class="register">
                     <p>Don't have an account? <a href="{{URL::to('/register')}}">Create an account</a></p>
                  </div>
           </div>     


          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->
@endsection