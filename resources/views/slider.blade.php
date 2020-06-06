@extends('layout')

@section('title',"View Slider")

@section('content')
 <?php
     $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$s['img'];
	 
	 $subtitle = $s['subtitle'];
	 $title = $s['title'];
	 $cta_1 = explode(",",$s['cta_1']);
	 $cta_2 = explode(",",$s['cta_2']);
	 $type = $s['type'];
	 $copy = $s['copy'];
 ?>
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-avatar">
            <div class="tm-bg-primary-dark tm-block tm-block-avatar">
              <h2 class="tm-block-title">Image</h2>
              <div class="tm-avatar-container">
                <img
                  src="{{$imgg}}"
                  alt="Slider image"
                  class="tm-avatar img-fluid mb-4"
                />
                <a href="#" class="tm-avatar-delete-link">
                  <i class="far fa-eye tm-product-delete-icon"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Edit Slider</h2>
              <form action="{{url('slider')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
                 <input type="hidden" name="xf" value="{{$s['id']}}">
				<div class="form-group col-lg-6">
                  <label for="phone">Subtitle</label>
                  <input
                    id="phone"
					name="subtitle"
                    type="text"
					value="{{$subtitle}}"
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
					value="{{$title}}"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Call to action text e.g SHOP NOW</label>
                  <input
                    id="phone"
					name="cta-1-text"
                    type="text"
					value="{{$cta_1[0]}}"
					required
                    class="form-control validate"
                  />
                </div><div class="form-group col-lg-6">
                  <label for="phone">Call to action URL e.g http://www.kloudtransact.com/deals OR http://website.com</label>
                  <input
                    id="phone"
					name="cta-1-url"
                    type="text"
					value="{{$cta_1[1]}}"
					required
                    class="form-control validate"
                  />
                </div>
                <div class="form-group col-lg-6">
                  <label for="phone">(OPTIONAL)  Call to action 2 text e.g SHOP NOW</label>
                  <input
                    id="phone"
					name="cta-2-text"
                    type="text"
					value="{{$cta_2[0]}}"
                    class="form-control validate"
                  />
                </div><div class="form-group col-lg-6">
                  <label for="phone">(OPTIONAL) Call to action 2 URL e.g http://www.kloudtransact.com/deals OR http://website.com</label>
                  <input
                    id="phone"
					name="cta-2-url"
                    type="text"
					value="{{$cta_2[1]}}"
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">(OPTIONAL) Offer card</label>
                  <div class="kojo-control"></div>
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
				     $options = ['random' => "Displays randomly",'first' => "Displays first when home page loads",'last' => "Displays last when home page loads"];
				  ?>
				  <option value="none">Where do you want the ads to be displayed?</option>
				  @foreach($options as $key => $value)
				  <?php
				    $ss = $key == $type ? "selected='selected'" : "";
				  ?>
				  <option value="{{$key}}" {{$ss}}>{{$value}}</option>
				  @endforeach
                  </select>
                </div>
				
				<div class="form-group col-lg-12">
                  <label for="phone">Copy</label>
                  <textarea
                    id="phone"
					name="copy"
					required
                    class="form-control validate"
                  >
				   {!! $copy !!}
				  </textarea>
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