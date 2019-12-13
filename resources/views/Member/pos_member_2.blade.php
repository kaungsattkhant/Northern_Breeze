@extends('Layouts.master')
@section('content')


    <div class="container-nb-mount">
        <div>
            <table class="table bg-white border-bottom-radius-mount mb-4">
                <thead>
                <tr>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 pl-4" >Name</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-center">Member Role</th>
                    <th scope="col" class="border-bottom-0 border-top-0 fontsize-mount6 text-right pr-5">Point</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row" class="table-row-m fontsize-mount2 border-top-0 pl-4 text-color-mount">Khant</td>
                    <td class="table-row-m fontsize-mount2 border-top-0 text-center text-color-mount">Diamond</td>
                    <td class="table-row-m fontsize-mount2 border-top-0 text-right pr-5 text-color-mount">10000</td>

                </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-between  top-box-mount shadow-sm border-top-radius-mount">
                <div class="my-auto fs-select2">

                    <select class="selectpicker show-menu-arrow pl-4" name="Branches" data-style="btn-white" data-width="auto">
                        <option selected disabled>လဲလှယ်မည့်ငွေ</option>
                        <option>11111</option>
                        <option>22222</option>
                    </select>

                    <select class="selectpicker show-menu-arrow pl-4" name="Branches" data-style="btn-white" data-width="auto">
                        <option selected disabled>ပြန်လည်ထုတ် ပေးမည့်ငွေ</option>
                        <option>1111</option>
                        <option>22222</option>
                    </select>
                </div>
                <button type="button" class="btn btn-nb-mount-save fontsize-mount"  data-toggle="modal" data-target="#save">သိမ်းမည်</button>
            </div>
        </div>
        <div class="row ">
            <div class="col">
                <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2 w-25 ">လဲလှယ်မည့်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">
                    <tbody class="rounded-table-mount">

                    <tr style="height: 70px">
                        <td class="text-nb-mount border-top-0 pl-4 padding-top-mount fontsize-mount2 pt-4">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2 ">5000 kyats</td>
                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်" style="">

                        </td>
                    </tr>
                    <tr style="height: 70px">

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>

                    <tr >
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-left border-top-0">

                            <p class="total-text-mount pl-5 ">Total :</p>
                            <p class="total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ :</p>
                        </td>
                    </tr>

                    </tbody>

                </table>
            </div>
            <div class="col">
                <p class="border-top-radius-mount text-nb-mount mt-3 pl-3 fontsize-mount4 bg-white mb-0 pt-1 pb-2" style="width: 27%">ပြန်လည်ပေးအပ်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount border-tab-radius-mount">
                    <tbody class="rounded-table-mount">

                    <tr style="height: 70px">
                        <td class="text-nb-mount border-top-0 pl-4 padding-top-mount fontsize-mount2 pt-4">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2 ">5000 kyats</td>
                        <td class="text-right border-top-0 pt-4  padding-top-mount fs-select4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်" style="">

                        </td>
                    </tr>
                    <tr style="height: 70px">

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>
                    <tr style="height: 70px">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0 pt-4 fs-select4 padding-top-mount">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" placeholder="ရွက်">

                        </td>
                    </tr>

                    <tr >
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-left border-top-0">

                            <p class="total-text-mount pl-5 ">Total :</p>
                            <p class="total-text-mount fontsize-mount3 pl-5">ပြန်အမ်းငွေ :</p>
                        </td>
                    </tr>

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @include('Member.save')
    <script>
        $(function(){
            $("#pos .img-pos").addClass("active-pos");

            $("#pos").addClass("active2");
            $("#pos .img-pos").removeClass("img-pos");
        });
    </script>


@endsection
