<?php

namespace APP\CORE;

use APP\CORE\Env;
use Exception;

class FileLoader
{
    private string $uploadDir;
    private array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    public function __construct()
    {
        $this->uploadDir = trim(Env::get('FILE_LOAD_IMAGES'), '/');

        if (!is_dir($this->uploadDir)) {
            if (!mkdir($this->uploadDir, 0775, true)) {
                throw new \Exception("Impossible de créer le dossier de destination.");
            }
        } 
    }

    public function saveUploadedImage(array $file): string
    {
        if (
            !isset($file['tmp_name'], $file['name']) ||
            !is_uploaded_file($file['tmp_name'])
        ) {
            throw new Exception("Fichier invalide.");
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $this->allowedExtensions)) {
            throw new Exception("Extension de fichier non autorisée.");
        }

        $filename = uniqid('img_', true) . '.' . $extension;
        $destination = $this->uploadDir . '/' . $filename;


        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception("Erreur lors de l'enregistrement de l'image.");
        }

        return $filename;
    }

    public function getImagePath(string $fileName): string
    {
        $path = $this->uploadDir . '/' . $fileName;

        if (!file_exists($path)) {
            throw new Exception("Fichier non trouvé.");
        }

        return $path;
    }

    public function getImageContent(string $fileName): string
    {
        return file_get_contents($this->getImagePath($fileName));
    }
}
