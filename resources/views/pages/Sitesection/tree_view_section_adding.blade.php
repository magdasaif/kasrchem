
                <div class="form-group">
                    <label for="exampleInputEmail1">الأقســــــام</label> 
                    <select class="form-control" name="site_id[]"  multiple  required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')">
                        @foreach ($sections as $site)
                        <?php
                        $color="#c20620";
                        $new=[
                            'childs' => $site->childs,
                            'color'=>'#209c41',
                            'number'=>2,
                            $type="release",
                            'site_id'=>$site->id,
                            $margin="0",
    
                        ];
                        ?>
                            
                        <option style="color:<?php echo $color;?>"  value="{{$site->id}}">-{{$site->site_name_ar}}</option>
                        @if(count($site->childs))
                            @include('pages.products.manageChild',$new)
                        @endif
                        @endforeach
                    </select>
                </div>
    
                
                <hr>
                  