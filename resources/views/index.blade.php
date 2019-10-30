@extends('layout')

@section('title',"Dashboard")

@section('content')
<?php
$totalUsers = $adminStats['totalUsers'];
		$totalSales= $adminStats['totalSales'];
		$totalPosts = $adminStats['totalPosts'];
		$totalWithdrawals = $adminStats['totalWithdrawals'];
		$totalDeals = $adminStats['totalDeals'];
		$totalUsersActive = $adminStats['totalUsersActive'];
		$totalOrders = $adminStats['totalOrders'];
		$totalOrdersPending = $adminStats['totalOrdersPending'];
		$totalStores = $adminStats['totalStores'];
		$totalStoreSales = $adminStats['totalStoreSales'];
		$totalAuctions = $adminStats['totalAuctions'];
		$totalLiveAuctions = $adminStats['totalLiveAuctions'];
?>
 <div class="row">
                <div class="col">
                    <p class="text-white mt-5 mb-5">Welcome back, <b>{{$user->fname." ".$user->lname}}</b></p>
                </div>
            </div>
            <!-- row -->
            <div class="row tm-content-row">
			   <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block">
					   <div class="row">
						 <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
						   <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                              <div class="card-icon">
                                <i class="far fa-money"></i>
                              </div>
                              <p class="card-category">Deals</p>
                              <h3 class="card-title">{{$totalDeals}} </h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="far fa-danger text-danger"></i>
                                <a href="{{url('deals')}}">View all deals</a>
                              </div>
                            </div>
                          </div>
						 </div>
						 <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
						   <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                              <div class="card-icon">
                                <i class="far fa-money"></i>
                              </div>
                              <p class="card-category">Orders</p>
                              <h3 class="card-title">{{$totalOrdersPending}}/{{$totalOrders}} <small>PENDING</small></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="far fa-danger text-danger"></i>
                                <a href="{{url('orders')}}">View all orders</a>
                              </div>
                            </div>
                          </div>
						 </div>
						 <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
						   <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                              <div class="card-icon">
                                <i class="far fa-money"></i>
                              </div>
                              <p class="card-category">Users</p>
                              <h3 class="card-title">{{$totalUsersActive}}/{{$totalUsers}} <small>ACTIVE</small></h3>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="far fa-danger text-danger"></i>
                                <a href="{{url('users')}}">View all users</a>
                              </div>
                            </div>
                          </div>
						 </div>
						 <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
						   <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                              <div class="card-icon">
                                <i class="far fa-money"></i>
                              </div>
                              <p class="card-category">Stores</p>
                              <h3 class="card-title">{{$totalStores}}</h3>
							   <p class="card-category"><span class="text-warning"><i class="fa fa-shopping-bag"></i>Total Revenue: &#8358;{{$totalStoreSales}} </span></p>
                            </div>
                            <div class="card-footer">
                              <div class="stats">
                                <i class="far fa-danger text-danger"></i>
                                <a href="{{url('users')}}">View all users</a>
                              </div>
                            </div>
                          </div>
						 </div>
					   </div>
                        
                    </div>
                </div>
			</div>

            <!-- row -->
            <div class="row tm-content-row">
			<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Site Settings</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">PARAMETER</th>
                                    <th scope="col">VALUE</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row"><b>Delivery fee</b></th>
                                    <td><b>&#8358;2000.00</b></td>
                                </tr>
								<tr>
                                    <th scope="row"><b>Withdrawal fee</b></th>
                                    <td><b>&#8358;200.00</b></td>
                                </tr>
								<tr>
                                    <th scope="row"><b>Minimum withdrawal</b></th>
                                    <td><b>&#8358;5000.00</b></td>
                                </tr>
                                                    
                            </tbody>
                        </table>
                    </div>
                </div>
				<div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-overflow">
                        <h2 class="tm-block-title">Notifications</h2>
                        <div class="tm-notification-items">
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Jessica</b> and <b>6 others</b> sent you new <a href="#"
                                            class="tm-notification-link">product updates</a>. Check new orders.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-02.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Oliver Too</b> and <b>6 others</b> sent you existing <a href="#"
                                            class="tm-notification-link">product updates</a>. Read more reports.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-03.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Victoria</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">order updates</a>. Read order information.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Laura Cute</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">product records</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-02.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Samantha</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">order stuffs</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-03.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Sophie</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">product updates</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-01.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Lily A</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">product updates</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-02.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Amara</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">product updates</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                            <div class="media tm-notification-item">
                                <div class="tm-gray-circle"><img src="img/notification-03.jpg" alt="Avatar Image" class="rounded-circle"></div>
                                <div class="media-body">
                                    <p class="mb-2"><b>Cinthela</b> and <b>6 others</b> sent you <a href="#"
                                            class="tm-notification-link">product updates</a>.</p>
                                    <span class="tm-small tm-text-color-secondary">6h ago.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Orders List</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER NO.</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">AMOUNT</th>
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">DATE</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							 @if($adminRecentOrders != null && count($adminRecentOrders) > 0)
                              @foreach($adminRecentOrders as $o)
                                <tr>
                                    <th scope="row"><b>{{$o['number']}}</b></th>
                                    
                                    <td><b>{{$o['email']}}</b></td>
                                    <td><b>&#8358;{{number_format($o['total'],2)}}</b></td>
                                    <td><b>{{$o['status']}} </b></td>
                                    <td>{{$o['date']}} </td>
                                </tr>
                                @endforeach
                              @endif
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
@stop