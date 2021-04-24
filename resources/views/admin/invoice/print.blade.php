@extends('admin.layouts.master')
@section('css')

@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
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
				<!-- row -->
				<div class="row">
					<div class="col-md-8 col-xl-12 col-xs-12 col-sm-12">
						<!--div-->
						<div class="card ">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Opacity
								</div>
								<p class="mg-b-20">It is Very Easy to Customize and it uses in website apllication.</p>
								<div class='row'>
									<div class='col-md-6'>
										<ol>
											<li>{{trans('admin.inv_number')}}</li>
											<li>{{trans('admin.inv_date')}}</li>
											<li>{{trans('admin.end_date')}}</li>
											<hr>
											<li>{{trans('admin.product')}}</li>
											<li>{{trans('admin.section')}}</li>
											<hr>
											<li>{{trans('admin.vat')}}</li>
											<li>{{trans('admin.rate_vat')}}</li>
											<li>{{trans('admin.my_vat')}}</li>
											<li>{{trans('admin.total')}}</li>
											<hr>
											<li>{{trans('admin.status')}}</li>
											<li>{{trans('admin.addBy')}}</li>
											<li>{{trans('admin.discription')}}</li>
										</ol>
									</div>

									<div class='col-md-6'>
										<ul>
										<li>{{$data->invoice_number}}</li>
										<li>{{$data->invoice_date}}</li>
										
										<li>{{$data->due_date}}</li>
										<hr>
										<li>{{\App\products::where('id' , $data->product)->first()->name}}</li>
										<li>{{\App\sections::where('id' , $data->section)->first()->name}}</li>
										<hr>
										<li>{{$data->vat}} $</li>
										<li>{{$data->rate_vat}} $</li>
										<li>{{$data->my_vat}} $</li>
										<li>{{$data->total}} $</li>
										<hr>
										@if($data->status == 2)
										<span class='badge badge-success h3'>{{trans('admin.active')}}</span>
										@elseif($data->status == 1)
										<span class='badge badge-danger h3'>{{trans('admin.disactive')}}</span>
										@endif
										<li>{{$data->addBy}}</li>
										<li>{{$data->note}}</li>
											
											
										</ul>
									</div>
									<button class='ptint btn btn-info'>printing <i class='fas fa-file d-print-none'></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<script>
	

	$('.ptint').click(function(){
		var printing = $('.card').html() ;
		var page 	 =  document.body.innerHTML

		document.body.innerHTML = printing ;
		window.print();
		document.body.innerHTML = page ;
		location.reload();
	});
</script>
@endsection