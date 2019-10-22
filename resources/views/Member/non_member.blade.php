@extends('Layouts.master')
@section('content')

    <div class="container-nb-mount">
        <div class="d-flex justify-content-between top-box-mount shadow-sm">
            <div class="my-auto btnzz">
                <select class="border-0 rounded-0  bg-white text-color-mount fontsize-mount22 pl-4" style="height: 50px;">
                    <option selected disabled>လဲလှယ်မည့်ငွေ</option>
                    <option>11111</option>
                    <option>22222</option>
                </select>

                <select class="border-0 rounded-0  bg-white  text-color-mount fontsize-mount22 pl-4" style="height: 50px;">
                    <option selected disabled>ပြန်လည်ထုတ် ပေးမည့်ငွေ</option>
                    <option>1111</option>
                    <option>22222</option>
                </select>
            </div>
            <button type="button" class="btn btn-nb-mount-save fontsize-mount"  data-toggle="modal" data-target="#save">သိမ်းမည်</button>
        </div>
        <div class="row pt-3">
            <div class="col">
                <p class=" text-nb-mount row-col-p fontsize-mount4 mb-2 ml-1" style="font-family: 'MM3'">လဲလှယ်မည့်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount rounded-table-mount">

                    <tbody class="rounded-table-mount">

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1" >
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr class="border-0">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-right border-top-0">

                            <label for="#input1" class="text-secondary">&nbsp;</label>
                        </td>
                    </tr>

                    </tbody>

                </table>
                <div class="div-p-mount2">
                    <p>Total :</p>
                    <p class="fontsize-mount3">ပြန်အမ်းငွေ :</p>
                </div>
            </div>
            <div class="col">
                <p class="row-col-p2 text-nb-mount fontsize-mount4 mb-2 ml-1">ပြန်လည်ပေးအပ်ငွေ</p>
                <table class="table border-0 bg-white box-shadow-mount rounded-table-mount">
                    <tbody class="rounded-table-mount">

                    <tr>
                        <td class="text-nb-mount border-top-0 pl-4 pt-4 fontsize-mount2">10000 kyats</td>
                        <td class="text-right border-top-0 pt-4">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr class="border-0">
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">5000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>

                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">1000 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">500 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">200 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">100 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">50 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-top-0 text-nb-mount pl-4 fontsize-mount2">10 kyats</td>
                        <td class="text-right border-top-0">
                            <input type="text" class="border rounded-table-mount w-25 text-center fontsize-mount3 pt-1" id="input1">
                            <label for="#input1" class="text-color-mount fontsize-mount3">&nbsp;တန်ဖိုး</label>
                        </td>
                    </tr>
                    <tr >
                        <td class="border-top-0 text-nb-mount" style="padding: 30px;"></td>
                        <td class="text-right border-top-0">
                            <label for="#input1" class="text-color-mount">&nbsp;</label>
                        </td>
                    </tr>
                    </tbody>

                </table>
                <div class="div-p-mount2">
                    <p>Total :</p>
                    <p class="fontsize-mount3">ပြန်အမ်းငွေ :</p>
                </div>
            </div>
        </div>
    </div>

    @include('Member.save')



    @endsection
