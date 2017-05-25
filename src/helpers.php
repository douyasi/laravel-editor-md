<?php

if (!function_exists('format_json_message')) {
    /**
     * Format the form validation message and return it as a json.
     *
     * @param array $messages The messages to format.
     * @param array $json The array to convert to json.
     *
     * @return array
     */
    function format_json_message($messages, $json)
    {
        $reasons = '';
        foreach ($messages->all(':message') as $message) {
            $reasons .= $message.' ';
        }
        $info = '失败原因为：'.$reasons;
        $json = array_replace($json, ['info' => $info]);

        return $json;
    }
}

if (!function_exists('editor_css')) {
    /**
     * The CSS used by Editor.md
     *
     * @return string
     */
    function editor_css()
    {

        return '<!-- editor.md css -->
    <link rel="stylesheet" href="/vendor/editor.md/css/editormd.preview.min.css" />
    <link rel="stylesheet" href="/vendor/editor.md/css/editormd.min.css" />
    <style type="text/css">
    .editormd-fullscreen {
        z-index: 2147483647;
    }
    </style>';
    }
}

if (!function_exists('editor_js')) {
    /**
     * The JS used by Editor.md
     *
     * @param string $lang The language to use.
     *
     * @return string
     */
    function editor_js($lang = 'en')
    {

        return '<!-- editor.md js -->
    <script type="text/javascript">
        window.jQuery || document.write(unescape("%3Cscript%20type%3D%22text/javascript%22%20src%3D%22//cdn.bootcss.com/jquery/2.2.4/jquery.min.js%22%3E%3C/script%3E"));
    </script>
    <script src="/vendor/editor.md/lib/marked.min.js"></script>
    <script src="/vendor/editor.md/lib/prettify.min.js"></script>
    <script src="/vendor/editor.md/lib/raphael.min.js"></script>
    <script src="/vendor/editor.md/lib/underscore.min.js"></script>
    <script src="/vendor/editor.md/lib/sequence-diagram.min.js"></script>
    <script src="/vendor/editor.md/lib/flowchart.min.js"></script>
    <script src="/vendor/editor.md/lib/jquery.flowchart.min.js"></script>
    <script src="/vendor/editor.md/js/editormd.min.js"></script>
    <script src="/vendor/editor.md/languages/' . $lang . '.js"></script>';
    }
}

if (!function_exists('editor_config')) {
    /**
     * editor.md 初始化配置js代码
     *
     * @param  string $editor_id 编辑器 `textarea` 所在父div层id值，默认取 `mdeditor` 字符串
     *
     * @return string
     */
    function editor_config($editor_id = 'mdeditor')
    {

        return '<!-- editor.md config -->
    <script type="text/javascript">
    var _'.$editor_id.';
    $(function() {
        //emoji
        editormd.emoji = {
            path : "//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/",
            ex : ".png"
        };
        _'.$editor_id.' = editormd({
                id : "'.$editor_id.'",
                width : "100%",
                height : 640,
                saveHTMLToTextarea : '.config('editor.saveHTMLToTextarea').',
                emoji : '.config('editor.emoji').',
                taskList : '.config('editor.taskList').',
                tex : '.config('editor.tex').',
                toc : '.config('editor.toc').',
                tocm : '.config('editor.tocm').',
                codeFold : '.config('editor.codeFold').',
                flowChart: '.config('editor.flowChart').',
                sequenceDiagram: '.config('editor.sequenceDiagram').',
                path : "/vendor/editor.md/lib/",
                imageUpload : '.config('editor.imageUpload').',
                imageFormats : ["jpg", "gif", "png"],
                imageUploadURL : "/xetaravel-editor-md/upload/picture?_token=' . csrf_token() . '&from=xetaravel-editor-md"
        });
    });
    </script>';
    }
}
