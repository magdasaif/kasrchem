@extends('layouts.master')
@section('css')

@section('title')
الصفحات
@stop
@endsection
@section('page-header')


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

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الصفحات </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">الرئيسية</a></li>
                <li class="breadcrumb-item active">الصفحات</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

            <!--############################################################-->
                    <div class="table-responsive">
                    <button type="button"   class="btn btn-success"><a href="{{route('page.create')}}"   target="_blank"> اضافة صفحة</a>
                        </button>
                     <br><br>
                    <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr  style="color: #17899b;" >
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
                            <td><?php if($Pagee->status==1){echo'<label class="btn btn-success">مفعلة</label>';}else{echo'<label class="btn btn-danger">غير مفعلة</label>';}?></td>
                            <td> 
                             <button type="button" class="btn btn-info" ><a href="{{route('page.edit',$Pagee->id)}}"  target="_blank"> تعديل</a></button>
                             <button class="btn btn-danger" data-catid={{$Pagee->id}} data-toggle="modal" data-target="#delete{{$Pagee->id}}">حذف</button>
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
                </table>
            </div>
            
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
