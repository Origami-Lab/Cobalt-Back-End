<?php


namespace App\Controller;

use App\Entity\FileUpload;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateFileUploadAction
{
    public function __invoke(Request $request): FileUpload
    {
        $uploadedFile = $request->files->get('file');
        $filename = $request->request->get('filename');

        $fileUpload = new FileUpload();
        $fileUpload->file = $uploadedFile;
        $fileUpload->filename = $filename;
        return $fileUpload;
    }
    
}
