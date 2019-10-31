@extends('layout')

@section('title',"View Store")

@section('kojo')
 <script>
    addEditor($(".kojo-control"),"estore","description");
	$('#estore').html(`{!!$store['description']!!}`);
	$('#description').val(`{!!$store['description']!!}`);
  </script>
@stop

@section('content')
<?php 
$ct = (isset($category) && $category != null) ? " - ".$category : ""; 
$deals = (isset($store["deals"])) ? $store["deals"] : [];

$ird = $store['img'];

if(count($ird) < 1 || $ird == "none") { $imgg = "img/no-image.png"; }
else{                                      	
    $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;                                        
}
?>
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title">Images</h2>
              <div class="tm-avatar-container">
                <img
                  src="{{$imgg}}"
                  alt="{{$store['name']}}"
                  class="tm-avatar img-fluid mb-4"
                />
                <a href="#" class="tm-avatar-delete-link">
                  <i class="far fa-trash-alt tm-product-delete-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">View/Edit Store</h2>
              <form action="{{url('store')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
                  <input type="hidden" name="ird" id="ird" value="{{$store['img']}}" required>
                     <input type="hidden" name="dri" id="dri" value="{{$store['id']}}" required>
                     <input type="hidden" name="description" id="description" value="" required>
                <div class="form-group col-lg-6">
                  <label for="phone">Name</label>
                  <input
                    id="phone"
                    name="name"
					value="{{$store['name']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Status</label>
                  <select
                    id="phone"
                    name="status"
                    class="form-control validate"
					>
					<option value="none">Select status</option>
					    <?php $op = ['approved' => "Verified",'pending' => "Pending",'disabled' => "Disabled"]; ?>
                              @foreach($op as $key => $value)
                              <?php $ss = ($store['status'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
                </div>
                <div class="form-group col-lg-12">
                  <label for="phone">Description</label>
                  <div class="kojo-control"></div>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Kloud URL</label>
                  <input
                    id="phone"
                    name="flink"
					value="{{$store['flink']}}"
                    type="text"
                    class="form-control validate"
                  />
                </div>
				
				<div class="form-group col-lg-6">
                  <label for="phone">Rating</label>
                 <span class="form-control">
                          	<?php for($u = 0; $u < $store['rating']; $u++){ ?>
                            	<i class="far fa-star text-primary"></i>
                              <?php } ?>
                          </span>
                </div>
				
				<div class="form-group col-lg-12">
                  <label for="phone">Pickup address (Full Address, City, State)</label>
                  <input
                    id="phone"
                    name="pickup_address"
					value="{{$store['pickup_address']}}"
                    type="text"
                    class="form-control validate"
                  />
                </div>
				
                <div class="form-group col-lg-12">
                  <button
                    type="submit"
                    class="btn btn-primary btn-block text-uppercase"
                  >
                   Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
@stop