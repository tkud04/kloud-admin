@extends('layout')

@section('title',"Sliders")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">View/remove sliders on KloudTransact webasite</h2>
						<a href="{{url('slider-new')}}" class="btn btn-primary btn-block text-uppercase">Add new slider</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">BACKGROUND</th>
                                    <th scope="col">SUBTITLE</th>                                   
                                    <th scope="col">TITLE</th>                                    
                                    <th scope="col">CTA 1 TEXT</th>                                    
                                    <th scope="col">CTA 1 URL</th>  
									<th scope="col">CTA 2 TEXT</th>                                    
                                    <th scope="col">CTA 2 URL</th>                                    
                                    <th scope="col">COPY</th>                                    
                                    <th scope="col">TYPE</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($sliders != null && count($sliders) > 0)
                              @foreach($sliders as $s)
				         <?php
                         $ird = $s['img'];

                                      if($ird == null || $ird == "none") { $img = "img/no-image.png"; }
                                      else{                                      	
                                      	   $img = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;                                        
										}
										
										$cta_1 = explode(',',$s['cta_1']);
										$cta_2 = explode(',',$s['cta_2']);
										
										 $options = ['first' => "Displays first when home page loads",'last' => "Displays last when home page loads",'random' => "Displays randomly"];
									  
                          $deleteURL = url("delete-slider")."?xf=".$s['id'];
                          $editURL = url("slider")."?xf=".$s['id'];
                         ?>
                                <tr>
                                    
                                    <td><img src="{{$img}}" width="192" height="72" alt="{{$s['title']}}"></td>
                                    <td><b> {{$s['subtitle']}}</b></td>
                                    <td><b>{{$s['title']}}</b></td>
                                    <td><b>{{$cta_1[0]}}</b></td>
                                    <td><a href="{{$cta_1[1]}}" target="_blank">{{$cta_1[1]}}</b></td>
                                    <td><b>{{$cta_2[0]}}</b></td>
                                    <td><a href="{{$cta_2[1]}}" target="_blank">{{$cta_2[1]}}</b></td>
                                    <td><b>{{$s['copy']}}</b></td>
                                    <td><b>{{$options[$s['type']]}}</b></td>
                                    <td>
									<a href="{{$editURL}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>
									<a href="{{$deleteURL}}" class="tm-product-delete-link"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
									</td>
                                </tr>
                                @endforeach
								@endif
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
@stop