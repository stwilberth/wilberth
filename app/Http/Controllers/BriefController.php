<?php

namespace App\Http\Controllers;

use App\Models\Brief;
use App\Models\BriefLink;
use Illuminate\Http\Request;

class BriefController extends Controller
{
    public function show($token = null)
    {
        $link = null;

        if ($token) {
            $link = BriefLink::where('token', $token)->first();

            if (!$link || !$link->isValid()) {
                abort(404);
            }
        }

        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        return view('brief', compact('seller', 'link'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brief_link_token' => 'nullable|string',
            'business_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'business_description' => 'required|string',
            'location' => 'nullable|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'pages_needed' => 'required|array',
            'pages_needed.*' => 'string|max:255',
            'extra_features' => 'nullable|string',
            'content_available' => 'required|array',
            'content_available.*' => 'string|max:255',
            'brand_colors' => 'nullable|string|max:255',
            'website_examples' => 'nullable|string',
            'budget' => 'nullable|string|max:255',
            'timeline' => 'nullable|string|max:255',
            'competitors' => 'nullable|string',
            'special_notes' => 'nullable|string',
        ]);

        if (!empty($validated['brief_link_token'])) {
            $link = BriefLink::where('token', $validated['brief_link_token'])->first();
            if ($link) {
                $validated['brief_link_id'] = $link->id;
            }
        }

        unset($validated['brief_link_token']);

        Brief::create($validated);

        return redirect()->route('brief.show', ['token' => $request->brief_link_token])
            ->with('success', '¡Información enviada correctamente! Voy a revisar tu información y te contacto pronto.');
    }
}
