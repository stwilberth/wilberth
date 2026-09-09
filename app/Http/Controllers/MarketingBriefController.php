<?php

namespace App\Http\Controllers;

use App\Models\MarketingBrief;
use App\Models\MarketingBriefLink;
use Illuminate\Http\Request;

class MarketingBriefController extends Controller
{
    public function show($token = null)
    {
        $link = null;

        if ($token) {
            $link = MarketingBriefLink::where('token', $token)->first();

            if (!$link || !$link->isValid()) {
                abort(404);
            }
        }

        $seller = (object) [
            'name' => 'Wilberth',
            'whatsapp' => '+506 85008393',
        ];

        return view('marketing-brief', compact('seller', 'link'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'marketing_brief_link_token' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'offer' => 'required|string|max:1000',
            'target_audience' => 'required|string|max:1000',
            'differentiator' => 'required|string|max:1000',
            'main_goal' => 'nullable|string|max:1000|required_without:main_goal_other',
            'main_goal_other' => 'nullable|string|max:1000',
            'first_impression' => 'required|string|max:1000',
            'promoted_service' => 'required|string|max:1000',
        ]);

        if (!empty($validated['main_goal_other'])) {
            $validated['main_goal'] = $validated['main_goal_other'];
        }
        unset($validated['main_goal_other']);

        if (!empty($validated['marketing_brief_link_token'])) {
            $link = MarketingBriefLink::where('token', $validated['marketing_brief_link_token'])->first();
            if ($link) {
                $validated['marketing_brief_link_id'] = $link->id;
            }
        }

        unset($validated['marketing_brief_link_token']);

        MarketingBrief::create($validated);

        return redirect()->route('marketing-brief.show', ['token' => $request->marketing_brief_link_token])
            ->with('success', '¡Información enviada correctamente! Voy a revisar tu información y te contacto pronto.');
    }
}
