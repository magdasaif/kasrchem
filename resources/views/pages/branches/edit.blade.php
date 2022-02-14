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
              </div>
 <!--#############################################################-->
 <div class="modal-body">
            
            <form method="POST" action="{{route('branches.update',$branch->id)}}" enctype="multipart/form-data">
            {{method_field('PATCH ')}}
                @csrf

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$branch->name_ar}}" placeholder="Enter name" name="name_ar" required oninvalid="this.setCustomValidity('قم بادخال اسم الفرع بالعربية')"  oninput="this.setCustomValidity('')">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <input type="hidden" name="id" value="{{$branch->id}}">
                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$branch->name_en}}" placeholder="Enter name" name="name_en" required oninvalid="this.setCustomValidity('قم بادخال اسم الفرع بالانجليزية')"  oninput="this.setCustomValidity('')">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name="address_ar" required>{{$branch->address_ar}}</textarea>
                    @error('address_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name="address_en" required>{{$branch->address_en}}</textarea>
                    @error('address_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكترونى</label>
                    <input type="text" class="form-control" name="email" value="{{$branch->email}}" required oninvalid="this.setCustomValidity('قم بادخال البريد الالكترونى')">
                     @error('email')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1"> الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="{{$branch->phone}}" required oninvalid="this.setCustomValidity('قم بادخال رقم التليفون')">
                     @error('phone')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1"> الفاكس</label>
                    <input type="text" class="form-control" name="fax" value="{{$branch->fax}}" required oninvalid="this.setCustomValidity('قم بادخال رقم الفاكس')">
                     @error('fax')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <hr>

                <div class="form-group">
                                      
					<center><div id="map_canvas" style="height: 350px;width:70%;margin: 0.6em;"></div></center>
			        <input type="hidden" name="map_long" id="map_long" class="form-control MapLon" value="{{$branch->longitude}}" readonly>
                    <input type="hidden" name="map_lat" id="map_lat" class="form-control MapLat" value="{{$branch->latitude}}" readonly>
                        
                    
                </div>
                
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" {{ $branch->status == '1' ? "selected" : "" }}>مُفعل</option>
                            <option value="0" {{ $branch->status == '0' ? "selected" : "" }}>غير مُفعل</option>
                    </select>
                </div>

            
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تعديل</button>
                </div>
                </form>
                </div>
 <!--#############################################################-->

 		</div>
            </div>
        </div>
    </div>
</section>
</template>
@endsection
<script src="{{ URL::asset('/js/jquery-3.3.1.min.js') }}"></script>

<script src="https://maps.google.com/maps/api/js?libraries=places&region=uk&language=en&sensor=true"></script>

<script>


		///-----------------------------------------------------------------------------------------------------
		$(function () {
			
		
		
            var lat = document.getElementById('map_lat').value,
                lng = document.getElementById('map_long').value,
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