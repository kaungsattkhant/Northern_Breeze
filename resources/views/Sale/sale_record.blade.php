@extends('Layouts.master')
@section('content')
    <<div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div  class="my-auto btnzz ml-4">
                <div class="d-inline">
                    <button type="button" class="btn mr-5 dropdown-toggle fontsize-mount6 pl-4 text-color-mount" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Branches&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i></button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">One</a>
                        <a class="dropdown-item" href="#">Two</a>
                        <a class="dropdown-item" href="#">Three</a>
                    </div>
                </div>

                <div class="d-inline">
                    <button type="button" class="btn fontsize-mount6 text-color-mount pl-3 pr-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        In/Out/All&nbsp;<i class="fas fa-chevron-down text-color-mount2 pl-1"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">IN</a>
                        <a class="dropdown-item" href="#">OUT</a>
                        <a class="dropdown-item" href="#">ALL</a>
                    </div>
                </div>
            </div>
            <div class="my-auto mr-5">
                <button type="button" class="btn btn-nb-mount mr-4 px-4 fontsize-mount" data-toggle="modal" data-target="#add">Add</button>
                <button type="button" class="btn btn-nb-mount px-3 fontsize-mount fontsize-mount" data-toggle="modal" data-target="#Transfer">Transfer</button>
            </div>
            <!-- <button type="button" class="btn btn-nb-mount px-4"  data-toggle="modal" data-target="#add"> Add </button> -->
        </div>
        <div class="pt-5">
            <table class="table bg-white box-shadow-mount rounded-table-mount"  id="myTable" >
                <thead>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6" >Currency</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Exchanged</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Amount</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Date & Time</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6">Sale Representative</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Japanese Yen</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">1:30 PM</td>
                    <td class="table-row-m fontsize-mount2">Khant</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">U.S Dollar</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">2:30 PM</td>
                    <td class="table-row-m fontsize-mount2">Will Smith</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">3:30 PM</td>
                    <td class="table-row-m fontsize-mount2">The Rock</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">Thai Baht</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Singapore Sing</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">4:30 PM</td>
                    <td class="table-row-m fontsize-mount2">Van Desel</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">Japanese Yen</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Myanmar Kyats</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">5:30 PM</td>
                    <td class="table-row-m fontsize-mount2">Paul Walker</td>
                </tr>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2">Chinese Yuan</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">Japanese Yuan</td>
                    <td class="table-row-m fontsize-mount2">1000000</td>
                    <td class="table-row-m fontsize-mount2">12:30 PM</td>
                    <td class="table-row-m fontsize-mount2">Simon</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <p class="sr-p-mount">Total Amount Exchange : 100,000,000,00</p>
    @endsection
