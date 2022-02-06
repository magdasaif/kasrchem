@extends('layouts.master')
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
              <div class="card-header" >
              <h3 class="card-title"> الصفحات</h3>

                <div class="card-tools">

                 <button type="button" class="btn btn-sm " style=" background-color: #343a40;">
                        <a href="{{route('page.create')}}" style="color: #fff; !important"> <li class="fa fa-plus-square" ><span> اضافه </span></li></a>
                    </button>
                        

                </div>
              </div> 
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover " >
            <!--#############################################################-->
                  <thead>
                        <tr >
                        <th>#</th>
                        <th>اسم الصفحة</th>
                        <th>الحالة</th>
                        <th>الاجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php $i = 0; $status=1?>
                        @foreach($Page as $Pagee)
                            <tr>
                            <?php $i++; ?>
                            <td>{{ $i }}</td>
                            <td>{{$Pagee->title_ar}}</td>
							<td><?php if($Pagee->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
 
							<td>
							<a href="{{route('page.edit',$Pagee->id)}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
							/
					        <a  title="حذف" data-catid="{{$Pagee->id}}" data-toggle="modal" data-target="#delete{{$Pagee->id}}"> <i class="fa fa-trash red"></i></a>

                             <!-- <button class="btn btn-danger" data-catid={{$Pagee->id}} data-toggle="modal" data-target="#delete{{$Pagee->id}}">حذف</button> -->
							 
                            </td>
                            </tr>
                        <!--############################ model for delete #################################-->
          
                            <div class="modal modal-danger fade" id="delete{{$Pagee->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header" style="direction: ltr;">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('page.destroy',$Pagee->id)}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="Page_id" id="$Pagee->id" value="{{$Pagee->id}}">
                                            <div  name="Page_title_ar" style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$Pagee->title_ar}}</div>
                                   </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <button type="submit" class="btn btn-success">حذف</button>
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->

                        @endforeach

                    </tbody>
							
			 <!--#############################################################-->

		</table>
            </div>
            <!-- /.card-body -->
            <!-- <div class="card-footer">
                  <pagination :data="products" @pagination-change-page="getResults"></pagination>
            </div> -->
            <!-- /.card -->
          </div>
        </div>
        </div>
  </section>
</template>
@endsection