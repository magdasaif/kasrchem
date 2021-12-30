<?php
//symlink('/home/murabb/public_html/storage/app/public', '/home/murabb/public_html/public/storage');

$src    = pathinfo(__DIR__, PATHINFO_DIRNAME );
$src    .= "\storage\app\public";
$trgt   = pathinfo(__FILE__, PATHINFO_DIRNAME);
$trgt   .= "\storage";

if(file_exists($trgt)):
        echo "SymLink Already Exist </br>";
        echo "Ulink The Previous Link To $trgt </br>";
        unlink($trgt);
        echo "Creating Symlink from ". $src . " Into " .$trgt . "</br>";
        symlink("$src", "$trgt");
else:
        echo "Creating Symlink from ". $src . " Into " .$trgt . "</br>";

        symlink("$src", "$trgt");
endif;
echo "DONE";
