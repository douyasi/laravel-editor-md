<?php


Route::get('laravel-editor-md/example', function () {
    return view('editor::example');
});
Route::post('laravel-editor-md/upload/picture', 'Douyasi\Editor\Http\Controllers\MarkdownEditorController@postUploadMarkdownEditorPicture');