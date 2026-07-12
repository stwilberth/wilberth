<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Design;
use App\Models\DesignConfiguration;
use App\Services\PricingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    protected PricingService $pricing;

    public function __construct(PricingService $pricing)
    {
        $this->pricing = $pricing;
    }

    public function generateWhatsAppLink(Request $request): JsonResponse
    {
        $request->validate([
            'design_id' => 'required|exists:design_configurations,id',
            'phone' => 'nullable|string|regex:/^\d{8,15}$/',
            'message' => 'nullable|string|max:500',
        ]);

        $design = DesignConfiguration::findOrFail($request->design_id);
        $phone = $request->phone ?? config('services.whatsapp.phone', '50688888888');
        $phone = preg_replace('/\D/', '', $phone);

        $variants = $design->selected_variants ?? [];
        $layers = $design->layers ?? [];

        $priceBreakdown = $this->pricing->getPriceBreakdown(
            $design->product_type,
            $variants['material'] ?? 'cotton',
            $variants['size'] ?? 'M',
            $variants['color'] ?? 'white',
            count($layers)
        );

        $productName = $this->pricing->getProductConfig($design->product_type)['name'] ?? 'Producto';
        
        $messageParts = [
            "👕 *Nuevo pedido de {$productName} personalizada*",
            "",
            "📋 *Detalles del diseño:*",
            "• Nombre: {$design->name}",
            "• Producto: {$productName}",
            "• Color: " . ucfirst($variants['color'] ?? 'No especificado'),
            "• Talla: " . ($variants['size'] ?? 'No especificada'),
            "• Material: " . ucfirst($variants['material'] ?? 'No especificado'),
            "• Capas de diseño: " . count($layers),
            "",
            "💰 *Desglose de precio:*",
            "• Precio base: \${$priceBreakdown['base_price']}",
            "• Multiplicador talla: x{$priceBreakdown['size_multiplier']}",
            "• Multiplicador color: x{$priceBreakdown['color_multiplier']}",
            "• Subtotal: \${$priceBreakdown['subtotal']}",
            "• Capas adicionales ({$priceBreakdown['layer_count']} × \${$priceBreakdown['layer_cost']}): \$" . ($priceBreakdown['layer_cost'] * $priceBreakdown['layer_count']),
        ];

        if ($priceBreakdown['setup_fee'] > 0) {
            $messageParts[] = "• Cargo de configuración: \${$priceBreakdown['setup_fee']}";
        }

        $messageParts[] = "";
        $messageParts[] = "💵 *Total: \${$priceBreakdown['total']}*";
        $messageParts[] = "";

        if ($design->preview_image) {
            $imageUrl = is_array($design->preview_image) 
                ? ($design->preview_image['url'] ?? '') 
                : $design->preview_image;
            if ($imageUrl) {
                $messageParts[] = "🖼️ Vista previa: {$imageUrl}";
                $messageParts[] = "";
            }
        }

        if ($request->message) {
            $messageParts[] = "💬 *Mensaje:* {$request->message}";
            $messageParts[] = "";
        }

        $messageParts[] = "✅ Para confirmar tu pedido, responde a este mensaje.";
        $messageParts[] = "🆔 ID del diseño: {$design->id}";

        $message = implode("\n", $messageParts);
        $encodedMessage = urlencode($message);

        $whatsappUrl = "https://wa.me/{$phone}?text={$encodedMessage}";

        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl,
            'phone' => $phone,
            'message' => $message,
            'price_breakdown' => $priceBreakdown,
        ]);
    }

    public function saveDesign(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'product_type' => 'required|string|in:t-shirt,hoodie,mug,tote,cap',
            'canvas' => 'nullable|array',
            'layers' => 'nullable|array',
            'selected_variants' => 'nullable|array',
            'price' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        $design = DesignConfiguration::create([
            'user_id' => auth()->id(),
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

    public function exportPng(Request $request, DesignConfiguration $design): JsonResponse
    {
        $request->validate([
            'png_base64' => 'required|string',
        ]);

        $base64 = $request->png_base64;
        $base64 = preg_replace('#^data:image/\w+;base64,#i', '', $base64);
        $imageData = base64_decode($base64);

        if ($imageData === false) {
            return response()->json(['success' => false, 'message' => 'Invalid base64 image'], 400);
        }

        $filename = "designs/{$design->id}/export_{$design->id}_" . time() . ".png";
        Storage::disk('public')->put($filename, $imageData);

        $design->update(['preview_image' => ['url' => asset('storage/' . $filename)]]);

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $filename),
        ]);
    }

    public function getDesigns(): JsonResponse
    {
        $designs = DesignConfiguration::where('user_id', auth()->id())
            ->orWhereNull('user_id')
            ->orderBy('updated_at', 'desc')
            ->limit(20)
            ->get();

        return response()->json(['success' => true, 'designs' => $designs]);
    }

    public function getDesign(DesignConfiguration $design): JsonResponse
    {
        return response()->json(['success' => true, 'design' => $design]);
    }
}