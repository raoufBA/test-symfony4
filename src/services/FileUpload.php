<?php

namespace App\services;

use http\Encoding\Stream\Inflate;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUpload
{
    /**
     * @var string
     */
    private $pathDir;


    /**
     * @param string $pathDir
     */
    public function __construct(string $pathDir)
    {
        $this->pathDir = $pathDir;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function uploadFile(UploadedFile $uploadedFile):string
    {
        $newFilename = uniqid() . '.' . $uploadedFile->getClientOriginalExtension();


        try {
            $uploadedFile->move(
                $this->pathDir,
                $newFilename
            );
        } catch (FileException $e) {
            echo 'You have Problem to upload File ' . $e;
        }
        return $newFilename;
    }

    /**
     * @param string $file
     * @return void
     */
    public function deleteFile(string $file){
        $filePath =  $this->pathDir.$file;
        unlink($filePath);
    }
}