<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\UploadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    /**
     * @var UploadService
     */
    protected UploadService $uploadService;

    /**
     * UploadController constructor.
     *
     * @param UploadService $uploadService
     */
    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * Store the uploaded file.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $messages = [
            'file.required' => __('validation-post.file.required'),
            'file.image' => __('validation-post.file.image'),
            'file.mimes' => __('validation-post.file.mimes'),
            'file.max' => __('validation-post.file.max'),
        ];
        $rules = [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ];

        // Create a validator instance
        $validator = Validator::make($request->all(), $rules, $messages);

        // Check if validation fails
        if ($validator->fails()) {
            // Get the first error message
            $firstErrorMessage = $validator->errors()->first();

            // Return the first error message
            return response()->json(['message' => $firstErrorMessage], 422);
        }

        // Store the file using the UploadService
        $path = $this->uploadService->store($request);

        if ($path) {
            return response()->json([
                'ok' => true,
                'path' => $path,
                'error' => false
            ]);
        } else {
            // Handle the case where $this->uploadService->store($request) is false or returns null
            // For example, return an error response
            return response()->json([
                'error' => true,
                'message' => 'Failed to store the file.',
            ], 400); // You can set the appropriate status code based on your requirement
        }
    }
}
