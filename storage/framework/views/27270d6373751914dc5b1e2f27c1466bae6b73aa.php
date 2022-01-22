
<?php $__env->startSection('css'); ?>

<?php $__env->startSection('title'); ?>
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>


<?php if(Session::has('success')): ?>

    <div class="alert alert-success">
           <?php echo e(Session::get('success')); ?>

    </div>
    <?php endif; ?>


    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

<div>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" style="color: #2569b1;"><?php echo e($title); ?></h5>
           
        </div>
        <div class="modal-body">
            
            <form method="POST" action="<?php echo e(route('branches.store')); ?>" enctype="multipart/form-data">
            
                <?php echo csrf_field(); ?>
                

                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالعربيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo e(old('name_ar')); ?>" placeholder="Enter name" name="name_ar" required>
                    <?php $__errorArgs = ['name_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">اسم الفرع بالانجليزيه</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo e(old('name_en')); ?>" placeholder="Enter name" name="name_en" required>
                    <?php $__errorArgs = ['name_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <hr>

                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالعربيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name="address_ar" required><?php echo e(old('address_ar')); ?></textarea>
                    <?php $__errorArgs = ['address_ar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="form-group">
                    <label for="exampleInputEmail1">عنوان الفرع بالانجليزيه</label>
                    <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name="address_en" required><?php echo e(old('address_en')); ?></textarea>
                    <?php $__errorArgs = ['address_en'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <hr>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">البريد الالكترونى</label>
                    <input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                     <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1"> الهاتف</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo e(old('phone')); ?>" required>
                     <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1"> الفاكس</label>
                    <input type="text" class="form-control" name="fax" value="<?php echo e(old('fax')); ?>" required>
                     <?php $__errorArgs = ['fax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <small class="form-text text-danger"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <hr>

                <div class="form-group">
                   <!-- <div id="map"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3478.7108075704655!2d30.83655031457593!3d29.320157559377936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1459793cff58fb35%3A0x79bae666057d7920!2sFayoum%20University!5e0!3m2!1sen!2seg!4v1642668929461!5m2!1sen!2seg" width="450" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe> -->
                   <!-- </div> -->
                   
					<div id="map_canvas" style="height: 350px;width:450px;margin: 0.6em;"></div>
			        <input type="hidden" name="map_long" id="map_long" class="form-control MapLon" value="<?php echo e(old('map_long')); ?>" readonly>
                    <input type="hidden" name="map_lat" id="map_lat" class="form-control MapLat" value="<?php echo e(old('map_lat')); ?>" readonly>
                        
                    
                </div>
                
                <br>
                <div class="form-group">
                    <label for="exampleInputEmail1">الحالة</label>
                    <select class="form-control" name="status">
                            <option value="1" <?php echo e(old('status') == '1' ? "selected" : ""); ?>>مُفعل</option>
                            <option value="0" <?php echo e(old('status') == '0' ? "selected" : ""); ?>>غير مُفعل</option>
                    </select>
                </div>

            
                <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">اضافه</button>
                </div>
                </form>
        </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\eradco-backend\final\backend\resources\views\pages\branches\add.blade.php ENDPATH**/ ?>