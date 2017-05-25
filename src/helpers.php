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
            $reasons .= $message . ' ';
        }
        $info = 'Reason：' . $reasons;
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
     * The configuration for Editor.md
     *
     * @param array $config The configuration options.
     *
     * @return string
     */
    function editor_config($config = [])
    {

        return '<!-- editor.md config -->
    <script type="text/javascript">
    var _'. array_get($config, 'id', 'myeditor') .';
    $(function() {
        //emoji
        editormd.emoji = {
            path : "'. array_get($config, 'emojiPath', config('editor.emojiPath')) .'",
            ex : ".png"
        };
        _'.$editor_id.' = editormd({
                id : "'. array_get($config, 'id', 'myeditor') .'",
                width : "'. array_get($config, 'width', config('editor.width')) .'",
                height : "'. array_get($config, 'height', config('editor.height')) .'",
                saveHTMLToTextarea : '. array_get($config, 'saveHTMLToTextarea', config('editor.saveHTMLToTextarea')) .',
                emoji : '. array_get($config, 'emoji', config('editor.emoji')) .',
                taskList : '. array_get($config, 'taskList', config('editor.taskList')) .',
                tex : '. array_get($config, 'tex', config('editor.tex')) .',
                toc : '. array_get($config, 'toc', config('editor.toc')) .',
                tocm : '. array_get($config, 'tocm', config('editor.tocm')) .',
                codeFold : '. array_get($config, 'codeFold', config('editor.codeFold')) .',
                flowChart: '. array_get($config, 'flowChart', config('editor.flowChart')) .',
                sequenceDiagram: '. array_get($config, 'sequenceDiagram', config('editor.sequenceDiagram')) .',
                path : "'. array_get($config, 'path', config('editor.path')) .'",
                imageUpload : '. array_get($config, 'imageUpload', config('editor.imageUpload')) .',
                imageFormats : '. array_get($config, 'imageFormats', json_encode(config('editor.imageFormats'))) .',
                imageUploadURL : "'. array_get($array, 'imageUploadURL', config('editor.imageUploadURL')) .'?_token=' . csrf_token() . '&from=xetaravel-editor-md"
        });
    });
    </script>';
    }
}
