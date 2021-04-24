@extends('admin.layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')



		<!-- Modal effects -->
		<div class="modal effect-scale " id="modaldemo8">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">{{trans('admin.alert')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<h6>{{trans('admin.alert')}}</h6>
						<p class='select_all_delete'>{{trans('admin.please_select')}}</p>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-danger modal_delete d-none" type="button">{{trans('admin.delete')}}</button>

						<!--start single footer button-->
						<div class='d-none single_modal_delete'>
						{{Form::open(['method' => 'delete' , 'url' => 'admin/invoice/destroy'])}}
						
						{{Form::hidden('id' , null, ['class' => 'single-delete'])}}
						{{Form::submit(trans('admin.delete') , ['class' => ' btn  btn-danger'])}}
						{{Form::close()}}
						</div>
						<!--end single footer button-->

						<button class="btn ripple btn-secondary " data-dismiss="modal" type="button">{{trans('admin.close')}}</button>
					</div>

					

					
				</div>
			</div>
		</div>
		<!-- End Modal effects-->

		<div class="modal effect-scale " id="modaldemo9">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">{{trans('admin.create')}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body" style='background: #dfe1e4'>
						
						<br>
						{{Form::open(['method' => 'PUT' , 'url' => 'admin/invoice'])}}
						
						{{Form::label(trans('admin.inv_number'))}}
						{{Form::text('name' , null, ['class' => 'form-control' ,"autocomplete"=>"off" ,'id' => 'section_name' , 'disabled'])}}
						
						<br>
						{{Form::label(trans('admin.section'))}}

						<select class='form-control' name='status'>
							<option class='d-none'  value=''>{{trans('admin.pleaseSelect')}}</option>
							<option   value='1'>{{trans('admin.waiting')}}</option>
							<option   value='2'>{{trans('admin.payment')}}</option>
							
							
							
						</select>
					</div>

						<div class="modal-footer">

						<button class=" btn  btn-success" style='cursor:pointer'>{{trans('admin.sure')}}</button>
						
						<button class="btn ripple btn-secondary " data-dismiss="modal" type="button">{{trans('admin.close')}}</button>
						{{Form::close()}}
						</div>
						<!--end single footer button-->
					</div>
				</div>
			</div>

				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{trans('admin.products')}}</h4>
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

<!-- row opened -->
	<div class="row row-sm">

					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">

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
		<div class="d-flex justify-content-between">

				<h4 class="card-title mg-b-0">{{trans('admin.sections')}}</h4>
					<i class="mdi mdi-dots-horizontal text-gray"></i>
				</div>
				
			</div>
							<div class="card-body">
								<div class="table-responsive">
										{{Form::open(['id' =>'del' ,'method' => 'delete' , 'url' => 'admin/invoice/destroy'])}}
									<table id="example" class="table key-buttons text-md-nowrap text-center">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												@can('invoice-delete')
												<th class="border-bottom-0">
												{{trans('admin.select_all')}}
												<input type='checkbox' class='deleteAll' value='0'></td>
												
											</th>
											@endcan
												
											<th class="border-bottom-0">{{trans('admin.inv_number')}}</th>
											<th class="border-bottom-0">{{trans('admin.status')}}</th>
											<th class="border-bottom-0">{{trans('admin.inv_date')}}</th>
											<th class="border-bottom-0">{{trans('admin.end_date')}}</th>
											<th class="border-bottom-0">{{trans('admin.product')}}</th>
											<th class="border-bottom-0">{{trans('admin.section')}}</th>
											<th class="border-bottom-0">{{trans('admin.addBy')}}</th>
											@can('invoice-edit')
											 <th class="border-bottom-0">{{trans('admin.control')}}</th>
											@endcan
											
											</tr>
										</thead>
										<tbody>

								


											@foreach($data as $row)
												<tr>
												<td>{{$row->id}}</td>
												@can('invoice-edit')
												<td><input type='checkbox' value='{{$row->id}}' name='del[]' class='check_delete' ></td>
												@endcan
												
												<td>{{$row->invoice_number}}</td>
												<td>
													
													@if($row->status == 2)
													<span class='badge badge-success h3'>{{trans('admin.active')}}</span>
													@elseif($row->status == 1)
													<span class='badge badge-danger h3'>{{trans('admin.disactive')}}</span>
													@endif
												
												</td>
												<td>{{$row->invoice_date}}</td>
												<td>{{$row->due_date}}</td>
												
												 <td>{{App\products::where('id' , $row->product )->first()->name}}</td> 
												 <td>{{App\sections::where('id' , $row->section)->first()->name}}</td> 
												
												<td>{{$row->addBy}}</td>
												
												
												
												
												

												<td>

<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      {{trans('admin.control')}} <i class='fas fa-sort-down'></i>
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

     <a href="{{url('admin/invoice').'/'.$row->id}}" class=' dropdown-item' >{{trans('admin.print')}} <i class='fas fa-file text-warning'></i></a>
     
    	@can('invoice-edit')
     <a href="#" class='edit_section dropdown-item' data-name='{{$row->invoice_number}}' href="#" id='{{$row->id}}' data-target='#modaldemo9' data-toggle="modal">{{trans('admin.edit')}}<i class='fas fa-edit text-primary'></i></a>
      @endcan
      @can('invoice-delete')
	<a data-name='{{$row->invoice_number}}' href="#" id='{{$row->id}}' class=' modal-effect delete_one dropdown-item' data-target='#modaldemo8' data-toggle="modal">{{trans('admin.delete')}}<i class='fas fa-trash text-danger ' data-effect="effect-scale" ></i></a>
	@endcan
    </div>
    </div>
 </div>
												</td>
											</tr>
											@endforeach
									
										</tbody>
									</table>
									{{Form::close()}}
								</div>
							</div>
						</div>
					</div>
					<!--/div-->

					
				</div>
				<!-- /row -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
{{-- <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script> --}}
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
	//file export datatable
	var table = $('#example').DataTable({
		"ordering": false,
		lengthChange: false,
		buttons: [

		@can('invoice-create')
		{extend:'', text:'Create <i class="fas fa-plus"></i>' , className:'btn btn-danger create_button'},
		@endcan
		{extend:'copy', text:'Copy <i class="fas fa-file"></i>' , className:'btn btn-success'},

		{extend:'csv', text:'CSV <i class="fas fa-file"></i>', className:'btn btn-info'},
		{extend:'excel', text:'Excel <i class="fas fa-file"></i>', className:'btn btn-primary'},

		@can('invoice-delete')
		{extend:'', text:'<i class="fas fa-trash"></i>', className:'btn btn-danger deleteAllButton modal-effect'},
		@endcan
		],
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ ',
		}
	});


	table.buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
	// add data to delete button
	$('.deleteAllButton').attr('data-toggle' ,'modal');
	$('.deleteAllButton').attr('data-target' ,'#modaldemo8');
	$('.deleteAllButton').attr('data-effect' ,'effect-scale');

	// add data to delete button
	$('.create_button').attr('data-toggle' ,'modal');
	$('.create_button').attr('data-target' ,'#modaldemo7');
	$('.create_button').attr('data-effect' ,'effect-scale');

	// add data to edit button
	$('.edit_section').attr('data-toggle' ,'modal');
	$('.edit_section').attr('data-target' ,'#modaldemo9');
	$('.edit_section').attr('data-effect' ,'effect-scale');

	$('.create_button').click(function(){
		window.location.href = '{{route('invoice.create')}}'
	});

	
	$('.deleteAll').change(function(){
		 $('table .check_delete').prop('checked' , $(this).prop('checked'));

		 var x    = $('table .check_delete:checked').length ;
	 if(x > 0){
	 	$('.modal p').html('{{trans("admin.last_delete")}}' + x);
	 	$('.modal_delete').removeClass('d-none');
	 }else{
	 	$('.modal p').html('{{trans("admin.please_select")}}');
	 	$('.modal_delete').addClass('d-none');
	 	
	 }

	});



	//if you click to select single checkbox
	$('.check_delete').click(function(){
		$('.single_modal_delete').addClass('d-none');
    var x    = $('table .check_delete:checked').length ;
	 if(x > 0){
	 	$('.modal p').html('{{trans("admin.last_delete")}}' + x);
	 	$('.modal_delete').removeClass('d-none');
	 }else{
	 	$('.modal p').html('{{trans("admin.please_select")}}');
	 	$('.modal_delete').addClass('d-none');
	 	
	 }

	 if(x == $('.check_delete').length){
	 	 $('.deleteAll').prop('checked' , true);
	 }else{
	 	$('.deleteAll').prop('checked' ,false);
	 }
	});



	$('.deleteAllButton').click(function(){

	$('.select_all_delete').html('{{trans('admin.please_select')}}');
		$('.single_modal_delete').addClass('d-none');
		var x    = $('table .check_delete:checked').length ;
		 if(x > 0){
	 	$('.modal p').html('{{trans("admin.last_delete")}}' + x);
	 	$('.modal_delete').removeClass('d-none');
	 }else{
	 	$('.modal p').html('{{trans("admin.please_select")}}');
	 	$('.modal_delete').addClass('d-none');
	 	
	 }
	});

	//single modal delete
	$('.modal_delete').click(function(){
		
		$('#del').submit();
	});

	 $(document).on('click', 'table .delete_one',function(){
	 	$('.modal_delete').addClass('d-none');
	 	$('.single_modal_delete').removeClass('d-none');
	 	var id = $(this).attr('id');
	 	var name = $(this).attr('data-name');
	 	$('.single-delete').val(id);

	 	$('#modaldemo8 p').html('{{trans("admin.sure_delete")}}' + name);
	 	console.log(name);
	 	
	 });
	/*end delete All*/	




	/*start edit section*/

	 $(document).on('click', 'table .edit_section',function(){
	 	var id 			= $(this).attr('id');
		var name 		= $(this).attr('data-name');
		var section 	= $(this).attr('data-discrption');

		$('#modaldemo9 #section_name').val(name);
		//$('#modaldemo9 #section_disc').html(discription);
		$('#modaldemo9 form').attr('action' , '{{url('admin/invoice')}}/'+id );
		$('#modaldemo9 select').val(section);
		console.log(id);
	 	
	 });


</script>
@endsection
@section('js')
@endsection