

<div class="card bg-none card-box">

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
        <div class="form-group col-lg-6 col-md-6">

            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-6 col-md-6">

            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
    </div>
    <div class="form-group col-lg-6 col-md-6">

            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>

    <div class="form-group col-lg-6 col-md-6">

            <strong>Role:</strong>
            {!! Form::select('roles', $roles,[], array('class' => 'form-control select2')) !!}
        </div>
    <div class="col-md-12">
        <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
        <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
</div>
{!! Form::close() !!}


</div>
