<div class="card bg-none card-box">

    {!! Form::open(array('route' => 'products.store','method'=>'POST')) !!}
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">

                <strong>Name:</strong>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
            </div>
        <div class="form-group col-lg-6 col-md-6">

                <strong>Details:</strong>
                {!! Form::text('detail', null, array('placeholder' => 'detail','class' => 'form-control')) !!}
            </div>

        <div class="col-md-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {!! Form::close() !!}


    </div>
