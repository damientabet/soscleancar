<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    public function upload(UploadedFile $file, $path)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $originalFilename.'-'.uniqid().'.'.$file->guessExtension();

        try {
            $file->move($path, $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }
}