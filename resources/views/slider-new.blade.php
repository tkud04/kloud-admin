@extends('layout')

@section('title',"Add New Slider")

@section('kojo')
 <script>
    addEditor($(".kojo-control"),"eslider","description");
	//$('#estore').html(`{!!$store['description']!!}`);
	$('#description').val(`<b>Enter offer card text here.</b>`);
  </script>
@stop

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Add a new slider to the KloudTransact website</h2>

              <form action="{{url('slider-new')}}" method="post" enctype="multipart/form-data" class="tm-signup-form row">
			     {{csrf_field()}}
                 <input type="hidden" name="tag" id="description" value="" required>
				<div class="form-group col-lg-12">
                  <label for="phone">Background Image (<b>Recommend dimension: 1720x720</b>)</label>
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
					name="cta-1-text"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div><div class="form-group col-lg-6">
                  <label for="phone">Call to action URL e.g http://www.kloudtransact.com/deals OR http://website.com</label>
                  <input
                    id="phone"
					name="cta-1-url"
                    type="text"
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
					
                    class="form-control validate"
                  />
                </div><div class="form-group col-lg-6">
                  <label for="phone">(OPTIONAL) Call to action 2 URL e.g http://www.kloudtransact.com/deals OR http://website.com</label>
                  <input
                    id="phone"
					name="cta-2-url"
                    type="text"
					
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
				     $options = ['first' => "Displays first when home page loads",'last' => "Displays last when home page loads",'random' => "Displays randomly"];
				  ?>
				  <option value="none">Where do you want the ads to be displayed?</option>
				  @foreach($options as $key => $value)
				  <option value="{{$key}}">{{$value}}</option>
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
                  ></textarea>
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