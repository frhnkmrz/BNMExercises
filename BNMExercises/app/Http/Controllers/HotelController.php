<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $query = Hotel::query();

        // Paginated list
        $hotels = $query->latest()->paginate(6);

        // Add image_url to each hotel
        $hotels->getCollection()->transform(function ($hotel) {
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;
            return $hotel;
        });

        return response()->json($hotels);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price_per_night' => 'required|numeric',
            'rating' => 'nullable|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('hotels', 'public');
            }

            $hotel = Hotel::create($validated);
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;

            return response()->json([
                'message' => 'Hotel created successfully',
                'hotel' => $hotel
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create hotel', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(Hotel $hotel)
    {
        $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;
        return response()->json($hotel);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'category' => 'sometimes|required',
            'price_per_night' => 'sometimes|required|numeric',
            'rating' => 'sometimes|numeric|min:0|max:5',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($hotel->image) {
                    Storage::disk('public')->delete($hotel->image);
                }

                $validated['image'] = $request->file('image')->store('hotels', 'public');
            }

            $hotel->update($validated);
            $hotel->image_url = $hotel->image ? asset('storage/' . $hotel->image) : null;

            return response()->json([
                'message' => 'Hotel updated successfully',
                'hotel' => $hotel
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update hotel', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Hotel $hotel)
    {
        try {
            if ($hotel->image) {
                Storage::disk('public')->delete($hotel->image);
            }

            $hotel->delete();

            return response()->json(['message' => 'Hotel deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete hotel', 'error' => $e->getMessage()], 500);
        }
    }
}
