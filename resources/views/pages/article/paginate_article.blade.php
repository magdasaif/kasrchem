                       <?php $i = 0; $status=1?>
                       @if(count($articles)!=0 && $articles )
                        @foreach($articles as $article)
                            <tr>
                            <?php $i++;?>
                            <td>{{ $i }}</td>
                            <td><img src="{{$article->getFirstMediaUrl('article','index')}}"></td>
                            <td >{{$article->name_ar}}</td>
                            <td style="font-weight: bold;font-size: 17px;" ><?php if($article->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>
                            <td >{{$article->sort}}</td>
                            <td style="font-weight: bold;font-size: 17px;">
							<a href="{{route('article.edit',encrypt($article->id))}}"  title="تعديل"><i class="fa fa-edit blue"></i></a>
                            

                            / <a  title="حذف" data-catid="{{$article->id}}" data-toggle="modal" data-target="#delete{{$article->id}}"> <i class="fa fa-trash red"></i></a>

                     <!--############################ model for delete #################################-->
          
                    <div class="modal modal-danger fade" id="delete{{$article->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="card-header" >
                                    <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                                </div>
                                <form action="{{route('article.destroy',encrypt($article->id))}}"  method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                    <div class="modal-body">
                                            <h3 class="text-center">
                                                هل تريد الحذف بالفعل؟
                                             </h3>
                                            <input type="hidden" name="Article_id" id="$article->id" value="{{$article->id}}">
                                            <div  style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$article->title_ar}}</div>
                                    </div>
                                    <input type="hidden" name="deleted_image" value="{{$article->image}}">

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">الغاء </button>
                                        <input type="submit" value="حذف"  class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                            </div>
                              <!--#######################################################################################-->
                        </td>
                        <td><input type="checkbox" value="{{$article->id}}" class="box1" onclick="javascript:check();"></td>

                            </tr>
                        
            

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $articles->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $articles->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif