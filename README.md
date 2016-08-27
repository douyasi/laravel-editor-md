# editor.md for Laravel

>  `editor.md` 是一款高度可定制化的 `markdown` 编辑器，官网网站：https://pandao.github.io/editor.md/ 。

## 安装与配置

在 `composer.json` 新增 `"douyasi/laravel-editor-md": "dev-master"` 依赖，然后执行： `composer update` 操作。

依赖安装完毕之后，在 `app.php` 中添加：

```php
'providers' => [
        'Douyasi\Editor\EditorServiceProvider',
],
```

然后，执行下面 `artisan` 命令，发布该扩展包配置等项。

```bash
php artisan vendor:publish --force
```

现在您可以访问 `/laravel-editor-md/example` 路由，不出意外，您可以看到扩展包提供的示例页面。

![](http://douyasi.com/usr/uploads/2016/08/2512199115.jpg)

编辑器图片默认会上传到 `public/uploads/content` 目录下；编辑器相关功能配置位于 `config/editor.php` 文件中。

## 使用说明

在 `blade` 模版里面使用下面三个方法：`editor_css()` 、`editor_js()` 和 `editor_config()` 。

```html
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
```

