<div class="card bg-none card-box">
    {{Form::open(array('url'=>'event','method'=>'post'))}}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('user_id',__('User'),['class'=>'form-control-label'])}}
                <select class="form-control select2" name="user_id" id="user_id" placeholder="{{__('Select user')}}">
                    <option value="">{{__('Select user')}}</option>
                    <option value="0">{{__('All user')}}</option>
                    @foreach($user as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('title',__('Event Title'),['class'=>'form-control-label'])}}
                {{Form::text('title',null,array('class'=>'form-control','placeholder'=>__('Enter Event Title')))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('start_date',__('Event start Date'),['class'=>'form-control-label'])}}
                {{Form::text('start_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('end_date',__('Event End Date'),['class'=>'form-control-label'])}}
                {{Form::text('end_date',null,array('class'=>'form-control datepicker'))}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {{Form::label('color',__('Event Select Color'),['class'=>'form-control-label d-block mb-3'])}}
                <div class="btn-group btn-group-toggle btn-group-colors event-tag" data-toggle="buttons">
                    <label class="btn bg-info active"><input type="radio" name="color" value="#00B8D9" checked></label>
                    <label class="btn bg-warning"><input type="radio" name="color" value="#FFAB00"></label>
                    <label class="btn bg-danger"><input type="radio" name="color" value="#FF5630"></label>
                    <label class="btn bg-success"><input type="radio" name="color" value="#36B37E"></label>
                    <label class="btn bg-secondary"><input type="radio" name="color" value="#EFF2F7"></label>
                    <label class="btn bg-primary"><input type="radio" name="color" value="#051C4B"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('description',__('Event Description'),['class'=>'form-control-label'])}}
                {{Form::textarea('description',null,array('class'=>'form-control','placeholder'=>__('Enter Event Description')))}}
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
