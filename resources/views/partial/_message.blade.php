@if(Session::has('success'))
<div class="row col-sm-12">
    <div class=" col-sm-8 col-sm-offset-2 alert alert-success" role="alert" >
    {{Session::get('success')}}    <i class="fa fa-fw fa-check-circle fa-lg" style="color:green"></i> 
    </div>
</div>
    @endif

    @if(Session::has('warning'))
    <div class="row col-sm-12">
    <div class=" col-sm-8 col-sm-offset-2 alert alert-warning" role="alert" >
      {{Session::get('warning')}}
    </div>
</div>
    @endif
   @if(Session::has('danger'))
    <div class="row col-sm-12">
    <div class=" col-sm-8 col-sm-offset-2 alert alert-danger" role="alert" >
      {{Session::get('danger')}}
    </div>
</div>
    @endif
@if(count($errors) > 0)
<div class="row col-sm-12">
    <div class="col-sm-8 col-sm-offset-2 alert alert-danger" role="alert" >

        <strong>Error <i class="fa fa-times fa-lg" aria-hidden="true"></i></strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
        </ul>
    </div>
    </div>

    @endif