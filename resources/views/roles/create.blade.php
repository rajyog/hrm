
<div class="card bg-none card-box">
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
                {{Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter Role Name')))}}
                @error('name')
                <span class="invalid-name" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @if(!empty($permissions))
                    <h6 class="my-3">{{__('Assign Permission to Roles')}} </h6>
                    <table class="table table-striped mb-0" id="dataTable-1">
                        <thead>
                        <tr>
                            <th>{{__('Module')}} </th>
                            <th>{{__('Permissions')}} </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
$modules=['User','Role','Department','Designation','Branch','Event','Document','Job Category','User Last Login','Company Setting','Job Stage','Job','Job Application','Permission','Product'];

                            if(Auth::user()->type == 'super admin'){
                                $modules[] = 'Language';
                            }

                        @endphp
                        @foreach($modules as $module)
                            <tr>
                                <td>{{ ucfirst($module) }}</td>
                                <td>
                                    <div class="row ">
                                        @if(in_array('Manage '.$module,(array) $permissions))
                                            @if($key = array_search('Manage '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Manage',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('Create '.$module,(array) $permissions))
                                            @if($key = array_search('Create '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Create',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('Edit '.$module,(array) $permissions))
                                            @if($key = array_search('Edit '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Edit',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('Delete '.$module,(array) $permissions))
                                            @if($key = array_search('Delete '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Delete',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif
                                        @if(in_array('Show '.$module,(array) $permissions))
                                            @if($key = array_search('Show '.$module,$permissions))
                                                <div class="col-md-3 custom-control custom-checkbox">
                                                    {{Form::checkbox('permissions[]',$key,false, ['class'=>'custom-control-input','id' =>'permission'.$key])}}
                                                    {{Form::label('permission'.$key,'Show',['class'=>'custom-control-label font-weight-500'])}}<br>
                                                </div>
                                            @endif
                                        @endif


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="col-12">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{Form::close()}}
</div>
