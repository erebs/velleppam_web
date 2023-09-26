@extends('layouts.Inventory')
@section('title')
 Products
  @endsection
  @section('head1') Blocked Products @endsection 
@section('contents')



        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">

				
                <div class="row">

                    
					<div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Active Pharmacists</h4>
                            </div> -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Available Qty</th>
                                                <th>StockOut Limit</th>
                                                <th>Action</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($products as $p)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$p->name}}</td>
                                                <td>{{$p->GetCat->category}}</td>
                                                <td>{{$p->available_qty}}{{$p->unit}}</td>
                                                <td>{{$p->stockout_limit}}{{$p->unit}}</td>
                                                

                                                  <td>
                                                    <div class="dropdown ms-auto text-end">
                                                        <div class="btn-link" data-bs-toggle="dropdown" style="float: left;">
                                                            <svg width="24px" height="24px" viewbox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" style="cursor: pointer;" onclick="window.location.href='/administrator/inventory/edit-product/{{encrypt($p->id)}}'">Edit Product</a>
                                                            <a class="dropdown-item" style="cursor: pointer;" onclick="window.location.href='/administrator/inventory/edit-supplier/{{encrypt($p->id)}}'">Purchase Report</a>
                                                             <a class="dropdown-item" style="cursor: pointer;" onclick="">Consumption Report</a>
                                                            
                                                        </div>
                                                    </div>
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
        <!--**********************************
            Content body end
        ***********************************-->

 <script type="text/javascript">

 



   </script>


@endsection