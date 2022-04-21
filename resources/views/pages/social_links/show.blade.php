@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection

<!--------------------------------------------------------------------------------->
<style>
.fa-facebook {
  background: #3B5998;
  color: white;
  padding: 5px;padding: 5px;
}

.fa-twitter {
  background: #55ACEE;
  color: white;padding: 5px;
}

.fa-google {
  background: #dd4b39;
  color: white;padding: 5px;
}

.fa-linkedin {
  background: #007bb5;
  color: white;padding: 5px;
}

.fa-youtube {
  background: #bb0000;
  color: white;padding: 5px;
}

.fa-instagram {
  background: #125688;
  color: white;padding: 5px;
}

.fa-pinterest {
  background: #cb2027;
  color: white;padding: 5px;
}

.fa-snapchat-ghost {
  background: #fffc00;
  color: white;padding: 5px;
  text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
}

.fa-skype {
  background: #00aff0;
  color: white;padding: 5px;
}

.fa-android {
  background: #a4c639;
  color: white;padding: 5px;
}

.fa-dribbble {
  background: #ea4c89;
  color: white;padding: 5px;
}

.fa-vimeo {
  background: #45bbff;
  color: white;padding: 5px;
}

.fa-tumblr {
  background: #2c4762;
  color: white;
}

.fa-vine {
  background: #00b489;
  color: white;
}

.fa-foursquare {
  background: #45bbff;
  color: white;
}

.fa-stumbleupon {
  background: #eb4924;
  color: white;
}

.fa-flickr {
  background: #f40083;
  color: white;
}

.fa-yahoo {
  background: #430297;
  color: white;
}

.fa-soundcloud {
  background: #ff5500;
  color: white;
}

.fa-reddit {
  background: #ff5700;
  color: white;
}

.fa-rss {
  background: #ff6600;
  color: white;
}
</style>
<!--------------------------------------------------------------------------------->
@section('content')
  <section class="content">
    <div class="container-fluid">
        <div class="row">

        <div class="col-12">
        @include('layouts.messages')

            <div class="card">
              <div class="card-header" >
                <h3 class="card-title">  {{$title}}</h3>

                <div class="card-tools">

                   <button type="button" class="btn btn-sm bbtn" style="height: 30px;">
                        <a href="{{route('social.create')}}" class="aa"> <li class="fa fa-plus-square" ><span> اضافة  </span></li></a>
                        </button>
                        
                        <button type="button" id="btn_delete_all" disabled class="btn  btn-danger btn-sm  aa delelte_all " style=" font-weight: 900;font-size: 13px;">حذف المُحدد</button>


                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
               <!--=======================searchand form ============================-->
               <input type="hidden" name="hidden_blade" id="hidden_blade" value="show" />
                <input type="hidden" name="hidden_blade" id="hidden_model" value="social" />
                                        @include('pages.search_form')
                <!--===========================================================================-->
                <table  id="datatable" class="table table-hover styled-table">
            <!--#############################################################-->
                    <thead>
                        <tr >
                            <th>#</th>
                            <th>اسم الرابط</th>
                            <th> الايقون</th>
                            <th>الحاله</th>
                            <th>الاجراءات</th>
                            <th><input type="checkbox" name="select_all" onclick="checkAll('box1',this)"></th>

                        </tr>
                    </thead>
                    <tbody>
                       <!--=======================body  ============================-->
                      @include('pages.social_links.paginate_social')
                       <!--========================================================-->
                          
                    </tbody>              
               <!--#############################################################-->

		</table>
            </div>
            
          </div>
           <!--========================================================-->
 <?php $type="social";?>
  @include('delete_all_model')
    <!--========================================================--> 
        </div>
        </div>
  </section>
  <script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/delete_all.js') }}"></script>
<script src="{{ URL::asset('/js/search_paginate.js') }}"></script>
@endsection