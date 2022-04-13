  <?php
foreach($childs as $child){
     // echo '<option>'.$type.'</option>';
     
      $extra='';
      for($i=1;$i<=$number;$i++){
         $extra.='-';
      }

      //product have multiple suppliers (parent&childs)
      //supplier have multiple sections (parent&childs)
      //release have multiple sections (parent&childs)
      
        //to check if you come from add or edit form
        if(isset($multi_selected)){//edit
            if(in_array($child->id,$multi_selected)){
                $select_or_no='selected';
            }else{
                $select_or_no='';
            }
        }else{//add
            $select_or_no='';
        }
    
        if(isset($parent_id)){$parent_id=$parent_id;}else{$parent_id=0;}
        if(isset($main_id)){$main_id=$main_id;}else{$main_id=0;}
        if(isset($margin)){$margin=$margin;}else{$margin=0;}

        $colors=array("#4d28de","rgb(0 152 121)","#9d561c","rgb(128 47 143)","rgb(180 191 17)","rgb(207 29 86)","rgb(78 203 209)");

        $new= [
            'childs' => $child->childs,
            'color'=>$colors[$number],
            'margin' =>$margin+30,
            'number'=>$number+1,
             'main_id'=>$main_id,
             'parent_id'=>$parent_id
            //  'main_id'=>$child->id,
            //  'parent_id'=>$parent_id
        ];
        ?>
        @if($child->id!=$main_id)
            <option  style="margin-right:{{$margin}}px;color: {{$color}};" value="{{ $child->id }}" <?php echo $select_or_no;?>> <?php echo $extra;?> {{ $child->name_ar }}</option>
            @if(count($child->childs))
                @include('pages.manageChild',$new)
            @endif 
        @endif
     
<?php 
}
 ?>
