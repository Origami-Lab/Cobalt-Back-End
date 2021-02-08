<?php


namespace App\Controller;

use App\Entity\MediaObject;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObjectAction
{
    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');
        $fileName = $request->request->get('filename');
        $experimentID = $request->request->get('experimentid');
        $userID = $request->request->get('userid');
        
        

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;
        $mediaObject->filename = $fileName;
        $mediaObject->experimentid = $experimentID;
        $mediaObject->userid = $userID;
   
       

        return $mediaObject;
    }
    
}
