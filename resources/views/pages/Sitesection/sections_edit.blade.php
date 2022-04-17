<select class="form-control" name="site_id[]"  multiple required oninvalid="this.setCustomValidity('اختر القسم')"  oninput="this.setCustomValidity('')">
                            
                        @foreach ($sections as $sec)
                        <?php
                            $margin="0";
                            $color="#c20620";
                            $size="15";
                            $number=2;
                            if(in_array($sec->id,$selected_sections)){
                                $select_or_no='selected';
                            }else{
                                $select_or_no='';
                            }


                           $new= [
                                'childs' => $sec->childs,
                                'margin'=>$margin+30,
                                'color'=>'#209c41',
                                'size'=>$size-1,
                                'multi_selected'=>$selected_sections,
                                'number'=>$number
                            ];
                        ?>
                            <option style="margin-right:{{$margin}}px;color: {{$color}};font-size: {{$size}}px;" value="{{ $sec->id }}" <?php if (collect(old('section_id'))->contains($sec->id)) {echo 'selected';}else{echo $select_or_no;}?>> - {{ $sec->name_ar }}</option>
                            @if(count($sec->childs))
                                @include('pages.manageChild',$new)
                            @endif
                        @endforeach
                        
                    </select>