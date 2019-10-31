@extends('layout')

@section('title',"Fund Wallet")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Add to or remove funds from any KloudPay wallet</h2>

              <form action="{{url('fund-wallet')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}

				<div class="form-group col-lg-4">
                  <label for="phone">Email address/ Phone #</label>
                  <input
                    id="phone"
                    name="xf"
					value="{{$em}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Select action</label>
                 <select
                    id="phone"
                    name="type"
                    class="form-control validate"
					>
					<option value="none"selected="selected">What do you want to do? </option>
                              <option value="add">Add funds to this wallet</option>
                              <option value="remove">Remove funds from this account</option>
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Amount (&#8358;)</label>
                  <input
                    id="phone"
					name="amount"
					value=""
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