@extends('layout')

@section('title',"View Deal")

@section('content')

        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title">Images</h2>
              <div class="tm-avatar-container">
                <img
                  src="img/lgg.png"
                  alt="{{$deal['name']}}"
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
              <h2 class="tm-block-title">Account Settings</h2>
              <form action="{{url('config')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}

                <div class="form-group col-lg-6">
                  <label for="phone">Name</label>
                  <input
                    id="phone"
                    name="name"
					value="{{$deal['name']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">SKU</label>
                  <input
                    id="phone"
                    name="sku"
					value="{{$deal['sku']}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
                <div class="form-group col-lg-12">
                  <label for="phone">Description</label>
                 <textarea class="form-control validate" name='description' required>{{$deal['data']['description']}}</textarea>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Amount (&#8358;)</label>
                  <input
                    id="phone"
                    name="amount"
					value="{{$deal['data']['amount']}}"
                    type="number"
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Category</label>
                  <select
                    id="phone"
                    name="category"
                    class="form-control validate"
					>
					<option value="none">Select category</option>
					   @foreach($c as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Category</label>
                  <select
                    id="phone"
                    name="category"
                    class="form-control validate"
					>
					<option value="none">Select category</option>
					   @foreach($c as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Category</label>
                  <select
                    id="phone"
                    name="category"
                    class="form-control validate"
					>
					<option value="none">Select category</option>
					   @foreach($c as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Category</label>
                  <select
                    id="phone"
                    name="category"
                    class="form-control validate"
					>
					<option value="none">Select category</option>
					   @foreach($c as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
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