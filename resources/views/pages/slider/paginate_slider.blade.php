                       <?php $i = 0; $status=1?>
                       @if(count($Slider)!=0 && $Slider )
                       @foreach($Slider as $slider)
                            <tr>
                                
                            <?php $i++;?>
                            <td>{{ $i }}</td>
                            <td><img src="{{$slider->getFirstMediaUrl('slider','index')}}"></td>                              
                            <td>{{$slider->sort}}</td>
							<td style="font-weight: bold;font-size: 17px;"><?php if($slider->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                             
							<td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('slider.edit',encrypt($slider->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                           
                             / &nbsp;
                                <a  title="حذف" data-catid="{{$slider->id}}" data-toggle="modal" data-target="#delete{{$slider->id}}"> <i class="fa fa-trash red del"></i></a> 

 <!--############################ model for delete #################################-->
          
                         <div class="modal modal-danger fade" id="delete{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="direction: ltr;">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form class="delete" action="{{route('slider.destroy',encrypt($slider->id))}}" method="POST">
                                   
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                             <img  style="width: 90px;" src=<?php echo asset("storage/slider/{$slider->filename}")?> alt="" >
                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$slider->filename}}">
                                    <div class="modal-footer">
                                   
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
            <!--#############################################################-->
                        </td>
                        <td ><input type="checkbox" name="row_checkbox" value="{{$slider->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                       

                        @endforeach
                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $Slider->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $Slider->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif