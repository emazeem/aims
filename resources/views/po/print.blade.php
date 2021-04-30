<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Order</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container">

    <div class="col-12 font-style mt-2">

        <div class="row">
            <div class="col-2 text-center custom-border">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-7 border-left-right-0 custom-border" >
                <p class="text-center b font-24" style="margin-top: 40px">AL-Meezan Industrial Meterology Services</p>
            </div>
            <div class="col-3 row custom-border font-9 p-0">
                <p class="text-center font-11 col-12 my-1">DOC. # AIMS-BM-FRM-04,</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 my-2">Issue Date : 06-10-2020</p>
                <div class="col-12 custom-bottom-border"></div>
                <p class="text-center font-11 col-12 mt-2 mb-1">
                    Issue # 01
                    <span class="px-4"></span>
                    Rev # 02
                </p>
            </div>
        </div>

        <div class="row mt-3">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th colspan="7" class="text-center">PURCHASE ORDER</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font-11 b">Attention to:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Date:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Attention Person:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Our PO#:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Address:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Supplier ref:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Contact No:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Contact No:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Fax No:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Fax No:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Email:</td>
                    <td class="font-11 b"></td>
                    <td class="font-11 b">Email:</td>
                    <td class="font-11 b" colspan="2"></td>
                </tr>
                <tr>
                    <td class="font-11 b py-4" colspan="5">Purchase Details:
                        <p class="ml-3">This is with reference to your offer through Quotation #</p>
                    </td>
                </tr>
                <tr>
                    <td class="font-11 b" >No:</td>
                    <td class="font-11 b" >Description:</td>
                    <td class="font-11 b" >Qty:</td>
                    <td class="font-11 b" >Price():</td>
                    <td class="font-11 b" >Total:</td>
                </tr>
                @foreach($show->po_items as $k=>$item)
                    <tr>
                        <td class="font-11" >{{$k+1}}</td>
                        <td class="font-11" >{{$item->description}}</td>
                        <td class="font-11" >{{$item->qty}}</td>
                        <td class="font-11" >{{$item->price}}</td>
                        <td class="font-11" >{{$item->qty*$item->price}}</td>
                    </tr>

                @endforeach
                <tr>
                    <td class="font-11 b text-right" colspan="4">Total amount in words:</td>
                    <td class="font-11 b" >-</td>
                </tr>
                <tr>
                    <td class="font-11 b" colspan="5">
                        <i>Technical aspects verified by end user:</i>
                    </td>
                </tr>
                <tr>
                    <td class="font-11 b">Term of Payment:</td>
                    <td class="font-11 b" colspan="4"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Delivery Term:</td>
                    <td class="font-11 b" colspan="4"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Currency:</td>
                    <td class="font-11 b" colspan="4"></td>
                </tr>
                <tr>
                    <td class="font-11 b">Note:</td>
                    <td class="font-11 b" colspan="4">You are requested to kindly follow the delivery as per your attached quotation.</td>
                </tr>
                <tr>
                    <td class="font-11 pb-5 b">Prepared By</td>
                    <td class="font-11 pb-5 b" colspan="2">Checked By</td>
                    <td class="font-11 pb-5 b" colspan="2">Approved By</td>
                </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>