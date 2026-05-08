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
            'image' => 'image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $path = null;
        $imageUrl = null;

        //  Upload ke S3
        if ($request->file('image')) {
            $path = Storage::disk('s3')->put('reports', $request->file('image'));

            //  Gunakan CloudFront URL (WAJIB)
            $imageUrl = env('AWS_URL') . '/' . $path;
        }

        Report::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'image_url' => $imageUrl,
        ]);

        return redirect('/reports')->with('success','Laporan berhasil dikirim');
    }
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }
}