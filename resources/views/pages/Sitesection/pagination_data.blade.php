  <?php $i = 0; $status=1?>
                         @if($searching_count != 0 && $Sitesections)
                        @foreach($Sitesections as $section)
                            <tr>
                            <?php $i++;?>
                            <td> {{$i}}</td> 
                            <td>{{$section->name_ar}}</td>
                            <td> <img src="{{$section->getFirstMediaUrl('sections','index')}}" /> </td>
                            <td>{{$section->sort}}</td>
                           <td><?php if($section->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                              <td> 
                                <a href="{{route('site_section.edit',encrypt($section->id))}}" style="font-weight: bold;font-size: 17px;" title="تعديل"><i class="fa fa-edit blue"></i></a>
                                   /
                                   <!-- {{-- <a   onclick=" check_related_section('{{$section->id}}','{{$section->site_name_ar}}');" title="حذف" data-catid="{{$section->id}}" data-toggle="modal" data-target="#delete{{$section->id}}"> <i class="fa fa-trash red del"></i></a>  --}} -->
                                   <a    title="حذف" data-catid="{{$section->id}}" data-toggle="modal" data-target="#delete{{$section->id}}"> <i class="fa fa-trash red del"></i></a> 

                                  <!--############################ model for delete #################################-->

                                  <div class="modal modal-danger fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="card-header" >
                                      <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                    </div>
                                    <form class="delete" action="{{route('site_section.destroy',encrypt($section->id))}}" method="post">
                                    {{method_field('delete')}}
                                      {{csrf_field()}}
                                    <div class="modal-body">
                                      <!-----------------footer and content from javascript basedon related or not with section-------->
                                      <div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" >{{$section-> name_ar}}</div>
                                      <h3 style="text-align: center;font-size: 22px;color: black;" class="text-center">هل تريد الحذف بالفعل؟</h3>
                                       </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                       <input id="del_button" type="submit" value="حذف"  class="btn btn-primary" >  
                                      </div>  
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                    <!--#############################################################-->
                           </td>

                            </tr>
                        @endforeach
                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $Sitesections->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $Sitesections->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                        @else
                             <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                           @endif
                 