<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as GetRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;



class AffiliatesController extends Controller
{

    public function index()
    {
        $office = new Office(53.3340285, -6.2535495);
        return Inertia::render('Affiliates/Index', [
            'filters' => GetRequest::all( 'distance'),
            'affiliates' => Affiliate::IsWithinMaxDistance($office, GetRequest::get('distance'))
                ->orderByDesc('distance')
                ->paginate(10)
                ->withQueryString()
                ->through(fn ($affiliate) => [
                        'affiliate_id' => $affiliate->affiliate_id,
                        'name' => $affiliate->name,
                        'distance' => $affiliate->distance
                    ]),
        ]);
    }


    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file']
        ]);

        try {
            $data = $request->file->parseJson();

            // Truncates & inserts
            Affiliate::truncate();
            Affiliate::insert($data);

            return Redirect::route('affiliates', ['distance' => 500])->with('success', 'Affiliates file imported.');

        } catch (\Exception $e) {
            throw ValidationException::withMessages(['file' => 'An error occurred parsing the give file', 'message' => $e->getMessage()]);
        }
    }


}
