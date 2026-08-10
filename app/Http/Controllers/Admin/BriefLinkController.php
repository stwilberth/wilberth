<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brief;
use App\Models\BriefLink;
use Illuminate\Http\Request;

class BriefLinkController extends Controller
{
    public function index()
    {
        $links = BriefLink::withCount('brief')->latest()->get();
        return view('admin.brief-links.index', compact('links'));
    }

    public function create()
    {
        return view('admin.brief-links.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'expires_at' => 'nullable|date|after:today',
        ]);

        $link = BriefLink::create($validated);

        return redirect()->route('admin.brief-links.index')
            ->with('success', 'Enlace creado correctamente.');
    }

    public function show(BriefLink $briefLink)
    {
        $briefLink->load('brief');
        return view('admin.brief-links.show', compact('briefLink'));
    }

    public function toggle(BriefLink $briefLink)
    {
        $briefLink->update(['is_active' => !$briefLink->is_active]);
        return back()->with('success', 'Estado actualizado.');
    }

    public function destroy(BriefLink $briefLink)
    {
        $briefLink->delete();
        return redirect()->route('admin.brief-links.index')
            ->with('success', 'Enlace eliminado.');
    }

    public function download(Brief $brief)
    {
        $markdown = $brief->toMarkdown();
        $filename = 'brief-' . str($brief->business_name)->slug() . '-' . $brief->created_at->format('Ymd') . '.md';

        return response($markdown)
            ->header('Content-Type', 'text/markdown')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
