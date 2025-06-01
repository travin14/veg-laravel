<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class AdminController extends Controller
{
    // 🏠 Admin Dashboard
    public function dashboard()
    {
        $this->checkAccess();

        $categories = Category::all();
        $products = Product::with('category')->get();
        $orders = Order::with('user')->latest()->get();

        return view('admin.dashboard', compact('categories', 'products', 'orders'));
    }

    // 🔐 Admin Login
    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (
            $request->email === env('ADMIN_EMAIL') &&
            $request->password === env('ADMIN_PASSWORD')
        ) {
            Session::put('is_admin_logged_in', true);
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', 'Invalid admin credentials');
    }

    // ➕ Show Create Product Form
    public function createProduct()
    {
        $this->checkAccess();

        $categories = Category::all();
        return view('admin.add_product', compact('categories'));
    }

    // ➕ Show Create Category Form
    public function createCategory()
    {
        $this->checkAccess();
        return view('admin.add_category');
    }

    // ✅ Store New Category
    public function addCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('admin.dashboard')->with('success', 'Category added successfully!');
    }

    // ✅ Store New Product
    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'sale_price' => $request->input('sale_price') ?? null,
            'description' => $request->input('description'),
            'on_sale' => $request->has('on_sale'),
            'in_stock' => $request->has('in_stock'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    // ✏️ Edit Product
    public function editProduct($id)
    {
        $this->checkAccess();

        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.edit_product', compact('product', 'categories'));
    }

    // ✅ Update Product
    public function updateProduct(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $product->fill([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'sale_price' => $validated['sale_price'] ?? null,
            'description' => $request->input('description'),
            'on_sale' => $request->has('on_sale'),
            'in_stock' => $request->has('in_stock'),
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->image = $request->file('image')->store('products', 'public');
        }

        $product->save();

        return redirect()->route('admin.dashboard')->with('success', 'Product updated successfully!');
    }

    // 🗑️ Delete Product
    public function deleteProduct($id)
    {
        $this->checkAccess();

        $product = Product::findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    // ✏️ Edit Category
    public function editCategory($id)
    {
        $this->checkAccess();

        $category = Category::findOrFail($id);
        return view('admin.edit_category', compact('category'));
    }

    // ✅ Update Category
    public function updateCategory(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->route('admin.dashboard')->with('success', 'Category updated successfully!');
    }

    // 🗑️ Delete Category
    public function deleteCategory($id)
    {
        $this->checkAccess();

        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Category deleted successfully!');
    }

    // 📦 Orders View
    public function viewOrders()
    {
        $this->checkAccess();

        $orders = Order::with('user')->latest()->get();
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('admin.dashboard', compact('orders', 'products', 'categories'));
    }

    // ✅ Update Order Status
    public function updateOrderStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|in:Processing,Shipped,Delivered',
        ]);

        $order = Order::findOrFail($request->order_id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.dashboard')->with('success', 'Order status updated!');
    }

    // 🔐 Reusable Access Check
    private function checkAccess()
    {
        if (!Session::get('is_admin_logged_in')) {
            abort(403, 'Unauthorized.');
        }
    }
}
