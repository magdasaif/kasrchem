@extends('layouts.master')
@section('title')
<title>لوحة التحكم : تغيير كلمة السر</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="row justify-content-center">
    

        <div class="col-8">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> تغيير كلمة السر</h3>

                <div class="card-tools">

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
          <!--========================================================-->

          <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                      
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السر الحالية</label>
  
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">كلمة السـر الجديدة</label>
  
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">تأكيد كلمة السـر الجديدة</label>
    
                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            </div>
                        </div>
   
                        <div class="form-group ">
                            <center>
                                <button type="submit" class="btn btn-primary">
                                   تغيير كلمــة السـر
                                </button>
                             </center>
                        </div>
                    </form>


            <!--========================================================-->
            </div>
          
          </div>
      
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
@endsection
