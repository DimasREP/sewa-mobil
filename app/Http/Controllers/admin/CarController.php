<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Admin\CarStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\CarUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function index(): View
    {
        $cars = Car::all(); // Mengambil semua data mobil dari model Car
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
{
    return view('admin.cars.create');
}

public function edit(Car $car)
{
    return view('admin.cars.edit', compact('car'));
}


    public function store(CarStoreRequest $request): RedirectResponse
{
    if ($request->validated()) {
        $gambar = $request->file('gambar')->store('assets/car', 'public');
        $slug = Str::slug($request->nama_mobil, '-');

        Car::create($request->except('gambar') + ['gambar' => $gambar, 'slug' => $slug]);
    }

    return redirect()->route('cars.index')->with(['message' => 'Berhasil Ditambahkan', 'alert-type' => 'success']);
}

public function destroy(Car $car)
{
    if ($car->gambar) {
        Storage::delete($car->gambar);
    }
    $car->delete();

    return redirect()->back()->with(['message' => 'Data berhasil dihapus', 'alert-type' => 'danger']);
}

public function updateImage(Request $request, $carId)
{
    $request->validate([
        'gambar' => 'required|image'
    ]);
    $car = Car::findOrFail($carId);
    if ($request->gambar) {
        unlink('storage/' . $car->gambar);
        $gambar = $request->file('gambar')->store('assets/car', 'public');

        $car->update(['gambar' => $gambar]);
    }

    return redirect()->back()->with(['message' => 'Gambar berhasil di edit', 'alert-type' => 'info']);
}


    // public function show($id)
    // {
    //     $car = Car::findOrFail($id); // Mengambil mobil berdasarkan ID, atau menampilkan 404 jika tidak ditemukan
    //     return view('admin.cars.show', compact('car'));
    // }

}
