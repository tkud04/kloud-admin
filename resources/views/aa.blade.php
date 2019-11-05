@extends('layout')

@section('title',"Ads")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">View, edit or remove ads on KloudTransact webasite</h2>
						<a href="{{url('ad-new')}}" class="btn btn-primary btn-block text-uppercase">Add new ad</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">BACKGROUND</th>
                                    <th scope="col">SUBTITLE</th>                                   
                                    <th scope="col">TITLE</th>                                    
                                    <th scope="col">CTA TEXT</th>                                    
                                    <th scope="col">CTA URL</th>                                    
                                    <th scope="col">TYPE</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($ads != null && count($ads) > 0)
                              @foreach($ads as $a)
				         <?php
                         $ird = $a['img'];

                                      if(count($ird) < 1 || $ird == "none") { $imgg = "img/no-image.png"; }
                                      else{                                      	
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;                                        
										}
										
										$cta = explode(',',$a['cta']);
										$ctaText = $cta[0]; $ctaUrl = $cta[1];
										
										 $options = ['home' => "Displays on home page ONLY",'footer' => "Displays on footer page ONLY",'all' => "Displays everywhere"];
									  
                          $deleteURL = url("delete-ad")."?xf=".$a['id'];
                         ?>
                                <tr>
                                    
                                    <td><img src="{{$imgg}}" width="229" height="51" alt="{{$a['title']}}"></td>
                                    <td><b> {{$a['subtitle']}}</b></td>
                                    <td><b>{{$a['title']}}</b></td>
                                    <td><b>{{$ctaText}}</b></td>
                                    <td><a href="{{$ctaUrl}}" target="_blank">{{$ctaUrl}}</b></td>
                                    <td><b>{{$options[$a['type']]}}</b></td>
                                    <td>
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