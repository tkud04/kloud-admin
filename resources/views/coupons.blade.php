@extends('layout')

@section('title',"Coupons")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">View, edit or remove coupons</h2>
						<a href="{{url('cobra-add-coupon')}}" class="btn btn-primary btn-block text-uppercase">Add new coupon</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">NAME</th>
                                    <th scope="col">PHONE</th>
                                    <th scope="col">EMAIL</th>                                    
                                    <th scope="col">ROLE</th>                                    
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @foreach($users as $u)
                                <tr>
                                    <th scope="row"><b>{{$u['fname']." ".$u['lname']}}</b></th>
                                    
                                    <td><b>{{$u['phone']}}</b></td>
                                    <td><b>{{$u['email']}}</b></td>
                                    <td><b>{{$u['role']}}</b></td>
                                    <td><b>{{$u['status']}} </b></td>
                                    <td>
									<a href="{{url('user').'?email='.$u['email']}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>
									</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
@stop