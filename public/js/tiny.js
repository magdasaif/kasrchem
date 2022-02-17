tinymce.init({
    selector: 'textarea.tinymce-editor',
    
    height: 100,
    theme: 'modern',
    plugins: [
    "advlist autolink autosave link image code lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons template textcolor paste fullpage textcolor"
],
//---------------------------دى الحااجات اللى بتظهر---------------------------- //
toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | inserttime preview | forecolor backcolor",
toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
toolbar4: 'undo redo ',
menubar: true,
toolbar_items_size: 'small',
//---------------------------------------------------------------------------------------
style_formats: [
    {title: 'Bold text', inline: 'b'},
    {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
    {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
    {title: 'Example 1', inline: 'span', classes: 'example1'},
    {title: 'Example 2', inline: 'span', classes: 'example2'},
    {title: 'Table styles'},
    {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'},
    
],

//---------------------------------------------------------------------------------------
templates: [
    {title: 'Test template 1', content: 'Test 1'},
    {title: 'Test template 2', content: 'Test 2'}
],

//------------------to add class to image-------------------------
image_class_list: [
{title: 'None', value: ''},
{title: 'image_class', value: 'photo'},
{title: 'Lightbox', value: 'lightbox'}
],
//-------------------------------for upload image------------------

/* enable title field in the Image dialog*/
image_title: true,
/* enable automatic uploads of images represented by blob or data URIs*/
automatic_uploads: true,

file_picker_types: 'file image media',
/* and here's our custom image picker*/
file_picker_callback: function (cb, value, meta) {
var input = document.createElement('input');
input.setAttribute('type', 'file');
input.setAttribute('accept', 'image/*');


input.onchange = function () {
  var file = this.files[0];

  var reader = new FileReader();
  reader.onload = function () {
    /*
      Note: Now we need to register the blob in TinyMCEs image blob
      registry. In the next release this part hopefully won't be
      necessary, as we are looking to handle it internally.
    */
    var id = 'blobid' + (new Date()).getTime();
    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
    var base64 = reader.result.split(',')[1];
    var blobInfo = blobCache.create(id, file, base64);
    blobCache.add(blobInfo);

    /* call the callback and populate the Title field with the file name */
    cb(blobInfo.blobUri(), { title: file.name });
  };
  reader.readAsDataURL(file);
};

input.click();
},
content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'

});