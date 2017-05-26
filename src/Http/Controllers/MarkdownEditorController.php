<?php
namespace Xetaio\Editor\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MarkdownEditorController extends Controller
{

    /**
     * Handle a file upload.
     *
     * @param \Illuminate\Http\Request $requst
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUploadMarkdownEditorPicture(Request $request): JsonResponse
    {
        $json = [
            'success' => 0,
            'message' => 'No file to upload.',
            'url' => ''
        ];

        if (!$request->hasFile('editormd-image-file')) {
            return response()->json($json);
        }

        $file = $request->file('editormd-image-file');
        $ext = $file->getClientOriginalExtension();

        $data = $request->all();
        $data['file-extension'] = $ext;

        $rules = [
            'editormd-image-file' => [
                'max:5120',
                'image',
                'mimes:jpeg,gif,png',

            ],
            'file-extension' => [
                'required',
                Rule::in(['gif', 'jpg', 'png'])
            ]
        ];
        $messages = [
            'editormd-image-file.max' => 'The file is too large, the size of the file must not exceed :maxKb.',
            'editormd-image-file.image' => 'The file must be an image.',
            'editormd-image-file.mimes' => 'The file must be of type .gif, .jpeg and .png only.',
            'file-extension.required' => 'The file extension is required.'
            'file-extension.in' => 'The file extension must be of type .gif, .jpg and .png only.'
        ];
        $validator = Validator::make($data, $rules, $messages);

        if (!$validator->passes()) {
            return response()->json(
                $this->formatJsonMessage($validator->messages(), $json)
            );
        }

        $destPath = config('basaUploadPath', 'editor-md/uploads/content/');
        $savePath = $destPath . date('Ymd', time());

        if (!is_dir($savePath)) {
            mkdir($savePath);
        }
        $name = $file->getClientOriginalName();

        $uniqid = uniqid() . '_' . date('s');
        $newFileName = $uniqid . '.' . $ext;
        $newFilePath = '/' . $savePath . '/' . $newFileName;

        if ($file->isValid()) {
            $uploadSuccess = $file->move($savePath, $newFileName);
            $json = array_replace($json, ['success' => 1, 'url' => $newFilePath]);
        } else {
            $json = array_replace($json, ['success' => 0, 'meassge' => 'The file is invalid.']);
        }

        return response()->json($json);
    }

    /**
     * Format the form validation messages and return it as a json.
     *
     * @param array $messages The messages to format.
     * @param array $json The array that contain the message.
     *
     * @return array
     */
    protected function formatJsonMessage($messages, $json)
    {
        $reasons = '';

        foreach ($messages->all(':message') as $message) {
            $reasons .= $message . ' ';
        }
        $info = $reasons;
        $json = array_replace($json, ['message' => $info]);

        return $json;
    }
}
