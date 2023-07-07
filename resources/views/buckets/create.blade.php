@extends('layouts.app')

@section('selected', 'active')

@section('content')
    <div class="card" >
        <div class="card-header my-2">
            <div class="d-flex justify-content-between">
                <h5>Add Bucket</h5>
                <a href="{{route('buckets.index')}}" class="btn btn-sm btn-primary">Back</a>
            </div>
        </div>
        <div class="card-body">
          <form id="bucket" action="{{route('buckets.store')}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Bucket Name</label>
              <input type="text" name="name" class="form-control" id="name" placeholder="Bucket Name">
              @error('name')
                <span class="text-danger text-sm">{{$message}}</span>
              @enderror
            </div>
            <div class="mb-3">
              <label for="volumn" class="form-label">Volumn (in Inches)</label>
              <input type="text" name="volumn" class="form-control" id="volumn" placeholder="Bucket Volumn">
              @error('volumn')
                <span class="text-danger text-sm">{{$message}}</span>
              @enderror
            </div>
          </form>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary my-2" form="bucket">Save</button>
        </div>
    </div>
@endsection