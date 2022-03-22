

<div class="card bg-none card-box">
    {{ Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) }}
    {!! Form::model($product, ['method' => 'PATCH','route' => ['products.update', $product->id]]) !!}

    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('name', __('Name'),['class'=>'form-control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>
        <div class="form-group col-lg-6 col-md-6">
            {!! Form::label('detail', __('detail'),['class'=>'form-control-label']) !!}
            {!! Form::text('detail', null, ['class' => 'form-control','required' => 'required']) !!}
        </div>


        <div class="col-md-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {!! Form::close() !!}
</div>
