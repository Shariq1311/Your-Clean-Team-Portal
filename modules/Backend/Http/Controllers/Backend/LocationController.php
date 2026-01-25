<?php

namespace MojarCMS\Backend\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use MojarCMS\Backend\Models\Location;
use MojarCMS\CMS\Http\Controllers\BackendController;

class LocationController extends BackendController
{
    /**
     * Get all active locations
     */
    public function index(): JsonResponse
    {
        $locations = Location::where('status', 'active')
            ->orderBy('name', 'asc')
            ->get();

        return response()->json([
            'data' => $locations,
            'count' => $locations->count(),
        ]);
    }

    /**
     * Get a specific location
     */
    public function show(Location $location): JsonResponse
    {
        return response()->json([
            'data' => $location,
        ]);
    }

    /**
     * Create a new location (admin only)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'nullable|string',
            'zip_code' => 'required|string',
            'contact_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'location_type' => 'required|in:residential,commercial',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $location = Location::create($validated);

        return response()->json([
            'message' => 'Location created successfully.',
            'data' => $location,
        ], 201);
    }

    /**
     * Update a location (admin only)
     */
    public function update(Request $request, Location $location): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string',
            'city' => 'sometimes|string',
            'state' => 'nullable|string',
            'zip_code' => 'sometimes|string',
            'contact_name' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'location_type' => 'sometimes|in:residential,commercial',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'notes' => 'nullable|string',
            'status' => 'sometimes|in:active,inactive',
        ]);

        $location->update($validated);

        return response()->json([
            'message' => 'Location updated successfully.',
            'data' => $location,
        ]);
    }

    /**
     * Delete a location (admin only)
     */
    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json([
            'message' => 'Location deleted successfully.',
        ]);
    }
}
