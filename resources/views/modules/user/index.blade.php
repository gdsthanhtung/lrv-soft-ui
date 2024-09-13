@extends('elements.auth')
@section('content')
<div>
	<div class="row">
		<div class="col-12">
			<div class="card">
				{{-- <div class="card-header pb-0">
					<div class="d-lg-flex">
						<div>
							<h5 class="mb-0">All Users</h5>
							<p class="text-sm mb-0">
                                Usage, Common examples, Translation, Variants and technical information.
							</p>
						</div>
						<div class="ms-auto my-auto mt-lg-0 mt-4">
							<div class="ms-auto my-auto">
								<a href="./new-product.html" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; New Product</a>
							</div>
						</div>
					</div>
				</div> --}}

                @include($pathViewTemplate . 'page-header',
                [
                    'title' => $pageTitle,
                    'button' => '<a href="'.route($ctrl."/form").'" class="btn bg-gradient-primary btn-sm mb-0"><i class="bi bi-plus-circle"></i> Add New</a>'
                ])

				<div class="card-body px-0 pb-0">
					<div class="table-responsive">
						<div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
							<div class="dataTable-top">
								<div class="dataTable-dropdown">
									<label>
										Show
										<select class="dataTable-selector">
											<option value="5">5</option>
											<option value="10">10</option>
											<option value="15">15</option>
											<option value="20">20</option>
											<option value="25">25</option>
										</select>
										entries
									</label>
								</div>
								<div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text"></div>
							</div>
							<div class="dataTable-container">
								<table class="table table-flush dataTable-table" id="products-list">
									<thead class="thead-light">
										<tr>
											<th data-sortable="" style="width: 35.8716%;"><a href="#" class="dataTable-sorter">Product</a></th>
											<th data-sortable="" style="width: 10.9174%;"><a href="#" class="dataTable-sorter">Category</a></th>
											<th data-sortable="" style="width: 8.44037%;"><a href="#" class="dataTable-sorter">Price</a></th>
											<th data-sortable="" style="width: 11.0092%;"><a href="#" class="dataTable-sorter">SKU</a></th>
											<th data-sortable="" style="width: 9.08257%;"><a href="#" class="dataTable-sorter">Quantity</a></th>
											<th data-sortable="" style="width: 12.7523%;"><a href="#" class="dataTable-sorter">Status</a></th>
											<th data-sortable="" style="width: 12.0183%;"><a href="#" class="dataTable-sorter">Action</a></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck1" checked="">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/adidas-hoodie.jpg" alt="hoodie">
													<h6 class="ms-3 my-auto">BKLGO Full Zip Hoodie</h6>
												</div>
											</td>
											<td class="text-sm">Clothing</td>
											<td class="text-sm">$1,321</td>
											<td class="text-sm">243598234</td>
											<td class="text-sm">0</td>
											<td>
												<span class="badge badge-danger badge-sm">Out of Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck2" checked="">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/macbook-pro.jpg" alt="mac">
													<h6 class="ms-3 my-auto">MacBook Pro</h6>
												</div>
											</td>
											<td class="text-sm">Electronics</td>
											<td class="text-sm">$1,869</td>
											<td class="text-sm">877712</td>
											<td class="text-sm">0</td>
											<td>
												<span class="badge badge-danger badge-sm">Out of Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck3">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/metro-chair.jpg" alt="metro-chair">
													<h6 class="ms-3 my-auto">Metro Bar Stool</h6>
												</div>
											</td>
											<td class="text-sm">Furniture</td>
											<td class="text-sm">$99</td>
											<td class="text-sm">0134729</td>
											<td class="text-sm">978</td>
											<td>
												<span class="badge badge-success badge-sm">in Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck10">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/alchimia-chair.jpg" alt="alchimia">
													<h6 class="ms-3 my-auto">Alchimia Chair</h6>
												</div>
											</td>
											<td class="text-sm">Furniture</td>
											<td class="text-sm">$2,999</td>
											<td class="text-sm">113213</td>
											<td class="text-sm">0</td>
											<td>
												<span class="badge badge-danger badge-sm">Out of Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck5">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/fendi-coat.jpg" alt="fendi">
													<h6 class="ms-3 my-auto">Fendi Gradient Coat</h6>
												</div>
											</td>
											<td class="text-sm">Clothing</td>
											<td class="text-sm">$869</td>
											<td class="text-sm">634729</td>
											<td class="text-sm">725</td>
											<td>
												<span class="badge badge-success badge-sm">in Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck6">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/off-white-jacket.jpg" alt="off_white">
													<h6 class="ms-3 my-auto">Off White Cotton Bomber</h6>
												</div>
											</td>
											<td class="text-sm">Clothing</td>
											<td class="text-sm">$1,869</td>
											<td class="text-sm">634729</td>
											<td class="text-sm">725</td>
											<td>
												<span class="badge badge-success badge-sm">in Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="form-check my-auto">
														<input class="form-check-input" type="checkbox" id="customCheck7" checked="">
													</div>
													<img class="w-10 ms-3" src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/soft-ui-design-system/assets/img/ecommerce/yohji-yamamoto.jpg" alt="yohji">
													<h6 class="ms-3 my-auto">Y-3 Yohji Yamamoto</h6>
												</div>
											</td>
											<td class="text-sm">Shoes</td>
											<td class="text-sm">$869</td>
											<td class="text-sm">634729</td>
											<td class="text-sm">725</td>
											<td>
												<span class="badge badge-success badge-sm">In Stock</span>
											</td>
											<td class="text-sm">
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Preview product">
												<i class="fas fa-eye text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit product">
												<i class="fas fa-user-edit text-secondary" aria-hidden="true"></i>
												</a>
												<a href="javascript:;" data-bs-toggle="tooltip" data-bs-original-title="Delete product">
												<i class="fas fa-trash text-secondary" aria-hidden="true"></i>
												</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="dataTable-bottom">
								<div class="dataTable-info">Showing 1 to 7 of 15 entries</div>
								<nav class="dataTable-pagination">
									<ul class="dataTable-pagination-list">
										<li class="pager"><a href="#" data-page="1">‹</a></li>
										<li class="active"><a href="#" data-page="1">1</a></li>
										<li class=""><a href="#" data-page="2">2</a></li>
										<li class=""><a href="#" data-page="3">3</a></li>
										<li class="pager"><a href="#" data-page="2">›</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
