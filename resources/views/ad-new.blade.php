@extends('layout')

@section('title',"Add New Add")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Add a new ad to the KloudTransact website</h2>

              <form action="{{url('ad-new')}}" method="post" enctype="multipart/form-data" class="tm-signup-form row">
			     {{csrf_field()}}

				<div class="form-group col-lg-12">
                  <label for="phone">Background Image</label>
                  <input
                    id="phone"
                    name="img"
                    type="file"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Subtitle</label>
                  <input
                    id="phone"
					name="subtitle"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Title</label>
                  <input
                    id="phone"
					name="title"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Call to action text e.g SHOP NOW</label>
                  <input
                    id="phone"
					name="cta-text"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div><div class="form-group col-lg-6">
                  <label for="phone">Call to action URL e.g http://www.kloudtransact.com/deals OR http://website.com</label>
                  <input
                    id="phone"
					name="cta-url"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Tag</label>
                  <input
                    id="phone"
					name="tag"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Display Type</label>
                  <select
                    id="phone"
					name="type"
                    type="text"
					required
                    class="form-control validate"
				  >
				  <?php
				    $options = ['home' => "Display on home page ONLY",'footer' => "Display on footer page ONLY",'all' => "Display everywhere"];
				  ?>
				  <option value="none">Where do you want the ads to be displayed?</option>
				  @foreach($options as $key => $value)
				  <option value="{{$key}}">{{$value}}</option>
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