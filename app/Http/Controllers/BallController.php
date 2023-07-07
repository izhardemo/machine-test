<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use App\Models\Bucket;
use App\Models\BucketSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $balls = Ball::paginate(10);
        return view('balls.index', compact('balls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('balls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:balls,name,',
            'volumn' => 'required',
        ]);

        $data = [
            'name' => Str::lower($request->name),
            'volumn' => $request->volumn,
        ];

        $save = Ball::create($data);

        if ($save) {
            $buckets = Bucket::all();

            foreach ($buckets as $bucket) {
                $bucket->empty_volumn = $bucket->total_volumn;
                $bucket->save();
            }
            BucketSuggestion::truncate();
            return back()->with('success', 'Ball successfully added');
        } else {
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ball $ball)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ball $ball)
    {
        return view('balls.edit', compact('ball'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ball $ball)
    {
        $request->validate([
            'name' => 'required|unique:balls,name,'. $ball->id,
            'volumn' => 'required',
        ]);

        $ball->name = Str::lower($request->name);
        $ball->volumn = $request->volumn;

        if ($ball->save()) {
            $buckets = Bucket::all();

            foreach ($buckets as $bucket) {
                $bucket->empty_volumn = $bucket->total_volumn;
                $bucket->save();
            }
            BucketSuggestion::truncate();
            return redirect()->route('balls.index')->with('success', 'Ball successfully updated');
        } else {
            return back()->with('error', 'Something went wrong. Please try again!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ball $ball)
    {
        //
    }
}
