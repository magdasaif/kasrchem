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

             @if(Session::has('msg'))
             <div class="alert alert-danger">
             {{Session::get('msg')}}
              <ol> 
                 @foreach(session::get('data')  as $child_sections)
                  <li style="color:green;font-size:15px">{{$child_sections}}</li>
                 @endforeach
             </ol>
             {{Session::get('msg2')}}
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


        <div class="modal fade" id ="Registration">
          <div class="container">
            <form role="form" class="center-block" method="POST">
                  <div class="form-group">
                      <div class="ct-form-content">
                          <div class="row">
                              <div class="col-md-6">
                                  <label>First Name</label>
                                  <input type="text" required class="form-control input-lg" value="Kristine" placeholder="">
                                  <label>Last Name</label>
                                  <input type="text" required class="form-control input-lg" value="Black" placeholder="">
                                  <label>Number of Properties</label>
                                  <input type="text" required class="form-control input-lg" value="15" placeholder="">
                                  <label>Include contact form?</label>
                              </div>
                           </div>
                          <button type="submit" class="btn btn-success center-block">Save changes</button>
                      </div>
                      <div class="ct-form-close"><i class="fa fa-times"></i></div>
                  </div>
              </form>
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
       //alert ("all_data1="+data) ;
        //alert("first_element"+data[1]); //type
        
       // alert ("all_datalength="+data.length) ;
        
        if(data!='')
        { 
          //#################################################################//
        var all_data=[];
      if(data.length==13)
        {
          // alert("together") ;
         all_data.push(data[0],data[1],data[2]);
         for( var i = 0; i < data[3].length; i++)
            { 
              //alert (data[3][i]); //اسماء النشرات
           all_data.push(data[3][i].link("{{ URL::to('release')}}/"+data[11][i]+"/edit", "_blank"));
            }
            all_data.push(data[4],data[5],data[6],data[7],data[8]);
            for( var i = 0; i < data[9].length; i++)
            { 
              //alert (data[9][i]); //اسماءالموردين
           all_data.push(data[9][i].link("{{ URL::to('supplier')}}/"+data[12][i]+"/edit", "_blank"));

           }
            all_data.push(data[10]);
           // alert("release_element"+data[11]);//release_ids
            //alert("supplier_element"+data[12]);//supplier_ids
        }




        else if(data.length==4)
        {
           all_data.push(data[0],data[1]);
          for( var i = 0; i < data[2].length; i++)
            { 
              //alert (data[2][i]); //اسماء النشرات
              all_data.push(data[2][i].link("{{ URL::to('release')}}/"+data[3][i]+"/edit", "_blank"));
              
              

            }
        }

        else if(data.length==5)
        {
         all_data.push(data[0],data[1],data[2]);
          for( var i = 0; i < data[3].length; i++)
            { 
              //alert (data[3][i]);//اسماء الموردين
           all_data.push(data[3][i].link("{{ URL::to('supplier')}}/"+data[4][i]+"/edit", "_blank"));

            }
            //alert("supplier_element"+data[4]);//supplier_ids
        }
  //##########################################//
            $('.modal-body').empty();
           $('.modal-body').append('<div  style="text-align: center;font-size:18px;color: red;" > <span style="font-size: 18px;color: black;" >القسم &nbsp;</span>'+site_name_ar +' </div><h2 style="text-align: center;font-size: 18px;color: black;" > مرتبط  ب  <h3  style="text-align: center;font-size: 18px;color: red;" >'+all_data.join(' ')+'</h3> <h3 style="text-align: center;font-size: 18px;color: black;" >قم بتغيير القسم اولا</h3></h2></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button><input id="del_button" type="submit" value="حذف"  class="btn btn-primary" disabled > </div>');

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

