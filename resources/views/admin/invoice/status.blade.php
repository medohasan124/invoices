@extends('admin.layouts.master')
@section('css')
@endsection
@section('page-header')

@endsection
@section('content')

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
<!-- row opened -->
	<div class="row row-sm">
		<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">SIMPLE TABLE</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								<p class="tx-12 tx-gray-500 mb-2">Example of Valex Simple Table. <a href="">Learn more</a></p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table mg-b-0 text-md-nowrap">
										<thead>
											<tr>
										<th>#</th>
										<th class="border-bottom-0">{{trans('admin.inv_number')}}</th>
										<th class="border-bottom-0">{{trans('admin.status')}}</th>
										<th class="border-bottom-0">{{trans('admin.inv_date')}}</th>
										<th class="border-bottom-0">{{trans('admin.payment_date')}}</th>
										<th class="border-bottom-0">{{trans('admin.vat')}}</th>
										<th class="border-bottom-0">{{trans('admin.rate_vat')}}</th>
										<th class="border-bottom-0">{{trans('admin.my_vat')}}</th>
										<th class="border-bottom-0">{{trans('admin.product')}}</th>
										<th class="border-bottom-0">{{trans('admin.section')}}</th>
										<th class="border-bottom-0">{{trans('admin.addBy')}}</th>
											</tr>
										</thead>
										<tbody>
											

												@foreach($data as $row)
												<tr> 
													<td>{{$row->id}}</td>
													<td>{{$row->invoice_number}}</td>
													<td>
													@if($row->status == 2)
													<span class='badge badge-success h3'>{{trans('admin.active')}}</span>
													@elseif($row->status == 1)
													<span class='badge badge-danger h3'>{{trans('admin.disactive')}}</span>
													@endif
													</td>
													<td>{{$row->invoice_date}}</td>
													<td>{{$row->updated_at}}</td>
													<td>{{$row->vat}}</td>
													<td>{{$row->rate_vat}}</td>
													<td>{{$row->my_vat}}</td>
													 <td>{{App\products::where('id' , $row->product )->first()->name}}</td> 
												 <td>{{App\sections::where('id' , $row->section)->first()->name}}</td> 
													<td>{{$row->addBy}}</td>
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
@section('js')
@endsection