<!DOCTYPE html>
<html>
  <head>
    <title>Request Form</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="{{ asset('css/form.css') }}" rel="stylesheet">
  </head>
  <body>
  <div class="testbox">
      <form method="POST" action="/send-request">
      @csrf
        <div class="banner">
          <h1>Request Form</h1>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="item">
          <label for="name">Name<span>*</span></label>
          <input id="name" type="text" name="name" required  value="{{ Auth::user()->name }}"/>
        </div>
        <div class="item">
          <label for="dept">Department<span>*</span></label>
          <input id="dept" type="text" name="dept" value ="{{ Auth::user()->department }}" readonly required />
        </div>

        <div class="item">
          <label for="requested_item">Request Item<span>*</span></label><br>
          <select id="requested_item" name = 'requested_item' required style="font-size:18px;width:100%">
                <option hidden disabled selected value></option>
                <option value="1">X</option>
                <option value="2">Y</option>
                <option value="3">z</option>
            </select>
        </div>


        <div class="btn-block">
          <button type="submit"> Make Request</button>
        </div>
      </form>
    </div>
  </body>
</html>