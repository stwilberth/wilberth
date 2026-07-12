<?php

namespace App\Services;

class PricingService
{
    protected array $basePrices = [
        't-shirt' => [
            'cotton' => 15.00,
            'polyester' => 13.00,
            'organic' => 18.00,
            'premium' => 22.00,
        ],
        'hoodie' => [
            'cotton' => 35.00,
            'polyester' => 30.00,
            'organic' => 42.00,
            'premium' => 48.00,
        ],
        'mug' => [
            'ceramic' => 12.00,
            'enamel' => 15.00,
            'travel' => 18.00,
        ],
        'tote' => [
            'cotton' => 10.00,
            'canvas' => 12.00,
            'organic' => 14.00,
        ],
        'cap' => [
            'cotton' => 14.00,
            'polyester' => 12.00,
            'wool' => 18.00,
        ],
    ];

    protected array $sizeMultipliers = [
        'XS' => 0.95,
        'S' => 0.95,
        'M' => 1.0,
        'L' => 1.05,
        'XL' => 1.10,
        '2XL' => 1.20,
        '3XL' => 1.35,
    ];

    protected array $colorMultipliers = [
        'white' => 1.0,
        'black' => 1.05,
        'heather' => 1.08,
        'colored' => 1.10,
        'premium' => 1.15,
    ];

    protected float $layerPrice = 2.50;
    protected float $setupFee = 3.00;

    public function calculatePrice(
        string $productType,
        string $material,
        string $size,
        string $color,
        int $layerCount = 0,
        bool $hasSetupFee = true
    ): float {
        $basePrice = $this->basePrices[$productType][$material] ?? 
                     $this->basePrices[$productType]['cotton'] ?? 15.00;

        $sizeMultiplier = $this->sizeMultipliers[$size] ?? 1.0;
        $colorMultiplier = $this->getColorMultiplier($color);

        $price = $basePrice * $sizeMultiplier * $colorMultiplier;
        $price += $layerCount * $this->layerPrice;

        if ($hasSetupFee && $layerCount > 0) {
            $price += $this->setupFee;
        }

        return round($price, 2);
    }

    public function getBasePrice(string $productType, string $material): float
    {
        return $this->basePrices[$productType][$material] ?? 15.00;
    }

    public function getSizeMultiplier(string $size): float
    {
        return $this->sizeMultipliers[$size] ?? 1.0;
    }

    public function getColorMultiplier(string $color): float
    {
        $colorLower = strtolower($color);
        
        if (in_array($colorLower, ['white', 'blanco'])) return 1.0;
        if (in_array($colorLower, ['black', 'negro'])) return 1.05;
        if (str_contains($colorLower, 'heather') || str_contains($colorLower, 'gris')) return 1.08;
        if (in_array($colorLower, ['gold', 'silver', 'metallic', 'neon'])) return 1.15;
        
        return 1.10;
    }

    public function getLayerPrice(): float
    {
        return $this->layerPrice;
    }

    public function getSetupFee(): float
    {
        return $this->setupFee;
    }

    public function getPriceBreakdown(
        string $productType,
        string $material,
        string $size,
        string $color,
        int $layerCount = 0
    ): array {
        $basePrice = $this->getBasePrice($productType, $material);
        $sizeMultiplier = $this->getSizeMultiplier($size);
        $colorMultiplier = $this->getColorMultiplier($color);
        $layerCost = $layerCount * $this->layerPrice;
        $setupFee = ($layerCount > 0) ? $this->setupFee : 0;
        
        $subtotal = $basePrice * $sizeMultiplier * $colorMultiplier;
        $total = $subtotal + $layerCost + $setupFee;

        return [
            'base_price' => round($basePrice, 2),
            'size_multiplier' => $sizeMultiplier,
            'color_multiplier' => $colorMultiplier,
            'subtotal' => round($subtotal, 2),
            'layer_count' => $layerCount,
            'layer_cost' => round($layerCost, 2),
            'setup_fee' => round($setupFee, 2),
            'total' => round($total, 2),
        ];
    }

    public function getProductConfig(string $productType): array
    {
        return [
            't-shirt' => [
                'name' => 'Camiseta',
                'colors' => ['white', 'black', 'heather-gray', 'navy', 'red', 'royal-blue', 'forest-green'],
                'sizes' => ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'],
                'materials' => ['cotton', 'polyester', 'organic', 'premium'],
                'print_areas' => ['front', 'back', 'sleeve-left', 'sleeve-right'],
                'max_layers' => 4,
            ],
            'hoodie' => [
                'name' => 'Sudadera',
                'colors' => ['white', 'black', 'heather-gray', 'navy', 'charcoal', 'maroon'],
                'sizes' => ['S', 'M', 'L', 'XL', '2XL', '3XL'],
                'materials' => ['cotton', 'polyester', 'organic', 'premium'],
                'print_areas' => ['front', 'back', 'sleeve-left', 'sleeve-right', 'hood'],
                'max_layers' => 5,
            ],
            'mug' => [
                'name' => 'Taza',
                'colors' => ['white', 'black', 'red', 'blue', 'green'],
                'sizes' => ['11oz', '15oz'],
                'materials' => ['ceramic', 'enamel', 'travel'],
                'print_areas' => ['wrap'],
                'max_layers' => 2,
            ],
            'tote' => [
                'name' => 'Tote Bag',
                'colors' => ['natural', 'black', 'white', 'navy'],
                'sizes' => ['One Size'],
                'materials' => ['cotton', 'canvas', 'organic'],
                'print_areas' => ['front', 'back'],
                'max_layers' => 3,
            ],
            'cap' => [
                'name' => 'Gorra',
                'colors' => ['black', 'white', 'navy', 'khaki', 'red'],
                'sizes' => ['One Size'],
                'materials' => ['cotton', 'polyester', 'wool'],
                'print_areas' => ['front', 'side', 'back'],
                'max_layers' => 2,
            ],
        ][$productType] ?? [];
    }

    public function validateDesign(
        string $productType,
        array $layers,
        array $variants
    ): array {
        $config = $this->getProductConfig($productType);
        $errors = [];
        $warnings = [];

        if (count($layers) > ($config['max_layers'] ?? 4)) {
            $errors[] = "Máximo {$config['max_layers']} capas permitidas para {$config['name']}";
        }

        foreach ($layers as $layer) {
            if ($layer['type'] === 'text' && empty($layer['content'])) {
                $warnings[] = "Capa de texto vacía: {$layer['id']}";
            }
            
            if ($layer['type'] === 'image' && empty($layer['content'])) {
                $warnings[] = "Imagen sin cargar: {$layer['id']}";
            }
        }

        if (!in_array($variants['color'] ?? '', $config['colors'] ?? [])) {
            $warnings[] = "Color no estándar: " . ($variants['color'] ?? 'no seleccionado');
        }

        if (!in_array($variants['size'] ?? '', $config['sizes'] ?? [])) {
            $warnings[] = "Talla no estándar: " . ($variants['size'] ?? 'no seleccionada');
        }

        if (!in_array($variants['material'] ?? '', $config['materials'] ?? [])) {
            $warnings[] = "Material no estándar: " . ($variants['material'] ?? 'no seleccionado');
        }

        return ['errors' => $errors, 'warnings' => $warnings];
    }
}