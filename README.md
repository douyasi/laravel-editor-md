> <h1 align="center">Xetaravel Editor.md</h1>
>
> |Stable Version|Downloads|Laravel|License|
> |:-------:|:------:|:-------:|:-------:|
> |[![Latest Stable Version](https://img.shields.io/packagist/v/XetaIO/Xetaravel-Editor-md.svg?style=flat-square)](https://packagist.org/packages/xetaio/xetaravel-editor-md)|[![Total Downloads](https://img.shields.io/packagist/dt/xetaio/xetaravel-editor-md.svg?style=flat-square)](https://packagist.org/packages/xetaio/xetaravel-editor-md)|[![Laravel 5.6](https://img.shields.io/badge/Laravel->=5.6-f4645f.svg?style=flat-square)](http://laravel.com)|[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/XetaIO/Xetaravel-Editor-md/blob/master/LICENSE)|
>
> A wrapper to use [Editor.md](https://pandao.github.io/editor.md/) with Laravel.
>
> ## Requirement
> ![PHP](https://img.shields.io/badge/PHP->=7.1-brightgreen.svg?style=flat-square)
>
> ## Installation
>
> ```
> composer require xetaio/xetaravel-editor-md
> ```
>
> #### ServiceProviders
> Import the `EditorServiceProvider` in your `config/app.php`:
> ```php
> 'providers' => [
>     //...
>     Xetaio\Editor\EditorServiceProvider::class,
>     //...
> ]
> ```
>
> #### Vendor Publish
> Publish the vendor files to your application (included the config file `config/editor.php` and the `public/vendor/editor.md` directory) :
> ```php
> php artisan vendor:publish --provider="Xetaio\Editor\EditorServiceProvider"
> ```
>
> ### Configuration
> All configuration options can be found in your `config/editor.php` file. For a full configuration options, read the documentation on the [Editor.md](https://pandao.github.io/editor.md/) site.
>
> ### Usage
> To use it with the basic options, just use the helpers included with the plugin:
> ```html
> <!DOCTYPE html>
> <html lang="en">
> <head>
>    <meta charset="UTF-8">
>    <title>Editor.md example</title>
>    {!! editor_css() !!}
> </head>
> <body>
>     <h2>Editor.md example</h2>
>
>     <div id="editormd">
>         <!-- You must hide it with `display:none;` -->
>         <textarea class="form-control" name="content" style="display:none;">
>             # Editor.md for Laravel
>         </textarea>
>     </div>
>
>     {!! editor_js() !!}
>     {!! editor_config(['id' => 'editormd']) !!}
> </body>
> </html>
> ```
>
> #### Advanced usage
> If you want to use your custom options or options that are not in the config file, one of the best way, it to setup your Editor like that :
> ```html
> <!-- layouts/app.blade.php -->
> <!DOCTYPE html>
> <html lang="en">
> <head>
>    <meta charset="UTF-8">
>    <title>Editor.md example</title>
>
>    <!-- Embed Styles -->
>    @stack('styles')
> </head>
> <body>
>    <!-- Content -->
>    @yield('content')
>
>    <!-- Embed Scripts -->
>    @stack('scripts')
> </body>
> </html>
> ```
> ```html
> <!-- controller/my_view.blade.php -->
> @extends('layouts.app')
>
> @push('styles')
>    {!! editor_css() !!}
> @endpush
>
> @push('scripts')
>    {!! editor_js() !!}
>
>    @php
>        $config = [
>            'id' => 'commentEditor',
>            'height' => '350',
>            // Others settings here...
>        ];
>    @endphp
>
>    @include('editor/partials/_comment', $config)
> @endpush
>
> @section('content')
> //...
> <div id="commentEditor">
>    <textarea class="form-control" required="required" style="display:none;" name="content"></textarea>
> </div>
> //...
> @endsection
> ```
> ```html
> <!-- editor/partials/_comment.blade.php -->
> <script type="text/javascript">
> var _{{ array_get($config, 'id', 'myeditor') }};
> $(function() {
>    editormd.emoji = {
>        path : "{{ array_get($config, 'emojiPath', config('editor.emojiPath')) }}",
>        ext : ".png"
>    };
>    _{{ array_get($config, 'id', 'myeditor') }} = editormd({
>        id : "{{ array_get($config, 'id', 'myeditor') }}",
>        width : "{{ array_get($config, 'width', config('editor.width')) }}",
>        height : "{{ array_get($config, 'height', config('editor.height')) }}",
>        saveHTMLToTextarea : {{ array_get($config, 'saveHTMLToTextarea', config('editor.saveHTMLToTextarea')) }},
>        emoji : {{ array_get($config, 'emoji', config('editor.emoji')) }},
>        taskList : {{ array_get($config, 'taskList', config('editor.taskList')) }},
>        tex : {{ array_get($config, 'tex', config('editor.tex')) }},
>        toc : {{ array_get($config, 'toc', config('editor.toc')) }},
>        tocm : {{ array_get($config, 'tocm', config('editor.tocm')) }},
>        codeFold : {{ array_get($config, 'codeFold', config('editor.codeFold')) }},
>        flowChart: {{ array_get($config, 'flowChart', config('editor.flowChart')) }},
>        sequenceDiagram: {{ array_get($config, 'sequenceDiagram', config('editor.sequenceDiagram')) }},
>        path : "{{ array_get($config, 'path', config('editor.path')) }}",
>        imageUpload : {{ array_get($config, 'imageUpload', config('editor.imageUpload')) }},
>        imageFormats : {!! array_get($config, 'imageFormats', json_encode(config('editor.imageFormats'))) !!},
>        imageUploadURL : "{{ array_get($config, 'imageUploadURL', config('editor.imageUploadURL')) }}?_token={{ csrf_token() }}&from=xetaravel-editor-md",
>        pluginPath : "{{ asset(array_get($config, 'pluginPath', config('editor.pluginPath'))) }}/",
>        watch : false,
>        editorTheme : 'mdn-like',
>        placeholder : 'Type your comment here...',
>        toolbarIcons : function () {
>            return [
>                "undo", "redo", "|",
>                "bold", "italic", "quote", "|",
>                "h1", "h2", "|",
>                "help"
>            ];
>        }
>       // Others settings...
>    });
>});
></script>
>```
> ### Upload File
> This package come with a build-in upload feature. You don't have to do anything to get it work.. expect to upload an image. :stuck_out_tongue_winking_eye:
> If you want to do your own uploader, just register a new route and set it to `imageUploadURL` configuration option. (Of course you will need to create your own Controller and action, [take a look here for an exemple](https://github.com/XetaIO/Xetaravel-Editor-md/blob/master/src/Http/Controllers/MarkdownEditorController.php))
> ## Contribute
> If you want to contribute to the project by adding new features or just fix a bug, feel free to do a PR.
