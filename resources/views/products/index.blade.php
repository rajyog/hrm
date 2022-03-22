@extends('layouts.admin')
@section('page-title')
    {{__('Manage Product')}}
@endsection

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('Create Role')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="#" data-url="{{ route('products.create') }}" data-size="xl" data-ajax-popup="true" data-title="{{__('Create New Role')}}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <i class="fa fa-plus"></i> {{__('Create')}}
            </a>
            </div>
        @endcan
    </div>
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>No</th>
            <th>Name</th>
            <th>Details</th>
                                @if(Gate::check('Edit Product') || Gate::check('Delete Product'))
                                    <th width="200px">{{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    {{-- <td class="Id">
                                        @can('Show Product')
                                            <a href="{{route('Product.show',\Illuminate\Support\Facades\Crypt::encrypt($Product->id))}}">{{ \Auth::user()->productIdFormat($product->product_id) }}</a>
                                        @else
                                            <a href="#">{{ \Auth::user()->productIdFormat($product->product_id) }}</a>
                                        @endcan
                                    </td> --}}
                                    <td class="font-style">{{ $product->id }}</td>
                                    <td class="font-style">{{ $product->name }}</td>
                                    <td>{{ $product->detail }}</td>
                                    {{-- <td class="font-style">{{!empty(\Auth::user()->getBranch($product->branch_id ))?\Auth::user()->getBranch($product->branch_id )->name:''}}</td>
                                    <td class="font-style">{{!empty(\Auth::user()->getuser($product->department_id ))?\Auth::user()->getuser($product->department_id )->name:''}}</td>
                                    <td class="font-style">{{!empty(\Auth::user()->getDesignation($product->designation_id ))?\Auth::user()->getDesignation($product->designation_id )->name:''}}</td>
                                    {{-- <td class="font-style">{{ \Auth::user()->dateFormat($product->company_doj )}}</td> --}}
                                    @if(Gate::check('Edit product') || Gate::check('Delete Product'))
                                        <td>
                                            {{-- @if($product->is_active==1) --}}
                                                @can('Edit Product')
                                            <a href="#" data-url="{{ route('products.edit',$product->id) }}" data-size="lg" data-ajax-popup="true" data-title="{{__('Edit Role')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                                    </a>
                                                @endcan
                                                @can('Delete Product')
                                                    <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$product->id}}').submit();"><i class="fas fa-trash"></i></a>
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id],'id'=>'delete-form-'.$product->id]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            {{-- @else
                                                <i class="fas fa-lock"></i>
                                            @endif --}}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


