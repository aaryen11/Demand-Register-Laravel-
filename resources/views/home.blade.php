@extends('layouts.app')

@section('content')
<style>


.badge {
   position:relative;
}
.badge[data-badge]:after {
   content:attr(data-badge);
   position:absolute;
   top:-5px;
   right:-5px;
   font-size:.7em;
   background:green;
   color:white;
   width:18px;
   height:18px;
   text-align:center;
   line-height:18px;
   border-radius:50%;
   box-shadow:0 0 1px #333;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!--<div class="card-header">{{ __('Dashboard') }}</div>-->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if((Auth::user()->usertype) == '1')
                    <a href="/make-request" >
                    <button type="submit" class="btn btn-primary">
                        Make Request
                     </button>
                     </a>
                     @elseif((Auth::user()->usertype) == '2' || (Auth::user()->usertype) == '3' || (Auth::user()->usertype) == '4')
                     <a href="/view-request" class="badge" data-badge={{($data)}}>
                    <button type="submit" class="btn btn-primary">
                        View Request
                     </button>
                     </a>

                     @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
