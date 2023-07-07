@extends('layouts.app')

@section('selected', 'active')

@section('content')
    <div class="card" >
        <div class="card-header my-2">
            <div class="d-flex justify-content-between">
                <h5>Add Ball</h5>
                <a href="{{route('balls.index')}}" class="btn btn-sm btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body">
          <form id="ball" action="{{route('balls.store')}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Ball Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Ball Name">
              @error('name')
                <span class="text-danger text-sm">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="volumn" class="form-label">Volumn (in Inches)</label>
              <input type="text" name="volumn" class="form-control" id="volumn" placeholder="Ball Volumn">
              @error('volumn')
                <span class="text-danger text-sm">{{$message}}</span>
              @enderror
            </div>
          </form>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary my-2" form="ball">Save</button>
        </div>
    </div>
@endsection