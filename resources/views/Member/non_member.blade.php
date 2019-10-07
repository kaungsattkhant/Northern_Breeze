@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div class="my-auto btnzz">
                <button type="button" class="btn mr-5 dropdown-toggle fontsize-mount pl-4 text-color-mount" data-toggle="dropdown">
                    လဲလှည်မည့်ငွေ &nbsp;<i class="fas fa-chevron-down text-color-mount2"></i></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">One</a>
                    <a class="dropdown-item" href="#">Two</a>
                    <a class="dropdown-item" href="#">Three</a>

                </div>

                <button type="button" class="btn btn-dropdown-mount dropdown-toggle fontsize-mount text-color-mount" data-toggle="dropdown">ပြန်လည်ထုတ် ပေးမည့်ငွေ &nbsp;<i class="fas fa-chevron-down text-color-mount2"></i></button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">One</a>
                    <a class="dropdown-item" href="#">Two</a>
                    <a class="dropdown-item" href="#">Three</a>

                </div>
            </div>
            <button type="button" class="btn btn-nb-mount-save fontsize-mount"  data-toggle="modal" data-target="#save">သိမ်းမည်</button>
        </div>
        <div class="row pt-3">
            <div class="col">
                <p class=" text-nb-mount row-col-p fontsize-mount4 mb-2 ml-1">လဲလှည်မည့်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount rounded-table-mount ">

                    <tbody class="rounded-table-mount">

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" >
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr class="border-0">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount"></td>
                        <td class="text-right border-top-0">

                            <label for="#input1" class="text-secondary">&nbsp;</label>
                        </td>
                    </tr>
                    </tbody>
                    <p class="sr-p-mount2">Total :</p>
                </table>

            </div>
            <div class="col">
                <p class="row-col-p2 text-nb-mount fontsize-mount4 mb-2 ml-1">ပြန်လှည်ပေးအပ်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount rounded-table-mount">
                    <tbody class="rounded-table-mount">

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr class="border-0">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;ရွက်</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount"></td>
                        <td class="text-right border-top-0">
                            <label for="#input1" class="text-color-mount">&nbsp;</label>
                        </td>
                    </tr>
                    </tbody>
                    <p class="sr-p-mount2">Total :</p>
                </table>
            </div>
        </div>
    </div>

    </div>

    <!-- save modal -->
    <div class="modal fade" id="save" tabindex="-1" role="dialog" aria-labelledby="save" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="width: 350px;">
            <div class="modal-content">

                <div class="modal-body mx-3">
                    <h5 class="mount-modal-title2 mb-3 text-dark" id="exampleModalLongTitle">Save?</h5>
                    <button type="button" class="close x-button-mount" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p style="font-size: 15px;">Do you want to Save ?
                        You can edit this later.</p>

                    <div class="m-button">
                        <button type="button" class="btn  text-primary " data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn  text-primary px-0">save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("myDIV");
        var btns = header.getElementsByClassName("sidebar-box-mount");
        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }
    </script>
    @endsection
