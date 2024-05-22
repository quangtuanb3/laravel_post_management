<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class UploadService
{
    /**
     * Store image to local.
     *
     * @param Request $request
     * @return string|bool
     */
    public function store(Request $request): string|bool
    {
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');

                // Ensure $file is an instance of UploadedFile
                if ($file instanceof UploadedFile) {
                    $prefix = 'public/uploads/';
                    $path = date('Y/m/d');
                    $name = uniqid() . '-' . str_replace(' ', '_', $file->getClientOriginalName());

                    $file->storeAs($prefix . $path, $name);

                    return 'storage/uploads/' . $path . '/' . $name;
                }
            }
        } catch (\Exception $error) {
            return false;
        }

        // Ensure a consistent return type
        return false;
    }
}
