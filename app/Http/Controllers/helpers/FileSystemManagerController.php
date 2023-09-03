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
            $extension = pathinfo($file)['extension'];
    
            // Get the full URL
            $fullUrl = Storage::disk('public')->url($file);
    
            // Extract the part of the URL starting from "storage/"
            $pathStartingFromStorage = substr($fullUrl, strpos($fullUrl, 'storage/'));

            // Retrieve the creation date (you may need to store this information when uploading files)
            $creationDate = Storage::disk('public')->lastModified($file);
    
            $data[] = [
                'dir' => $dir,
                'filename' => $filename,
                'size' => Storage::disk('public')->size($file),
                'extension' => $extension,
                'creation_date' => $creationDate, // Store the creation date
                'url' => $pathStartingFromStorage,
            ];
        }

        // Sort the files by creation date in descending order
        usort($data, function ($a, $b) {
            return $b['creation_date'] - $a['creation_date'];
        });
    
        return response()->json($data);
    }


    public function deleteFile(Request $request)
    {
        try {
            // Use the 'public' disk (you can change the disk if needed)
            Storage::disk('public')->delete($request->id);

            return response()->json(['message' => 'File deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getFileDetails(Request $request)
    {
        $filePath = $request->input('id');

        if (Storage::disk('public')->exists($filePath)) {
            $size = Storage::disk('public')->size($filePath);
            $mimeType = Storage::disk('public')->mimeType($filePath);
            $lastModified = Storage::disk('public')->lastModified($filePath);

            // Extract the file name from the file path
            $fileName = pathinfo($filePath)['basename'];

            return response()->json([
                'file_path' => $filePath,
                'file_name' => $fileName,
                'size' => $size, // Size in bytes
                'size_formatted' => $this->formatSizeUnits($size), // Formatted size (KB, MB, GB, etc.)
                'mime_type' => $mimeType,
                'last_modified' => date('Y-m-d H:i:s', $lastModified),
            ]);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
    }

    public function storeFiles(Request $request)
    {

        $name = $request->name;
        $feature = $request->feature;
        $pathToStore = $request->path;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = str_replace(' ', '_', $name) . time() . '.' . $image->extension();
            $image->storeAs('public/' . $feature . "/" . $pathToStore, $imageName);
            return $imageName;
        }

        return response()->json(['message' => 'No images found'], 400);
    }

    public function getFilesByString($searchString)
    {
        $files = Storage::disk('public')->allFiles();
        $data = [];

        foreach ($files as $file) {
            $dir = pathinfo($file)['dirname'];
            $filename = pathinfo($file)['basename'];
            $extension = pathinfo($file)['extension'];

            // Get the full URL
            $fullUrl = Storage::disk('public')->url($file);

            // Extract the part of the URL starting from "storage/"
            $pathStartingFromStorage = substr($fullUrl, strpos($fullUrl, 'storage/'));

            // Retrieve the creation date (you may need to store this information when uploading files)
            $creationDate = Storage::disk('public')->lastModified($file);

            // Check if the search string exists in the 'dir' field
            if (str_contains($dir, $searchString)) {
                $data[] = [
                    'dir' => $dir,
                    'filename' => $filename,
                    'size' => Storage::disk('public')->size($file),
                    'extension' => $extension,
                    'creation_date' => $creationDate, // Store the creation date
                    'url' => $pathStartingFromStorage,
                ];
            }
        }

        // Sort the files by creation date in descending order
        usort($data, function ($a, $b) {
            return $b['creation_date'] - $a['creation_date'];
        });

        return response()->json($data);
    }

}