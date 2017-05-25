<?php
namespace Xetaio\Editor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class MarkdownEditorController extends Controller
{

    /**
     * 针对editor.md所写的图片上传控制器
     *
     * @param  Request $requst
     *
     * @return Response
     */
    public function postUploadMarkdownEditorPicture(Request $request)
    {
        $json = [
            'success' => 0,
            'message' => 'Unknown',
            'url' => ''
        ];

        if (!$request->hasFile('editormd-image-file')) {
            return response()->json($json);
        }

        $file = $request->file('editormd-image-file');
        $data = $request->all();

        $rules = [
            'editormd-image-file' => 'max:5120',
        ];

        $messages = [
            'editormd-image-file.max'    => 'The file is too large, the size of the file must not exceed 5MB'
        ];
        $validator = Validator::make($data, $rules, $messages);

        if ($validator->passes()) {
            $realPath = $file->getRealPath();
            $destPath = 'uploads/content/';
            $savePath = $destPath.''.date('Ymd', time());

            //Create the directory if it doesn't exist.
            is_dir($savePath) || mkdir($savePath);

            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();

            $check_ext = in_array($ext, ['gif', 'jpg', 'png'], true);

            if ($check_ext) {
                $uniqid = uniqid().'_'.date('s');
                $oFile = $uniqid.'o.'.$ext;
                $fullfilename = '/'.$savePath.'/'.$oFile;  //Original full path
                if ($file->isValid()) {
                    $uploadSuccess = $file->move($savePath, $oFile);  //Move the file
                    $oFilePath = $savePath.'/'.$oFile;
                    $json = array_replace($json, ['success' => 1, 'url' => $fullfilename]);
                } else {
                    $json = array_replace($json, ['success' => 0, 'meassge' => 'The file is invalid.']);
                }
            } else {
                $json = array_replace(
                    $json,
                    ['success' => 0, 'message' => 'The file type is not allowed (gif|jpg|png).']
                );
            }
        } else {
            $json = format_json_message($validator->messages(), $json);
        }

        return response()->json($json);
    }
}
