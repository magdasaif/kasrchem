@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
<template>
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
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
                <h3 class="card-title">  {{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{route('branches.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table id="datatable" class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الفرع</th>
                            <th>الهاتف</th>
                            <th>البريد الالكترونى</th>
                            <th>الحاله</th>
                            <th>الاجراءات</th>
                            <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($branches as $branche)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$branche->name_ar}}</td>
                            @if($branche->phone=='')<td><span style="color: red;">لا يوجد رقم للهاتف</span></td> 
                             @else
                             <td>{{$branche->phone}}</td>
                             @endif
                            @if($branche->email=='') <td><span style="color: red;">لا يوجد ميل</span></td> 
                            @else
                            <td>{{$branche->email}}</td>
                           @endif
                           
                            <td><?php if($branche->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                        
                            <td>
                                <a href="{{url('branches/'.$branche ->id.'/edit/')}}"  title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
                                /
                                <a href="#" style="font-weight: bold;font-size: 17px;" title="حذف" data-catid="{{$branche->id}}" data-toggle="modal" data-target="#delete{{$branche->id}}"> <i class="fa fa-trash red"></i></a>
						 <!--############################ model for delete #################################-->     
                         <div class="modal modal-danger fade" id="delete{{$branche->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header">
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('branches.destroy',$branche->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$branche->name_ar}}</div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                            </td>
                            <td><input type="checkbox" value="{{$branche->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                        

                        @endforeach
                    
                    </tbody>              
              <!--#############################################################-->

		</table>
            </div>
          
          </div>
           <!--========================================================-->
  <?php $type="branche";?>
  @include('delete_all_model')
  <!--========================================================-->
        </div>
        </div>
  </section>
</template>
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
@endsection
