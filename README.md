> <h1 align="center">Xetaravel Editor.md</h1>
>
> |Stable Version|Downloads|Laravel|License|
> |:-------:|:------:|:-------:|:-------:|
> |[![Latest Stable Version](https://img.shields.io/packagist/v/XetaIO/Xetaravel-Editor-md.svg?style=flat-square)](https://packagist.org/packages/xetaio/xetaravel-editor-md)|[![Total Downloads](https://img.shields.io/packagist/dt/xetaio/xetaravel-editor-md.svg?style=flat-square)](https://packagist.org/packages/xetaio/xetaravel-editor-md)|[![Laravel 5.4](https://img.shields.io/badge/Laravel-5.4-f4645f.svg?style=flat-square)](http://laravel.com)|[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/XetaIO/Xetaravel-Editor-md/blob/master/LICENSE)|
>
> A wrapper to use [Editor.md](https://pandao.github.io/editor.md/) with Laravel.
>
> ## Requirement
> ![PHP](https://img.shields.io/badge/PHP->=7.0-brightgreen.svg?style=flat-square)
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
