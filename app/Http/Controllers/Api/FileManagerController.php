<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    public function getAllDirectories()
    {
        $directories = Storage::disk('public')->directories();
        sort($directories);
        $data = [];
        foreach ($directories as $id => $directory) {
            $data[] = [
                'id' => $directory,
                'directory' => str_replace("_", " ", $directory)
            ];
        }
        return response()->json($data);
    }

    public function getFiles()
    {
        $images = Storage::disk('public')->allFiles();
        $data = [];
        foreach ($images as $image) {
            $dir = pathinfo($image)['dirname'];
            $filename = pathinfo($image)['basename'];

            if (!isset($data[$dir])) {
                $data[$dir] = [];
            }
            $data[$dir][] = $filename;
        }
        $json = json_encode($data);
        return response()->json($json);
    }
}
