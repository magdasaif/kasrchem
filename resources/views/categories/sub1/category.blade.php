@extends('layouts.master')
@section('title')
<title>لوحة التحكم : التصنيفات الرئيسيه</title>
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

            @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
            @endif
          
        
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> التصنيفات الرئيسيه</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{URL('categories/create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة تصنيف </span></li></a>
                        </button>
                        

                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الصوره</th>
                            <th>اسم التصنيف</th>
                            <th>الحاله</th>
                            <th>عدد التصنيفات</th>
                            <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1;?>
                        @foreach($categories as $category)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>

                            <td><img  style="width: 90px; height: 90px;" src="<?php echo asset("storage/categories/first/$category->image")?>"></td>

                            <td>{{$category->subname_ar}}</td>
                            <td><?php if($category->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td><a href="{{url('categories2/'.$category ->id)}}"><label class="btn btn-success">{{$category->sub_cate2_count}}</label></a></td> 
                            <td>
                                <a href="{{url('categories/'.$category ->id.'/edit/')}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                &nbsp; / &nbsp;
                                <a   onclick=" theFunction('{{$category->id}}','{{$category->subname_ar}}');" title="حذف" data-catid="{{$category->id}}" data-toggle="modal" data-target="#delete{{$category->id}}"> <i class="fa fa-trash red del"></i></a> 

                                 <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="displays:none">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                               <form class="delete" action="{{ route('categories.destroy',$category->id) }}" method="POST">
                                <div class="modal-body">

                                    
                                       </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="_method" value="DELETE">
                                       <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                      
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                      <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                   

                                </form>
                                </div>
                            </div>
                            </div>
                     <!--#############################################################-->
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
          
          </div>
        </div>
        </div>
  </section>
</template>
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script>


function theFunction(cate_id,cate_name)
{
   // alert("inside onclick");
  //alert("cate_id="+cate_id);  
    // alert("{{ URL::to('found_for_delete_sub1')}}/" + cate_id);
            $.ajax({
                type: "GET",
                 url: "{{ URL::to('found_for_delete_sub1')}}/" + cate_id,
                dataType: "json",
                success: function (data) 
                {
                  // alert ("data="+data) ;
                    if(data!='')
                    { 
                       
                    $('.modal-body').empty();
                  //   document.querySelector(".modal-body").innerHtml='<div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >'+ cate_name+' </div><h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هذا التصنيف الرئيسى مرتبط هل تريد الحذف بالفعل؟</h3>';

                 $('.modal-body').append('<div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >'+ cate_name+' </div><h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هذا التصنيف الرئيسى مرتبط هل تريد الحذف بالفعل؟</h3>');
                 $('.fade').show();
                    }
                    else
                    {
                       
                        $('.modal-body').empty();
                       //  document.querySelector(".modal-body").innerHtml='<div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >'+ cate_name+' </div><h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هل تريد الحذف بالفعل؟</h3>';
                       $('.modal-body').append('<div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >'+ cate_name+'</div><h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هل تريد الحذف بالفعل؟</h3>');
                    }
                    
                },
                error:function()
                { alert("false"); }
            });
// });
}
  
</script>