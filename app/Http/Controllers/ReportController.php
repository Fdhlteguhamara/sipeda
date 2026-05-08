<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();

        // Search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $reports = $query->latest()->paginate(6);

        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        // UPLOAD KE S3
        $path = $request->file('image')->store('reports', 's3');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        // URL FINAL
        $imageUrl = 'https://d3cnb4807xjvjw.cloudfront.net/reports/' . $filename;

        // SIMPAN
        Report::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_url' => $imageUrl,
            'status' => 'pending',
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect('/reports')
            ->with('success', 'Laporan berhasil dibuat');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}