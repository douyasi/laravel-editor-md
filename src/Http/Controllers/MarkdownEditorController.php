<?php

namespace Douyasi\Editor\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Validator;

class MarkdownEditorController extends Controller
{

protected $validatorMessages = [
        'picture.image'   => '文件类型不允许,请上传常规的图片(bmp|gif|jpg|png)文件',
        'picture.max'    => '文件过大,文件大小不得超出5MB',
        'document.max'   => '文件过大,文件大小不得超出50MB',
        'document.mimes'   => '文件类型不允许,请上传常规的文档(doc|docx|xls|xlsx|ppt|pptx|pdf)文件或压缩(rar|zip|7z)文件',
    ];

    /**
     * 针对editor.md所写的图片上传控制器
     * 
     * @param  Request $requst
     * @return Response
     */
    public function postUploadMarkdownEditorPicture(Request $request)
    {
        $json = [
            'success' => 0,
            'message' => '失败原因为：未知',
            'url' => '',
        ];
        if ($request->hasFile('editormd-image-file')) {
            //
            $file = $request->file('editormd-image-file');
            $data = $request->all();
            $rules = [
                'editormd-image-file'    => 'max:5120',
            ];
            $messages = [
                'editormd-image-file.max'    => '文件过大,文件大小不得超出5MB',
            ];
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->passes()) {
                $realPath = $file->getRealPath();
                $destPath = 'uploads/content/';
                $savePath = $destPath.''.date('Ymd', time());
                is_dir($savePath) || mkdir($savePath);  //如果不存在则创建目录
                $name = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();

                $check_ext = in_array($ext, ['gif', 'jpg', 'png'], true);

                if ($check_ext) {
                    $uniqid = uniqid().'_'.date('s');
                    $oFile = $uniqid.'o.'.$ext;
                    $fullfilename = '/'.$savePath.'/'.$oFile;  //原始完整路径
                    if ($file->isValid()) {
                        $uploadSuccess = $file->move($savePath, $oFile);  //移动文件
                        $oFilePath = $savePath.'/'.$oFile;
                        $json = array_replace($json, ['success' => 1, 'url' => $fullfilename]);
                    } else {
                        $json = array_replace($json, ['success' => 0, 'meassge' => '失败原因为：文件校验失败']);
                    }
                } else {
                    $json = array_replace($json, ['success' => 0, 'message' => '失败原因为：文件类型不允许,请上传常规的图片（gif|jpg|png）文件']);
                }
            } else {
                $json = format_json_message($validator->messages(), $json);
            }
        }
        return response()->json($json);
    }

}
