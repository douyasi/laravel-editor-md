<?php

/**
 * editor.md css 相关依赖
 * 
 * @return string
 */
function editor_css()
{

    return '<!--editor.md css-->
<link rel="stylesheet" href="/vendor/editor.md/css/editormd.preview.min.css" />
<link rel="stylesheet" href="/vendor/editor.md/css/editormd.min.css" />
<style type="text/css">
.editormd-fullscreen {
    z-index: 2147483647;
}
</style>';

}

/**
 * editor.md js 相关依赖
 * 实际上，editor.md 某些功能组件（如`flowChart`）置 false，可减少对应的js依赖，但为了安全起见还是将所有可能的js依赖列出。
 * 
 * @return string
 */
function editor_js()
{

    return '<!--editor.md js-->
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
<script src="/vendor/editor.md/js/editormd.min.js"></script>';

}

/**
 * editor.md 初始化配置js代码
 * 
 * @param  string $editor_id 编辑器 `textarea` 所在父div层id值，默认取 `mdeditor` 字符串
 * @return string
 */
function editor_config($editor_id = 'mdeditor')
{

    return '<!--editor.md config-->
<script type="text/javascript">
var _'.$editor_id.';
$(function() {
    //修正emoji图片错误
    editormd.emoji     = {
        path  : "//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/",
        ext   : ".png"
    };
    _'.$editor_id.' = editormd({
            id : "'.$editor_id.'",
            width : "90%",
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
            imageUploadURL : "/laravel-editor-md/upload/picture?_token='.csrf_token().'&from=laravel-editor-md"
    });
});
</script>';

}