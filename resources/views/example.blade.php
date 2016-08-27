<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>editor.md example</title>
    {!! editor_css() !!}
</head>
<body>
<h2>editor.md example</h2>
<div id="mdeditor">
  <textarea class="form-control" name="content" style="display:none;">
# editor.md for Laravel
>   editor.md example
  </textarea>
</div>

{!! editor_js() !!}
{!! editor_config('mdeditor') !!}
</body>
</html>