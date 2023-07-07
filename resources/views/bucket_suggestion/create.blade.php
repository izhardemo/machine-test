@extends('layouts.app')

@section('selected', 'active')

@section('content')
    <div class="card" >
        <div class="card-header my-2">
            <div class="d-flex justify-content-start">
                <h5>Bucket Suggestion</h5>
            </div>
        </div>
        <div class="row">
          <div class="col-6">
            <div class="card-body">
              <form id="bucket" action="{{route('bucketSuggestion.store')}}" method="post">
                @csrf
                <div class="row row-cols-2 align-items-center">
                  @forelse ($balls as $ball)
                  <div class="col-3 mb-3">
                    <label for="{{$ball->name}}" class="col-form-label">{{ucwords($ball->name)}}</label>
                  </div>
                  <div class="col-9 mb-3">
                    <input type="text" id="{{$ball->name}}" name="{{$ball->name}}" class="form-control">
                  </div>
                  @empty
                    
                  @endforelse
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-sm btn-primary my-2" form="bucket">Place balls in bucket</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-6" style="border-left: 1px solid grey">
            <h6>Result</h6>
            <p>Following are the suggested buckets:</p>
            @php
              if (session()->has('results')) {
                // Result for placed balls
                if (isset(session('results')['placedBalls'])) {
                  echo '<ul>';
                  foreach (session('results')['placedBalls'] as $result) {
                    foreach ($result as $bucket => $balls) {
                      echo "<li>Bucket $bucket: ";
                      echo "<b>Place ";
                      foreach ($balls as $ball => $qty) {
                        echo "$qty $ball balls";
  
                        if (count($balls) > 1) {
                          if (next($balls)) {
                            echo " and ";
                          }
                        }
                      }
                      echo "</b></li>";
                    }
                  }
                  echo "</ul>";
                }
                // Result for not placed balls
                if (isset(session('results')['notPlacedBalls'])) {
                  echo "<strong>Not Placed Balls: </strong>";
                  echo '<ul>';
                  foreach (session('results')['notPlacedBalls'] as $balls) {
                    foreach ($balls as $ball => $qty) {
                      if ($qty == 0) {
                        continue;
                      }
                      echo "<li>".ucwords($ball)." balls: $qty</li>";
                    }
                  }
                  echo "</ul>";
                }
              }
            @endphp
          </div>
        </div>
    </div>
@endsection