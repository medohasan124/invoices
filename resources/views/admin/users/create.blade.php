@extends('admin.layouts.master')
@section('css')
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{$title}}</h4>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')




 @if(session()->get('success'))

<div class="alert alert-success" role="alert">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
	   <span aria-hidden="true">&times;</span>
  </button>
    {{session()->get('success')}}
</div>
    @endif

    @if(count($errors) > 0)
     
      	@foreach($errors->all() as $err)
			<div class="alert alert-danger mg-b-0" role="alert">
				<button aria-label="Close" class="close" data-dismiss="alert" type="button">
					<span aria-hidden="true">&times;</span>
				</button>
				{{$err}}
			</div>
        @endforeach
     
    @endif
				<!-- row -->
				
	<div class="row">
		<div class="col-md-12 col-lg-12 col-xl-7">
			
				{{Form::open(['method' => 'post' , 'route' => 'users.store'])}}

					{{Form::label(trans('admin.userName'))}}
					{{Form::text('name' , null , ['class' => 'form-control'])}}

					{{Form::label(trans('admin.email'))}}
					{{Form::email('email' , null , ['class' => 'form-control'])}}

					{{Form::label(trans('admin.password'))}}
					{{Form::password('password' ,['class' => 'form-control'])}}

					{{Form::label(trans('admin.status'))}}
					<select name='status' class='form-control'>
							<option class='d-none'>please Select</option>
							<option value='active'>active</option>
							<option value='disactive'>disactive</option>
						
					</select>


					{{Form::label(trans('admin.member'))}}
					<select name='member' class='form-control'>
						<option class='d-none'>please Select</option>
						@foreach($roles as $row)
							<option value='{{$row->id}}'>{{$row->name}}</option>
						@endforeach
					</select>
				{{Form::submit(trans('admin.save') , ['class' => 'btn btn-success'])}}
				{{Form::close()}}
			
				</div>
			</div>
	
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

<script>
	$('form select').change(function(){
		var value = $(this).val() ;
		console.log(value);
		//if($('form .product option').not().hasClass('1').hide()){}
		$('form .product').removeAttr('disabled');
		$('form .product option').hide().filter('form .product .'+ value).show();
		//$('form .product option').hasClass('1').show();

	});

	$('form .vat').keyup(function(){
		var vat 	 = Number($(this).val() );
		var my_vat 	 = Number($('form .my_vat').val() );
		var rate_vat = Number($('form .rate_vat').val() );
		var total 	 = Number($('form .total').val() );
		var  t 		 = vat * rate_vat / 100 ;
		$('form .my_vat').val(t) ;
		$('form .total').val(vat-t) ;
		
	});

	$('form .rate_vat').keyup(function(){
		var vat 	 = Number($('form .vat').val() );
		var my_vat 	 = Number($('form .my_vat').val() );
		var rate_vat = Number($(this).val() );
		var total 	 = Number($('form .total').val() );
		var  t 		 = vat * rate_vat / 100 ;
		$('form .my_vat').val(t) ;
		$('form .total').val(vat-t) ;
	});


</script>
@endsection