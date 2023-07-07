<?php

namespace App\Http\Controllers;

use App\Models\Bucket;
use App\Models\BucketSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BucketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buckets = Bucket::paginate(10);
        return view('buckets.index', compact('buckets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buckets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:buckets,name,',
            'volumn' => 'required',
        ]);

        $data = [
            'name' => Str::lower($request->name),
            'total_volumn' => $request->volumn,
            'empty_volumn' => $request->volumn,
        ];

        $save = Bucket::create($data);

        if ($save) {
            $buckets = Bucket::all();

            foreach ($buckets as $bucket) {
                $bucket->empty_volumn = $bucket->total_volumn;
                $bucket->save();
            }
            BucketSuggestion::truncate();
            return back()->with('success', 'Bucket successfully added');
        } else {
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bucket $bucket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bucket $bucket)
    {
        return view('buckets.edit', compact('bucket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bucket $bucket)
    {
        $request->validate([
            'name' => 'required|unique:buckets,name,'. $bucket->id,
            'volumn' => 'required',
        ]);

        $bucket->name = Str::lower($request->name);
        $bucket->total_volumn = $request->volumn;
        $bucket->empty_volumn = $request->volumn;

        if ($bucket->save()) {
            $buckets = Bucket::all();

            foreach ($buckets as $bucket) {
                $bucket->empty_volumn = $bucket->total_volumn;
                $bucket->save();
            }
            BucketSuggestion::truncate();
            return redirect()->route('buckets.index')->with('success', 'Bucket successfully updated');
        } else {
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bucket $bucket)
    {
        //
    }
}
