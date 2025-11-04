<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class PortfolioController extends Controller
{
    /**
     * Menampilkan daftar semua portofolio (Master Data)
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->get();
        // Anda perlu membuat view ini nanti
        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Menampilkan form untuk membuat portofolio baru
     */
    public function create()
    {
        // Anda perlu membuat view ini nanti
        return view('admin.portfolios.create');
    }

    /**
     * Menyimpan portofolio baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portfolios', 'public');
        }

        Portfolio::create([
            'project_name' => $validated['project_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'), // Cek apakah checkbox "featured" dicentang
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio created successfully.');
    }

    /**
     * Menampilkan form untuk mengedit portofolio
     */
    public function edit(Portfolio $portfolio)
    {
        // $portfolio otomatis di-fetch berdasarkan ID dari route
        // Anda perlu membuat view ini nanti
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    /**
     * Update portofolio yang ada di database
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $portfolio->image;

        // Cek jika ada file gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('portfolios', 'public');
        }

        $portfolio->update([
            'project_name' => $validated['project_name'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'is_featured' => $request->has('is_featured'), // Update status "featured"
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio updated successfully.');
    }

    /**
     * Hapus portofolio dari database
     */
    public function destroy(Portfolio $portfolio)
    {
        // Hapus gambar dari storage
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }

        // Hapus record dari database
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio deleted successfully.');
    }
}