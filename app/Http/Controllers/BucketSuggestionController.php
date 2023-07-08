<?php

namespace App\Http\Controllers;

use App\Models\Ball;
use App\Models\Bucket;
use App\Models\BucketSuggestion;
use Illuminate\Http\Request;

class BucketSuggestionController extends Controller
{
    public function create()
    {
        $balls = Ball::all();
        
        return view('bucket_suggestion.create', compact('balls'));
    }

    public function store(Request $request)
    {
        $inputs = [];
        $response = [];
        $placedBall = [];
        $notPlacedBall = [];
        
        // filter request
        foreach ($request->input() as $key => $input) {
            if ($key == '_token' || empty($input)) {
                continue;
            }
            $inputs[$key] = $input;
        }

        // create new array by balls name
        $inputBalls = array_keys($inputs);

        $balls = Ball::whereIn('name', $inputBalls)->get();
        $sizes = $balls->sum('volumn');

        if ($sizes > 0) {
            
            foreach ($balls as $ball) {
                $buckets = Bucket::where('empty_volumn', '>', 0)->orderBy('total_volumn', 'DESC')->get();

                $singleBallSize = $this->getFloatVolumn($ball->volumn);
                $remainingQty = $inputs[$ball->name];

                if ($remainingQty <= 0) {
                    continue;
                }

                foreach ($buckets as $bucket) {
                    $bucketEmptyVolumn = $bucket->empty_volumn;
                    $allowQty = floor($bucketEmptyVolumn/$singleBallSize);
                    $addedQty = 0;
                    
                    if ($singleBallSize > $bucketEmptyVolumn) {
                        continue;
                    }

                    if ($remainingQty > 0) {
                        $data['bucket_id'] = $bucket->id;
                        $data['ball_id'] = $ball->id;
                        if($remainingQty > $allowQty) {
                            $data['ball_qty'] = $allowQty;
                        } else {
                            $data['ball_qty'] = $remainingQty;
                        }
                        $addedQty = $addedQty + $data['ball_qty'];

                        BucketSuggestion::create($data);

                        if ($remainingQty > $allowQty) {
                            $remainingQty = $remainingQty - $allowQty;
                            $allowQtySize = $allowQty * $ball->volumn;
                        } else {
                            $allowQtySize = $remainingQty * $ball->volumn;
                            $remainingQty = 0;
                        }

                        $bucket->empty_volumn = $bucket->empty_volumn - $this->getFloatVolumn($allowQtySize);
                        $bucket->save();
                    } else {
                        continue;
                    }
                    
                    $placedBall[$bucket->name][$ball->name] = $addedQty;
                }

                if ($remainingQty > 0) {
                    $notPlacedBall[$ball->name] = $remainingQty;
                }
                
            }

            if ($placedBall) {
                $response['placedBalls'][] = $placedBall;
            }

            if ($notPlacedBall) {
                $response['notPlacedBalls'][] = $notPlacedBall;
            }
            
            return back()->with('results', $response);
        } else {
            return back()->with('error', 'At least one ball field is required!');
        }
    }

    function getFloatVolumn($val) {
        return (float)sprintf("%0.2f", $val);
    }

    function storeBall($allowQty, $remainingQty, $bucketId, $ballId)
    {
        if($remainingQty > $allowQty) {
            $data['bucket_id'] = $bucketId;
            $data['ball_id'] = $ballId;
            $data['ball_qty'] = $allowQty;
        } else {
            $data['bucket_id'] = $bucketId;
            $data['ball_id'] = $ballId;
            $data['ball_qty'] = $remainingQty;
        }

        BucketSuggestion::create($data);
    }
}
