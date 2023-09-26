@extends('layouts.Inventory')
@section('title') Suppliers @endsection
@section('head1') Edit Supplier @endsection
  
@section('contents')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
				
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Add Suppliers</h4>
                            </div> -->
                            <div class="card-body">
                                <div class="form-validation">
                                    <form class="needs-validation" novalidate="">
                                        <div class="row">
                                            <div class="col-xl-12">
                                                 
                                                <div class="mb-3 row">
                                                    <label class="col-lg-1 col-form-label">Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
														<input type="text" class="form-control" placeholder="Enter name" id="name" value="{{$supplier->name}}">
														
                                                    </div>
                                                </div>

                                                 <div class="mb-3 row">
                                                    <label class="col-lg-1 col-form-label">Mobile
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" placeholder="Enter mobile" id="mobile" value="{{$supplier->mobile}}">
                                                        
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-1 col-form-label">Status
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="status">
                                                        
                                                        <option value="Active" @if($supplier->status=='Active') selected @endif>Active</option>
                                                        <option value="Blocked" @if($supplier->status=='Blocked') selected @endif>Blocked</option>    

                                                        </select>
                                                    </div>
                                                </div>

                                               
                                    
                                                
                                            </div>

                                            <div class="col-xl-12">

                                                
                                                
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-1 col-form-label">Details
                                                        <span class="text-danger"></span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        
                                                        <textarea class="form-control"id="details" rows="5" cols="5" placeholder="Enter details">{{$supplier->details}}</textarea>
                                                        
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                               
                                                
                                            </div>

                                        </div>

                                    </form>

                                </div>
                                <div class="mb-3 row">
                                                    <div class="col-lg-8 ms-auto">
                                                            <button type="button" class="btn btn-primary" onclick="Save()" id="ab1">Submit</button>
                  <button type="button" class="btn btn-primary" id="ab2"> <i class="fa fa-spinner fa-spin"></i>   Submit</button>
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

        <script type="text/javascript">

 function Save()
{
     
    var name=$('input#name').val();
    if(name=='')
    {
        $('#name').focus();
        $('#name').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#name').css({'border':'1px solid #CCC'});


    var mobile=$('input#mobile').val();
    if(mobile=='')
    {
        $('#mobile').focus();
        $('#mobile').css({'border':'1px solid red'});
        return false;
    }
  
    $('#mobile').css({'border':'1px solid #CCC'});

    var details=$('#details').val();
    var status=$('#status option:selected').val();


      $('#ab1').hide();
      $('#ab2').show();
    
          data = new FormData();

   data.append('name', name);
   data.append('mobile', mobile);
   data.append('details', details);
   data.append('status', status);
   data.append('sid', '{{$supplier->id}}');

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/administrator/inventory/supplier-edit",
data:data,
dataType:"json",
contentType: false,
//cache: false,
processData: false,

success:function(data)
{
  if(data['success'])
  {
    $('#ab2').hide();
    $('#ab1').show();
            Toastify({
              text: "Supplier updated successfully",
              duration: 1000,
              newWindow: true,
              // close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, #12a00f, #12a00f)",
              },
              callback: function () {
               // alert("sss");
            window.location.href=window.location.href;
              },
            }).showToast();
                            
  }

     else
  {
        $('#ab2').hide();
        $('#ab1').show();
                   Toastify({
              text: "Supplier already exists",
              duration: 3000,
              newWindow: true,
              // close: true,
              gravity: "top", // `top` or `bottom`
              position: "right", // `left`, `center` or `right`
              stopOnFocus: true, // Prevents dismissing of toast on hover
              style: {
                background: "linear-gradient(to right, red, red)",
              },
              callback: function () {
              },
            }).showToast();
  }


}




})



}




</script>


@endsection