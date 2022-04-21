                       <?php $i = 0; $status=1?>
                       @if(count($products)!=0 && $products )
                       @foreach($products as $product)
                        <?php $i++;?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->name_ar}}</td>
                            <td><img src="{{$product->getFirstMediaUrl('product','index')}}"></td>                              
                            <td>{{$product->sort}}</td>
                            <td><?php if($product->status==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td>

                            <!-- <td><?php if($product->availabe_or_no==1){echo'<i class="fas fa-check green"></i>';}else{echo'<i class="fas fa-times red"></i>';}?></td> -->

                            <td>
                                <a href="{{ url('img/'.encrypt($product->id)) }}"><button type="button" class="btn btn-sm btn-warning" > الصور</button></a>

                               <a href="{{url('products_files/'.encrypt($product->id))}}"> <button type="button" class="btn btn-sm btn-primary" > الملفات</button></a>
                            </td>


                            <td>
                                <a href="{{route('products.edit',encrypt($product->id))}}" title="تعديل" style="font-weight: bold;font-size: 17px;"><i class="fa fa-edit blue"></i></a>
                                /
                                <a  title="حذف" data-catid="{$product->id}}" data-toggle="modal" data-target="#delete{{$product->id}}"> <i class="fa fa-trash red del"></i></a> 

                              <!--############################ model for delete #################################-->

                              <div class="modal modal-danger fade" id="delete{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                              <div class="modal-content">
                              <div class="card-header" >
                                <h4 class="modal-title " id="myModalLabel">تاكيد الحذف</h4>
                              </div>
                              <form class="delete" action="{{route('product_delete',encrypt($product->id))}}" method="GET">
                              @method('POST')
                             {{csrf_field()}}
                              <div class="modal-body">
                                        <h3 class="text-center">
                                            هل تريد الحذف بالفعل؟
                                          </h3>
                                          <div   style="text-align: center;font-size: 22px;color: red; text-decoration: underline;" > {{$product->name_ar}}</div>
                                    </div>
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
                              <td><input type="checkbox" name="row_checkbox" value="{{$product->id}}" class="box1" onclick="javascript:check();"></td>

                        </tr>

                        @endforeach

                        <tr>
                          <td colspan="8" align="center">
                          
                  
                          @if(isset($searching))
                            {{  $products->appends(request()->input())->links('layouts.paginationlinks') }}
                            @else
                            {{ $products->links('layouts.paginationlinks')}}
                            @endif
                
                          </td>
                          </tr>
                          @else
                            <tr><td colspan="8" style="text-align: center;font-size: 18px;color: red;">لا يوجد بيانات !</td></tr>
                          @endif