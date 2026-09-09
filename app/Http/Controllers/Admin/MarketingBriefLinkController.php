<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingBrief;
use App\Models\MarketingBriefLink;
use Illuminate\Http\Request;

class MarketingBriefLinkController extends Controller
{
    public function index()
    {
        $links = MarketingBriefLink::withCount('marketingBrief')->latest()->get();
        return view('admin.marketing-brief-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.marketing-brief-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $link = MarketingBriefLink::create($validated);

        return redirect()->route('admin.marketing-brief-links.index')
            ->with('success', 'Enlace creado correctamente.');
    }

    public function show(MarketingBriefLink $marketingBriefLink)
    {
        $marketingBriefLink->load('marketingBrief');
        return view('admin.marketing-brief-links.show', compact('marketingBriefLink'));
    }

    public function toggle(MarketingBriefLink $marketingBriefLink)
    {
        $marketingBriefLink->update(['is_active' => !$marketingBriefLink->is_active]);
        return back()->with('success', 'Estado actualizado.');
    }

    public function destroy(MarketingBriefLink $marketingBriefLink)
    {
        $marketingBriefLink->delete();
        return redirect()->route('admin.marketing-brief-links.index')
            ->with('success', 'Enlace eliminado.');
    }

    public function download(MarketingBrief $marketingBrief)
    {
        $markdown = $marketingBrief->toMarkdown();
        $filename = 'marketing-brief-' . str($marketingBrief->contact_name)->slug() . '-' . $marketingBrief->created_at->format('Ymd') . '.md';

        return response($markdown)
            ->header('Content-Type', 'text/markdown')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
