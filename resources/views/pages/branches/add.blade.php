@extends('layouts.master')
@section('title')
<title>لوحة التحكم : {{$title}}</title>
 @endsection
@section('content')
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
                <h3 class="card-title"> {{$title}}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-sm bbtn" >
                        <a href="{{route('branches.index')}}" class="aa"> <li class="fa fa-building" ><span> قائمه الفروع </span></li></a>
                    </button>
                </div>
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST" action="{{route('branches.store')}}" enctype="multipart/form-data">
            
                @csrf
                {{-- <input name="_token" value="{{csrf_token()}}"> --}}
                 <!---------------------------name_ar-------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالعربيه</label>
                    <input type="text" class="form-control"  aria-describedby="emailHelp" value="{{old('name_ar')}}" placeholder="اسم الفرع بالعربية" name="name_ar" id="regax_name_ar" onkeyup="check_regax_name_ar();"   required oninvalid="this.setCustomValidity('يجب ان يكون اسم الفرع باللغة العربية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">

                    <span style="color:red;display:none;font-weight: bold;" id="error_name"> يجب ان يكون اسم الفرع باللغة العربية وايضا لا يكون ارقام فقط</span>

                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------name_en-------------------------->
                 <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('name_en')}}" placeholder="اسم الفرع بالانجليزية" name="name_en" required onkeypress="return CheckEnglishCharactersOnly(event);"  oninvalid="this.setCustomValidity('يجب ان يكون اسم الفرع باللغة الانجليزية وايضا لا يكون ارقام فقط')"  oninput="this.setCustomValidity('')">
                    <span style="color:red;display:none;font-weight: bold;" id="error_name_en"> يجب ان يكون اسم الفرع باللغة الانجليزية وايضا لا يكون ارقام فقط</span>

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------address_ar-------------------------->
                 <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان الفرع بالعربية" name="address_ar" required>{{old('address_ar')}}</textarea>
                    @error('address_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------address_en-------------------------->
               <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="عنوان الفرع بالانجليزيه" name="address_en" required>{{old('address_en')}}</textarea>
                    @error('address_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------email-------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكترونى</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}"  >
                     @error('email')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!---------------------------phone-------------------------->
                <div class="form-group">
                    <label for="exampleInputEmail1"> الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="{{old('phone')}}"  >
                     @error('phone')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------sort-------------------------->
                     <div class="form-group">
                    <label for="exampleInputEmail1"> الفاكس</label>
                    <input type="text" class="form-control" name="fax" value="{{old('fax')}}"  >
                     @error('fax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                 <!---------------------------sort-------------------------->
                 <div class="form-group">
                    <label for="sort">الترتيب*</label>
                    <input type="number" class="form-control" id="sort" aria-describedby="sort" placeholder="ادخل الترنيب" name="sort"  value="{{ old('sort') }}"  required oninvalid="this.setCustomValidity('قم بادحال الترتيب')"  oninput="this.setCustomValidity('')">
                    @error('sort')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div> 
              <!---------------------------status-------------------------->

                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" {{ old('status') == '1' ? "selected" : "" }}>مُفعل</option>
                            <option value="0" {{ old('status') == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>
              <!----------------------------------------------------->
                <hr>

                <div class="form-group">
                   <!-- <div id="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.7108075704655!2d30.83655031457593!3d29.320157559377936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459793cff58fb35%3A0x79bae666057d7920!2sFayoum%20University!5e0!3m2!1sen!2seg!4v1642668929461!5m2!1sen!2seg" width="450" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                   <!-- </div> -->
                   <div class="container">
                       <!-- <div id="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.7108075704655!2d30.83655031457593!3d29.320157559377936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459793cff58fb35%3A0x79bae666057d7920!2sFayoum%20University!5e0!3m2!1sen!2seg!4v1642668929461!5m2!1sen!2seg" width="450" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                   <!-- </div> -->
                   <div class="container">
                        <div class="row">
                            <div class="col-sm">
                                <label for="exampleInputEmail1">خطوط الطول</label>
                                <input type="text" name="longitude" id="map_long" class="form-control MapLon" value="{{old('longitude')}}" required>
                             </div>
                            <div class="col-sm">
                                <label for="exampleInputEmail1">دوائر العرض</label>
                                <input type="text" name="latitude" id="map_lat" class="form-control MapLat" value="{{old('latitude')}}" required>
                            </div>
                        </div>
                    </div>
                    <br>

                   <center><div id="map_canvas" style="height: 350px;width:70%;margin: 0.6em;"></div></center>
                </div>
               <!----------------------------------------------------->
              <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>

<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ URL::asset('/js/regax_name/regax_name.js') }}"></script>

<script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>

<script>
		///-----------------------------------------------------------------------------------------------------
		$(function () {
			
		
		
            var lat = 29.326250,
                lng = 30.829290,
                latlng = new google.maps.LatLng(lat, lng),
                image = 'http://www.google.com/intl/en_us/mapfiles/ms/micons/blue-dot.png';
   
       
            //zoomControl: true,
            //zoomControlOptions: google.maps.ZoomControlStyle.LARGE,
   
            var mapOptions = {
                center: new google.maps.LatLng(lat, lng),
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                panControl: true,
                panControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                zoomControl: true,
                zoomControlOptions: {
                    style: google.maps.ZoomControlStyle.LARGE,
                    position: google.maps.ControlPosition.TOP_left
                }
            },
            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions),
                marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: image
                });
   
            var input = document.getElementById('searchTextField');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ["geocode"]
            });
   
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
   
            google.maps.event.addListener(autocomplete, 'place_changed', function (event) {
                infowindow.close();
                var place = autocomplete.getPlace();
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }
   
                moveMarker(place.name, place.geometry.location);
                $('.MapLat').val(place.geometry.location.lat());
                $('.MapLon').val(place.geometry.location.lng());
            });
            google.maps.event.addListener(map, 'click', function (event) {
                $('.MapLat').val(event.latLng.lat());
                $('.MapLon').val(event.latLng.lng());
                infowindow.close();
                        var geocoder = new google.maps.Geocoder();
                        geocoder.geocode({
                            "latLng":event.latLng
                        }, function (results, status) {
                            console.log(results, status);
                            if (status == google.maps.GeocoderStatus.OK) {
                                console.log(results);
                                var lat = results[0].geometry.location.lat(),
                                    lng = results[0].geometry.location.lng(),
                                    placeName = results[0].address_components[0].long_name,
                                    latlng = new google.maps.LatLng(lat, lng);
   
                                moveMarker(placeName, latlng);
                                $("#searchTextField").val(results[0].formatted_address);
                            }
                        });
            });
           
            function moveMarker(placeName, latlng) {
                marker.setIcon(image);
                marker.setPosition(latlng);
                infowindow.setContent(placeName);
                //infowindow.open(map, marker);
            }
        });
</script>
@endsection