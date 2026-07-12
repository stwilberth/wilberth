<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DesignConfiguration;
use App\Models\DesignAsset;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $designs = DesignConfiguration::where('user_id', $request->user()?->id)
            ->orWhereNull('user_id')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        return response()->json(['success' => true, 'designs' => $designs]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'product_type' => 'required|string|in:t-shirt,polo,long-sleeve,hoodie,zip-hoodie,mug,travel-mug,tote,cap',
            'canvas' => 'nullable|array',
            'layers' => 'nullable|array',
            'selected_variants' => 'nullable|array',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $design = DesignConfiguration::create([
            'user_id' => $request->user()?->id,
            'name' => $request->name,
            'product_type' => $request->product_type,
            'canvas' => $request->canvas,
            'layers' => $request->layers,
            'selected_variants' => $request->selected_variants,
            'price' => $request->price ?? 0,
            'status' => 'draft',
        ]);

        return response()->json(['success' => true, 'design' => $design]);
    }

    public function show(DesignConfiguration $design): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $design->load('assets');

        return response()->json(['success' => true, 'design' => $design]);
    }

    public function update(Request $request, DesignConfiguration $design): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'product_type' => 'sometimes|string|in:t-shirt,hoodie,mug,tote,cap',
            'canvas' => 'nullable|array',
            'layers' => 'nullable|array',
            'selected_variants' => 'nullable|array',
            'price' => 'nullable|numeric|min:0',
            'status' => 'sometimes|string|in:draft,saved,ordered',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $design->update($request->only([
            'name', 'product_type', 'canvas', 'layers', 
            'selected_variants', 'price', 'status'
        ]));

        return response()->json(['success' => true, 'design' => $design]);
    }

    public function destroy(DesignConfiguration $design): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        foreach ($design->assets as $asset) {
            Storage::disk('public')->delete($asset->path);
        }

        $design->delete();

        return response()->json(['success' => true]);
    }

    public function export(Request $request, DesignConfiguration $design): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'png_base64' => 'required|string',
        ]);

        $base64 = $request->png_base64;
        $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
        $imageData = base64_decode($base64);

        if ($imageData === false) {
            return response()->json(['success' => false, 'message' => 'Invalid base64 image'], 400);
        }

        $filename = "designs/{$design->id}/export_" . Str::random(8) . '.png';
        Storage::disk('public')->put($filename, $imageData);

        $design->update(['preview_image' => ['url' => asset('storage/' . $filename)]]);

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $filename),
        ]);
    }

    public function uploadAsset(Request $request, DesignConfiguration $design): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'file' => 'required|file|image|mimes:png,jpg,webp|max:2048|dimensions:max_width=2000,max_height=2000',
            'type' => 'required|string|in:logo,template',
            'position' => 'nullable|array',
            'size' => 'nullable|array',
            'rotation' => 'nullable|integer|min:-360|max:360',
        ]);

        $file = $request->file('file');
        $path = $file->store("designs/{$design->id}/assets", 'public');

        $asset = DesignAsset::create([
            'design_id' => $design->id,
            'path' => $path,
            'type' => $request->type,
            'position' => $request->position ?? ['x' => 0, 'y' => 0],
            'size' => $request->size ?? ['width' => 200, 'height' => 200],
            'rotation' => $request->rotation ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'asset' => $asset->load('design'),
            'url' => asset('storage/' . $path),
        ]);
    }

    public function deleteAsset(DesignConfiguration $design, DesignAsset $asset): JsonResponse
    {
        if ($design->user_id && $design->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        if ($asset->design_id !== $design->id) {
            return response()->json(['success' => false, 'message' => 'Asset not found'], 404);
        }

        Storage::disk('public')->delete($asset->path);
        $asset->delete();

        return response()->json(['success' => true]);
    }
}