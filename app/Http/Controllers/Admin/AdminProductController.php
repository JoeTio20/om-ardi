<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    private function ensureDir(string $path): void
    {
        if (!file_exists($path)) mkdir($path, 0777, true);
    }

    private function uploadImages(Request $request): array
    {
        $images = [];
        if (!$request->hasFile('images')) return $images;
        $dir = public_path('IMAGE');
        $this->ensureDir($dir);
        foreach ($request->file('images') as $file) {
            if (!$file->isValid()) continue;
            $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($dir, $name);
            $images[] = '/IMAGE/' . $name;
        }
        return $images;
    }

    private function uploadVideo(Request $request): ?string
    {
        if (!$request->hasFile('video') || !$request->file('video')->isValid()) return null;
        $dir = public_path('VIDEO');
        $this->ensureDir($dir);
        $file = $request->file('video');
        $name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move($dir, $name);
        return '/VIDEO/' . $name;
    }

    public function dashboard()
    {
        $totalProducts    = Product::count();
        $activeProducts   = Product::where('is_active', true)->count();
        $inactiveProducts = Product::where('is_active', false)->count(); // ← tambah ini
        $latestProducts   = Product::latest()->take(5)->get();
        $avgPrice         = Product::avg('price');
        $bestSeller       = Product::first()?->name;
        return view('admin.dashboard', compact(
            'totalProducts', 'activeProducts', 'inactiveProducts',
            'latestProducts', 'avgPrice', 'bestSeller'
        ));
    }
    public function index()
    {
        $products      = Product::latest()->paginate(10);
        $totalProducts = Product::count();
        $bestSeller    = Product::orderBy('price', 'desc')->first()?->name;
        $avgPrice      = number_format(Product::avg('price') / 1000000, 1) . 'M';
        return view('admin.products.index', compact('products', 'totalProducts', 'bestSeller', 'avgPrice'));
    }

    public function create()
    {
        return view('admin.products.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string',
            'badge'       => 'nullable|string',
            'is_active'   => 'required',
            'images.*'    => 'nullable|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'video'       => 'nullable|mimes:mp4,mov,avi,webm|max:102400',
        ]);

        $images = $this->uploadImages($request);
        $video  = $this->uploadVideo($request);

        Product::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => (int) $request->price,
            'badge'       => $request->badge ?: null,
            'category'    => $request->category,
            'is_active'   => filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN),
            'images'      => $images ?: ['/IMAGE/SUPER.jpeg'],
            'video'       => $video,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category'    => 'required|string',
            'badge'       => 'nullable|string',
            'is_active'   => 'required',
            'images.*'    => 'nullable|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'video'       => 'nullable|mimes:mp4,mov,avi,webm|max:102400',
        ]);

        $images = $this->uploadImages($request) ?: $product->images;
        $video  = $this->uploadVideo($request)  ?? $product->video;

        $product->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => (int) $request->price,
            'badge'       => $request->badge ?: null,
            'category'    => $request->category,
            'is_active'   => filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN),
            'images'      => $images,
            'video'       => $video,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
