@extends('layouts.app')

@section('selected', 'active')

@section('content')
    <div class="card" >
        <div class="card-header my-2">
            <div class="d-flex justify-content-between">
                <h5>Update Ball</h5>
                <a href="{{route('balls.index')}}" class="btn btn-sm btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body">
          <form id="ball" action="{{route('balls.update', $ball->id)}}" method="post">
            @csrf @method('PUT')
            <div class="mb-3">
              <label for="name" class="form-label">Ball Name</label>
              <input type="text" name="name" class="form-control" id="name" value="{{old('name', ucwords($ball->name))}}" placeholder="Ball Name">
              @error('name')
                <span class="text-danger text-sm">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="volumn" class="form-label">Volumn (in Inches)</label>
              <input type="text" name="volumn" class="form-control" id="volumn" value="{{old('volumn', $ball->volumn)}}" placeholder="Ball Volumn">
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