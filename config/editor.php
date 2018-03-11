<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuration option for Editor.md
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration options for Editor.md. For all the
    | configuration options, please see the offcial website of Editor.md :
    | https://pandao.github.io/editor.md/
    |
    */
    'width' => '100%',
    'height' => '640',
    'saveHTMLToTextarea' => 'true',
    'emoji' => 'true',
    'emojiPath' => '//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/',
    'taskList' => 'true',
    'tex' => 'false',
    'toc' => 'true',
    'tocm' => 'false',
    'codeFold' => 'true',
    'flowChart' => 'false',
    'sequenceDiagram' => 'false',
    'path'=> '/vendor/editor.md/lib/',
    'imageUpload' => 'true',
    'imageFormats' => ["jpg", "gif", "png"],
    'imageUploadURL' => '/xetaravel-editor-md/upload/picture',

    /*
    |--------------------------------------------------------------------------
    | Destination Path for uploaded files
    |--------------------------------------------------------------------------
    |
    | Here you may specify where to upload the files.
    |
    */
   'basaUploadPath' => 'editor-md/uploads/content/'
];
