<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApprovalController extends Controller
{
    public function approve(News $news)
    {
        $news->update([
            'status' => 'published',
            'published_at' => Carbon::now()
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil disetujui dan dipublikasikan.');
    }

    public function reject(News $news)
    {
        $news->update(['status' => 'rejected']);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditolak.');
    }
}
