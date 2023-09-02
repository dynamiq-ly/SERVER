<?php

namespace App\Http\Controllers\helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileSystemManagerController extends Controller
{
    public function getAllDirectories()
    {
        try {
            $directories = Storage::disk('public')->directories();
            sort($directories);
            $data = [];

            foreach ($directories as $directory) {
                $directoryPath = storage_path('app/public/' . $directory);

                if (is_dir($directoryPath)) {
                    $directorySize = $this->getDirectorySize($directoryPath);
                    $creationDate = $this->getDirectoryCreationDate($directoryPath);

                    $data[] = [
                        'id' => $directory,
                        'directory' => str_replace("_", " ", $directory),
                        'size' => $this->formatSizeUnits($directorySize),
                        'creation_date' => $creationDate,
                    ];
                } else {
                    // Handle the case where $directoryPath is not a directory
                }
            }

            return response()->json($data);
        } catch (\Exception $e) {
            // Handle any exceptions that might occur
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getDirectorySize($directory)
    {
        $totalSize = 0;

        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory)) as $file) {
            if ($file->isFile()) {
                $totalSize += $file->getSize();
            }
        }

        return $totalSize;
    }

    private function formatSizeUnits($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes >= 1024 && $i < 4; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    private function getDirectoryCreationDate($directory)
    {
        if (is_dir($directory)) {
            // Use filectime() to get the inode change time (or creation time on Windows if supported)
            $timestamp = filectime($directory);

            // Format the timestamp as a human-readable date
            return date('Y-m-d H:i:s', $timestamp);
        }

        return null;
    }




    public function getStructuredFiles()
    {
        // Initialize an empty array to store the directory structure
        $parentDirectories = [];

        // Get all files and directories in the root of the "public" storage disk
        $allItems = Storage::disk('public')->allFiles();

        foreach ($allItems as $item) {
            // Extract the directory path excluding the filename
            $directoryPath = dirname($item);

            // Remove the leading 'public/' part of the path if it exists
            $directoryPath = str_replace('public/', '', $directoryPath);

            // Split the directory path into segments
            $segments = explode('/', $directoryPath);

            // Initialize the current directory array
            $currentDir = &$parentDirectories;

            // Iterate through the path segments to build the directory structure
            foreach ($segments as $segment) {
                // Check if the segment already exists as a subdirectory
                if (!isset($currentDir[$segment])) {
                    $currentDir[$segment] = [];
                }

                // Move to the next level
                $currentDir = &$currentDir[$segment];
            }

            // Check if the item is a file (not a directory)
            if (is_file(Storage::disk('public')->path($item))) {
                // Get the file extension and size
                $fileInfo = pathinfo($item);
                $extension = $fileInfo['extension'];
                $size = Storage::disk('public')->size($item);

                // Add the file to the current directory's "files" array
                $currentDir['files'][] = [
                    'type' => 'file',
                    'name' => $fileInfo['filename'],
                    'extension' => $extension,
                    'size' => $size,
                ];
            }
        }

        // Return the resulting directory structure as JSON response
        return response()->json($parentDirectories);
    }


    public function getFiles()
    {
        $files = Storage::disk('public')->allFiles();
        $data = [];
        foreach ($files as $file) {
            $dir = pathinfo($file)['dirname'];
            $filename = pathinfo($file)['basename'];
            $extension = pathinfo($file)['extension']; // Extract the file extension
            $data[] = [
                'dir' => $dir,
                'filename' => $filename,
                'size' => Storage::disk('public')->size($file),
                'extension' => $extension, // Store the extension in 'extension'
                'last_modified' => Storage::disk('public')->lastModified($file),
                'url' => Storage::disk('public')->url($file),
            ];
        }
        return response()->json($data);
    }
}
