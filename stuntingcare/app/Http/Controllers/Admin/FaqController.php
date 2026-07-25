<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of FAQs.
     */
    public function index(Request $request)
    {
        $query = Faq::latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('question', 'like', '%' . $request->search . '%')
                  ->orWhere('answer', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $faqs = $query->paginate(10)->withQueryString();
        $totalFaqs = Faq::count();
        $activeFaqs = Faq::where('status', 'Aktif')->count();
        $draftFaqs = Faq::where('status', 'Draf')->count();

        return view('admin.crud-faq', compact('faqs', 'totalFaqs', 'activeFaqs', 'draftFaqs'));
    }

    /**
     * Store a newly created FAQ.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
            'status'   => 'required|in:Aktif,Draf',
        ]);

        Faq::create($data);

        return redirect()->route('admin.crud-faq')->with('success', 'FAQ baru berhasil ditambahkan.');
    }

    /**
     * Update the specified FAQ.
     */
    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question' => 'required|string',
            'answer'   => 'required|string',
            'status'   => 'required|in:Aktif,Draf',
        ]);

        $faq->update($data);

        return redirect()->route('admin.crud-faq')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified FAQ.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('admin.crud-faq')->with('success', 'FAQ berhasil dihapus.');
    }
}
