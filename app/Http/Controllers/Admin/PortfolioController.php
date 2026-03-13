<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Penting untuk mengelola file

class PortfolioController extends Controller
{
    /**
     * Menampilkan daftar semua portofolio (Master Data)
     */
    public function index()
    {
        // Eager load 'brand' dan 'images' agar tidak kena N+1 Query Problem
        $portfolios = Portfolio::with(['brand', 'images'])->latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    /**
     * Menampilkan form untuk membuat portofolio baru
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.create', compact('brands', 'categories'));
    }

    /**
     * Menyimpan portofolio baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_id'     => 'required|exists:brands,id',
            'title'        => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'description'  => 'nullable|string',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $portfolio = Portfolio::create([
            'brand_id'    => $validated['brand_id'],
            'title'       => $validated['title'],
            'portfolio_category_id' => $validated['portfolio_category_id'],
            'description' => $validated['description'],
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('portfolios', 'public');
                $portfolio->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Project Brand Berhasil Ditambah!');
    }

    /**
     * Menampilkan form untuk mengedit portofolio
     */
    public function edit(Portfolio $portfolio)
    {
        $brands = Brand::all();
        $categories = PortfolioCategory::all();
        return view('admin.portfolios.edit', compact('portfolio', 'brands', 'categories'));
    }

    /**
     * Update portofolio yang ada di database
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'brand_id'    => 'required|exists:brands,id',
            'title'       => 'required|string|max:255',
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'description' => 'nullable|string',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $portfolio->update([
            'brand_id'    => $validated['brand_id'],
            'title'       => $validated['title'],
            'portfolio_category_id' => $validated['portfolio_category_id'],
            'description' => $validated['description'],
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('portfolios', 'public');
                $portfolio->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('admin.portfolios.index')->with('success', 'Project Updated!');
    }

    public function show($id)
    {
        $portfolio = Portfolio::with(['brand', 'category', 'images'])->findOrFail($id);

        return view('admin.portfolios.show', compact('portfolio'));
    }

    /**
     * Hapus portofolio dari database
     */
    public function destroy(Portfolio $portfolio)
    {
        foreach ($portfolio->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio Deleted!');
    }
}
