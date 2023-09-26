
@extends('layouts.Inventory')
@section('title')
 inventory dashboard
  @endsection

 @section('head1') Inventory Dashboard @endsection 
  
@section('contents')
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row">
					<div class="col-xl-12">
						<div class="row">
							<div class="col-xl-6">
								<div class="row">
									<div class="col-xl-12">
										<div class="card tryal-gradient">
											<div class="card-body tryal row">
												<div class="col-xl-7 col-sm-6">
													<h2 style="font-size:26px;">Main Dashboard</h2>
													<span> Where Food is an Adventure, and Every Meal a Journey. </span>
													 
												</div>
												<div class="col-xl-5 col-sm-6">
													<!-- <img src="{{asset('/admin/images/logo.png')}}" alt="" class="sd-shape"> -->
													<a href="/administrator/dashboard" class="btn btn-rounded  fs-18 font-w500">Visit Now</a>
												</div>
											</div>
										</div>
									</div>
									

									

								</div>
								
							</div>
							<div class="col-xl-6">
								<div class="row">
									<div class="col-xl-12">
										<div class="row">
											
											<div class="col-xl-6 col-sm-6" style="cursor:pointer;" onclick="window.location.href='/administrator/active-students'">
												<div class="card">
													<div class="card-body d-flex px-4  justify-content-between">
														<div>
															<div class="">
																<h2 class="fs-32 font-w700">0</h2>
																<span class="fs-18 font-w500 d-block">Active Staffs</span>
																
															</div>
														</div>
														<div id="NewCustomers"><i class="fa fa-users" style="font-size:45px;"></i></div>
													</div>
												</div>
											</div>

											<div class="col-xl-6 col-sm-6" style="cursor:pointer;" onclick="window.location.href='/administrator/expired-students'">
												<div class="card">
													<div class="card-body d-flex px-4  justify-content-between">
														<div>
															<div class="">
																<h2 class="fs-32 font-w700">0</h2>
																<span class="fs-18 font-w500 d-block">Items</span>
																
															</div>
														</div>
														<div id="NewCustomers"><i class="fa fa-bars" style="font-size:45px;"></i></div>
													</div>
												</div>
											</div>
											
											
											<div class="col-xl-6 col-sm-6" style="cursor:pointer;" onclick="window.location.href='/administrator/installment-pending'">
												<div class="card">
													<div class="card-body d-flex px-4  justify-content-between">
														<div>
															<div class="">
																<h2 class="fs-32 font-w700">0</h2>
																<span class="fs-18 font-w500 d-block">Bill Reports</span>
																
															</div>
														</div>
														<div id="NewCustomers"><i class="fa fa-file" style="font-size:45px;"></i></div>
													</div>
												</div>
											</div>
											<div class="col-xl-6 col-sm-6" style="cursor:pointer;" onclick="window.location.href='/administrator/pending-refund-requests'">
												<div class="card">
													<div class="card-body d-flex px-4  justify-content-between">
														<div>
															<div class="">
																<h2 class="fs-32 font-w700">0</h2>
																<span class="fs-18 font-w500 d-block">Bookings</span>
																
															</div>
														</div>
														<div id="NewCustomers1"><i class="fa fa-book" style="font-size:45px;"></i></div>
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
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

	@endsection
		
		