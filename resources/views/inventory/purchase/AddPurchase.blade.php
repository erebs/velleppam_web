@extends('layouts.Inventory')
@section('title') Purchase @endsection
@section('head1') Add Purchase @endsection
  
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
                                                    <label class="col-lg-2 col-form-label">Category
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="cat" onchange="GetProd(this.value);">
                                                            <option value="">Choose</option>
                                                            @foreach($cat as $c)
                                                            <option value="{{$c->id}}">{{$c->category}}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                 <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Products
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="product" onchange="GetUnit(this.value);">
                                                            <option value="">Choose</option>
                                                           
                                                        </select>
                                                        
                                                    </div>
                                                </div>

                                                 <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Suppliers
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <select class="form-control" id="supplier">
                                                            <option value="">Choose</option>
                                                            @foreach($suppliers as $s)
                                                            <option value="{{$s->id}}">{{$s->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        
                                                    </div>
                                                </div>
                                                 
                                                <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Qty
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
														<input type="number" class="form-control" placeholder="Enter Qty" id="qty">
														
                                                    </div>
                                <label class="col-lg-2 col-form-label" style="font-size:20px;font-weight: bold;" id="unitlb"></label>
                                                        
                                                   
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Amount
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <input type="number" class="form-control" placeholder="Enter amount" id="amount">
                                                        
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Purchase Date
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <input type="date" class="form-control" placeholder="Purchase Date" id="purchasedt">
                                                        
                                                    </div>
                                                </div>

                                                <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Expiry Date
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <input type="date" class="form-control" placeholder="Enter Expiry" id="expiry">
                                                        
                                                    </div>
                                                </div>

                                               
                                    
                                                
                                            </div>

                                            <div class="col-xl-12">

                                                
                                                
                                                
                                                <div class="mb-3 row">
                                                    <label class="col-lg-2 col-form-label">Details
                                                        <span class="text-danger"></span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        
                                                        <textarea class="form-control" id="details" rows="5" cols="5" placeholder="Enter details"></textarea>
                                                        
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

        function GetProd(val)

            {
                 $.post("/administrator/inventory/get-product", {cat_id: val,_token: "{{ csrf_token() }}"}, function(result) {

                  $('#product').html(result);
                });
            } 

             function GetUnit(val)

            {
                 $.post("/administrator/inventory/get-unit", {prod_id: val,_token: "{{ csrf_token() }}"}, function(result) {
                  $("#unitlb").text(result);
                });
            }           

 function Save()
{
    var cat=$('#cat option:selected').val();
    if(cat=='')
    {
        $('#cat').focus();
        $('#cat').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#cat').css({'border':'1px solid #CCC'});
     
    var name=$('input#name').val();
    if(name=='')
    {
        $('#name').focus();
        $('#name').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#name').css({'border':'1px solid #CCC'});


  var unit=$('#unit option:selected').val();
    if(unit=='')
    {
        $('#unit').focus();
        $('#unit').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#unit').css({'border':'1px solid #CCC'});

    var limit=$('input#limit').val();
    if(limit=='')
    {
        $('#limit').focus();
        $('#limit').css({'border':'1px solid red'});
        return false;
    }
    else
  
    $('#limit').css({'border':'1px solid #CCC'});

    var details=$('#details').val();


      $('#ab1').hide();
      $('#ab2').show();
    
          data = new FormData();

    data.append('cat', cat);
   data.append('name', name);
   data.append('unit', unit);
   data.append('limit', limit);
   data.append('details', details);

 data.append('_token', @json(csrf_token()));
 $.ajax({

type:"POST",
url:"/administrator/inventory/product-add",
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
              text: "Product added successfully",
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
              text: "Product already exists",
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