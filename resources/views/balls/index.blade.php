@extends('layouts.app')

@section('selected', 'active')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5>Ball List</h5>
                <a href="{{route('balls.create')}}" class="btn btn-sm btn-primary">Create</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Volumn (in Inches)</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                        $sn = $balls->perPage() * ($balls->currentPage() - 1);
                    @endphp
                    @forelse ($balls as $ball)
                    <tr>
                        <th scope="row">{{$sn + 1}}</th>
                        <td>{{ucwords($ball->name)}}</td>
                        <td>{{ucwords($ball->volumn)}}</td>
                        <td><a href="{{route('balls.edit', $ball->id)}}"><i class="far fa-edit"></i></a></td>
                    </tr>
                    @php
                        $sn ++;
                    @endphp
                    @empty
                    <tr>
                        <td colspan="4">No data found...</td>
                    </tr>
                @endforelse
                </tbody>
              </table>
        </div>
        <div class="card-footer">
            {!! $balls->links() !!}
        </div>
    </div>
@endsection