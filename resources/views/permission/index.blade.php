@extends('layouts.admin')
@section('content')
    <div class="main-content">
        <section class="section">
            
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between w-100">
                                    <h4> {{__('Manage Permission')}}</h4>

                                    <a href="#" data-url="{{ route('permissions.create') }}" class="btn btn-sm btn-primary btn-round btn-icon" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Add Permission')}}" data-original-title="{{__('Add Permission')}}">


                                        {{ __('Create') }}
                                    </a>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12 card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped dataTable" >
                                                        <thead class="">
                                                        <tr>
                                                            <th scope="col" style="width: 88%;">{{__('title')}}</th>
                                                            <th scope="col" style="width: 12%;">{{__('Action')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach ($permissions as $permission)
                                                            <tr role="row">
                                                                <td>{{ $permission->name }}</td>
                                                                <td>
                                                                    <a href="#" data-url="{{ route('permissions.edit',$permission->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Update permission')}}" class="btn btn-outline btn-sm blue-madison">
                                                                        <i class="far fa-edit"></i>
                                                                    </a>
                                                                    <a href="#" class="btn btn-outline btn-sm red" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$permission->id}}').submit();">
                                                                        <i class="far fa-trash-alt"></i></a>
                                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id],'id'=>'delete-form-'.$permission->id]) !!}
                                                                    {!! Form::close() !!}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
