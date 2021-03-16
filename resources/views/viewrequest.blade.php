@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Requests</h1> 
    @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif
    <center>   
  <table class="table table-striped" style="width:95%;">
    <thead>
        <tr>
          <td>Request No.</td>
          <td>Name</td>
          <td>Made To</td>
          <td>Requested Item</td>
          <td>Approval Status</td>
          <td>Request Made On</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{$d->id}}</td>
            <td>{{$d->made_by}}</td>
            <td>{{$d->made_to}}</td>
            <td>{{$d->requested_item}}</td>
            <td>{{$d->approval_status}}</td>
            <td>{{$d->request_made_on}}</td>
            

            @if((Auth::user()->usertype) == '4')
            <td>
              <a href="/fulfilled/{{($d->id)}}" class="btn btn-success">Fullfilled</a>
            </td>
            @elseif((Auth::user()->usertype) == '2' || (Auth::user()->usertype) == '3' || (Auth::user()->usertype) == '4')
            <td>
                <a href="/approve-request/{{($d->id)}}" class="btn btn-primary">Approve</a>
                <a href="/disapprove-request/{{($d->id)}}" onclick="return confirm('Are you Sure you want to Disapprove?')" class="btn btn-danger">Disapprove</a>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
{{$data->links()}}</center>
<div>
</div>
@endsection