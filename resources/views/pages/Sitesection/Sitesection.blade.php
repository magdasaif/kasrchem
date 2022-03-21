@extends('layouts.master')
@section('title')
<title>لوحة التحكم : أقسام الموقع</title>
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
                <h3 class="card-title">أقسام الموقع</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn">
                        <a href="{{URL('site_section/create')}}" class="aa"> <li class="fa fa-plus-square" ><span>اضافة قسم جديد</span></li></a>
                        </button>
                        

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover styled-table">
                  <thead>
                    <tr>
                      <th>#</th>
                        <th>اسم القسم</th>
                        <th>الصورة</th>
                        <th>الأولوية</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                    </tr>
                  </thead>
                  
                   <tbody>
                         <?php $i = 0; $statues=1?>

                        @foreach($site_section as $section)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$section->site_name_ar}}</td>

                            <td><img  style="width: 90px; height: 90px;" src=<?php echo asset("storage/site_sections/site_section_image/{$section->image}")?> alt="" ></td>
                            <td>{{$section->priority}}</td>

                           

                            <td><?php if($section->statues==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                              <td> 
                                <a href="{{route('site_section.edit',$section->id)}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                   /
                                   <a   onclick=" check_related_section('{{$section->id}}','{{$section->site_name_ar}}');" title="حذف" data-catid="{{$section->id}}" data-toggle="modal" data-target="#delete{{$section->id}}"> <i class="fa fa-trash red del"></i></a> 

                                  <!--############################ model for delete #################################-->

                                  <div class="modal modal-danger fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="card-header" >
                                      <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                    </div>
                                    <form class="delete" action="{{route('site_section.destroy',$section->id)}}" method="post">
                                      {{method_field('delete')}}
                                      {{csrf_field()}}
                                    <div class="modal-body">
                                      <!-----------------footer and content from javascript basedon related or not with section-------->
                                            
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
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script>


function check_related_section(section_id,site_name_ar)
{
            //alert("inside onclick");
            //alert("section_id="+section_id);  
              // alert("{{ URL::to('check_section')}}/" + section_id);

            $.ajax({
                type: "GET",
                 url: "{{ URL::to('check_section')}}/" +section_id,
             //dataType: "json",
                success: function (data) 
                {
                //alert ("data="+data) ;
                    if(data!='')
                    { 
                        $('.modal-body').empty();
                        $('.modal-body').append('<div  style="text-align: center;font-size:18px;color: red;" >'+site_name_ar +' </div><h2 style="text-align: center;font-size: 18px;color: black;" > مرتبط  ب  <h3  style="text-align: center;font-size: 18px;color: blue;">'+data+'</h3> <h3 style="text-align: center;font-size: 18px;color: black;" >قم بتغيير القسم اولا</h3></h2></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button><input id="del_button" type="submit" value="حذف"  class="btn btn-primary" disabled > </div>');
                    }
                    else
                    {
                    

                   $('.modal-body').empty();
                     $('.modal-body').append('<div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >'+ site_name_ar+'</div><h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هل تريد الحذف بالفعل؟</h3></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button> <input id="del_button" type="submit" value="حذف"  class="btn btn-primary" >  </div>');
                    //document.getElementById("del_button").disabled = false;
                    }
                    
                },
                error:function()
                { alert("false"); }
            });
// });
}
  


</script>
@endsection

