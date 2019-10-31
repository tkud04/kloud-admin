@extends('layout')

@section('title',"View Comment")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">View or edit information about this comment.</h2>
               <a href="#" class="btn btn-primary btn-block text-uppercase">Delete comment</a><br>
              <form action="{{url('comment')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
                 <input type="hidden" name="xf" value="{{$comment['id']}}">
				 
				<div class="form-group col-lg-6">
                  <label for="phone">Deal</label>
                  <a class="form-control" href="#">{{$comment['deal']}}</a>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Comment</label>
                  <textarea class="form-control validate" name='comment' required>{{$comment['comment']}}</textarea>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">User</label>
                  <a class="form-control" href="#">{{$comment['user']}}</a>
                </div>			
				<div class="form-group col-lg-6">
                  <label for="phone">Status</label>
                 <select
                    id="phone"
                    name="status"
                    class="form-control validate"
					>
					<?php
                                $ar = ['pending' => "Pending",'active' => "Approved",'disabled' => "Disabled"];
                              ?>
                          	<option value="none">Select status</option>
                              <?php
                                foreach($ar as $key => $value){ 
                                	$snm = ($comment['status'] == $key) ? "selected='selected'" : "";
                               ?>
                              <option value="{{$key}}" {{$snm}}>{{$value}}</option>
                              <?php
                                }
                               ?>
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