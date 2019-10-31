@extends('layout')

@section('title',"Add Coupon")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Add a new coupon to the system</h2>

              <form action="{{url('add-coupon')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}

				<div class="form-group col-lg-6">
                  <label for="phone">Code</label>
                  <input
                    id="phone"
                    name="code"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Discount (%)</label>
                  <input
                    id="phone"
					name="discount"
                    type="number"
					required
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