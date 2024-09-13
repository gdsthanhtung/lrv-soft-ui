@extends('elements.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                    <div>
                    <h5 class="mb-0">All Products</h5>
                    <p class="text-sm mb-0">
                    A lightweight, extendable, dependency-free javascript HTML table plugin.
                    </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                    <div class="ms-auto my-auto">
                    <a href="./new-product.html" class="btn bg-gradient-primary btn-sm mb-0" target="_blank">+&nbsp; New Product</a>
                    <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#import">
                    Import
                    </button>
                    <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog mt-lg-10">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Import CSV</h5>
                    <i class="fas fa-upload ms-3" aria-hidden="true"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <p>You can browse your computer for a file.</p>
                    <input type="text" placeholder="Browse file..." class="form-control mb-3" onfocus="focused(this)" onfocusout="defocused(this)">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="importCheck" checked="">
                    <label class="custom-control-label" for="importCheck">I accept the terms and conditions</label>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary btn-sm">Upload</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm export mb-0 mt-sm-0 mt-1" data-type="csv" type="button" name="button">Export</button>
                    </div>
                    </div>
                    </div>
                    </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">1</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Admin</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">admin@softui.com</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Admin</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">16/06/18</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">2</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-1.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Creator</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">creator@softui.com</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Creator</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">05/05/20</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">3</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-3.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Member</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">member@softui.com</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Member</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/06/20</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">4</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/team-4.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Peterson</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">peterson@softui.com</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Member</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">26/10/17</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">5</p>
                                    </td>
                                    <td>
                                        <div>
                                            <img src="/assets/img/marie.jpg" class="avatar avatar-sm me-3">
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Marie</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">marie@softui.com</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">Creator</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-xs font-weight-bold">23/01/21</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
