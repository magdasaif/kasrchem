<div class="form-group">
                 <label>التصنيف الرئيسى</label>
                <select   class="form-control main_category" id="main_category_id" name="main_category" required>
                 <option value="" disabled="true" >اختر التصنيف الرئيسى</option> 
                    <option value="{{$video->relation_with_main_category->id}}" selected="true">{{$video->relation_with_main_category->subname_ar}}</option>
                   <?php 
                    foreach($Main_Cat as $Main_Category)
                        { 
                            //if (($Main_Category->id!=$video->relation_with_main_category->id) && ($Main_Category->sub_cate2_count>0)  ) 
                            if (($Main_Category->id!=$video->relation_with_main_category->id))
                             {  
                    ?>
                              <option value="{{$Main_Category->id}}">{{$Main_Category->subname_ar}}</option>
                   <?php 
                            }
                        }
                    ?>
                 </select> 
                 <div  id="main_error" style="color: red;display: none;">قم بادخال التصنيف الرئيسي</div>

                </div>

            
             <!----------------------------------------------------->
             <input type="hidden" value="" id="selected_main">
            <div class="form-group"  id="sub2_div" >    
                    <label>   التصنيف الفرعي </label>

                    <select  class="form-control sub2"  id="sub2_sel" name="sub2" required>
                    <option value="" disabled="true" >اختر التصنيف الفرعي</option>
                    <option value="{{$video->relation_with_sub2_category->id}}" selected="true">{{$video->relation_with_sub2_category->subname2_ar}}</option>
                    <?php 
                    foreach($Sub_Category2 as $Sub_cat2)
                        { if ($Sub_cat2->id!=$video->relation_with_sub2_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat2->id}}">{{$Sub_cat2->subname2_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>
                </select> 
                <div class="form-control" id="sub2_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد تصنيف فرعى للتصنيف الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                     <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal" style="margin-right: 23px;font-weight: bold;"></i>
                      </div>
                 </div>
           

             <!----------------------------------------------------- -->
             
             <div class="form-group"  id="sub3_div" >
                <label>النوع</label>
                 <select  class="form-control sub3"  id="sub3_sel" name="sub3" required>

                 <option value="" disabled="true" >اختر النوع </option>
                    <option value="{{$video->relation_with_sub3_category->id}}" selected="true">{{$video->relation_with_sub3_category->subname_ar}}</option>
                    <?php 
                    foreach($Sub_Category3 as $Sub_cat3)
                        { if ($Sub_cat3->id!=$video->relation_with_sub3_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat3->id}}">{{$Sub_cat3->subname_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                 </select> 
                 </select> 
                 <div class="form-control" id="sub3_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع رئيسي للتصنيف الفرعى المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"   data-toggle="modal" data-target="#exampleModal3" style="margin-right: 23px;font-weight: bold;"></i>
                </div>
                </div>

                <!----------------------------------------------------- -->
                <div class="form-group"  id="sub4_div" > 
                <label>النوع الفرعى</label>
                    <select  class="form-control sub4"  id="sub4_id" name="sub4" required>

                    <option value="" disabled="true" >اختر النوع الفرعى</option>
                    <option value="{{$video->relation_with_sub4_category->id}}" selected="true">{{$video->relation_with_sub4_category->subname_ar}}</option>
                    <?php 
                    foreach($Sub_Category4 as $Sub_cat4)
                        { if ($Sub_cat4->id!=$video->relation_with_sub4_category->id ) 
                            {  
                    ?>
                              <option value="{{$Sub_cat4->id}}">{{$Sub_cat4->subname_ar}}</option>
                   <?php 
                            }
                            else
                            {

                            }
                        }
                    ?>  
                    </select>
                    <div class="form-control" id="sub4_requi" style="display:none;"><span style="color:#d54646;font-weight: bold;"> لا يوجـد نوع فرعى للنوع الرئيسي المختار من فضلك قم باضافته اولا</span>
                    
                    <i  class="nav-icon fas fa-plus green" type="button"  data-toggle="modal" data-target="#exampleModal4" style="margin-right: 23px;font-weight: bold;"></i>
                    </div>
                    </div>
           
               <!----------------------------------------------------->