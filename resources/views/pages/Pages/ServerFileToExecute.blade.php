<?php
if(isset($_POST['save_img'])){
    echo'url("add_page_images",$page->id)';
}elseif(isset($_POST['save_page'])){
    echo'route("page.update",$page->id)';
}
?>