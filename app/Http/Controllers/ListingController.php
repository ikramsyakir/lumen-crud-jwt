<?php

namespace App\Http\Controllers;

use App\Listing;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ListingController extends Controller
{
    /**
     * Instantiate a new ListingController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all listing based on User ID
     *
     * @return JsonResponse
     */
    public function index()
    {
        $listings = Listing::where('user_id', Auth::user()->id)->get();

        return response()->json(['listing' => $listings], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'details' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        $listing = Listing::create([
            'name' => $request->name,
            'details' => $request->details,
            'user_id' => $request->user_id
        ]);

        if ($listing) {
            return response()->json(['listing' => $listing, 'message' => 'Successful created listing'], 201);
        } else {
            return response()->json(['message' => 'Unsuccessful create listing'], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $listing = Listing::findOrFail($id);

        return response()->json(['listing' => $listing], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $listing = Listing::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string',
            'details' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        $listing->update([
            'name' => $request->name,
            'details' => $request->details,
            'user_id' => $request->user_id
        ]);

        return response()->json(['listing' => $listing, 'message' => 'Successful updated listing'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);

        if ($listing->delete()) {
            return response()->json(['message' => 'Successfully deleted listing'], 200);
        } else {
            return response()->json(['message' => 'Unsuccessfully delete listing'], 409);
        }
    }
}
