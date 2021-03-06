<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<body>

<div class="container">

    <div class="col-12 font-style mt-2">
        <div class="row">
            <div class="col-2 text-center">
                <img src="{{url('/img/aims.png')}}" class="mt-2 ml-2" width="100">
            </div>
            <div class="col-10 custom-bottom-border text-right p-0">
                <p class="font-14 b">INVOICE</p>
                <p class="font-11">NTN & GST # 74328913 3-0</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-4">
                <p>Date of Issue <span class="custom-bottom-border " style="padding-left: 60%"></span></p>
            </div>
            <div class="col-4">
            </div>
            <div class="col-4 text-right">
                <p>Invoice # <span class="custom-bottom-border " style="padding-left: 60%"></span></p>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Bill / Invoice to: <br>(Company Name)
                        </th>
                        <td>Wimits Pharmaceuticals (Pvt.) Ltd.</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>129 Sundar Industrial Estate, Lahore.</td>
                    </tr>
                    <tr>
                        <th>Contact Person</th>
                        <td>Shamsuddin</td>
                    </tr>
                    <tr>
                        <th>Tel / Fax No.:</th>
                        <td>0300 4370626</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>pharmas32@gmail.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Customer Ref. No.:<br>
                            (PO / SO / Quote)
                        </th>
                        <td> PO # Verbal</td>
                    </tr>
                    <tr>
                        <th>AIMS Ref. No.:</th>
                        <td>JN / 20 / 0197</td>
                    </tr>
                    <tr>
                        <th>AIMS Contact:</th>
                        <td>Imtiaz Ahmed</td>
                    </tr>
                    <tr>
                        <th>Tel./ Fax No.:</th>
                        <td>+92 42 37497298</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>info@aimscal.com</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row py-3">
            <div class="col-6 text-right font-10 b">Currency:</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox" checked> PKR	</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> AED</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> USD</div>
        </div>


        <div class="col-12 text-center">
            <p class=" font-14 b mt-3">Items received for calibration</p>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <thead class="text-center">
                <tr>
                    <th>Sr#</th>
                    <th >Description</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody class="text-center">
                <tr>
                    <td class="font-11">1</td>
                    <td class="font-11 text-left">Certification of Dry Oven</td>
                    <td class="font-11">2</td>
                    <td class="font-11">5000</td>
                    <td class="font-11">10000</td>
                </tr>
                <tr>
                    <td class="font-11">2</td>
                    <td class="font-11 text-left">Installation of Instrument Junction Box</td>
                    <td class="font-11">1</td>
                    <td class="font-11">9500</td>
                    <td class="font-11">9500</td>
                </tr>
                <tr>
                    <td class="font-11">3</td>
                    <td class="font-11 text-left">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                </tr>
                <tr>
                    <td class="font-11">4</td>
                    <td class="font-11 text-left">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                </tr>
                <tr>
                    <td class="font-11">5</td>
                    <td class="font-11 text-left">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                </tr>
                <tr>
                    <td class="font-11">6</td>
                    <td class="font-11 text-left">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                    <td class="font-11">-</td>
                </tr>


                <tr>
                    <th class="font-11 text-right" colspan="4">Invoice Total</th>
                    <td class="font-11">19500</td>
                </tr>
                <tr>
                    <th class="font-11 text-right" colspan="4">16% PRA Tax on Services</th>
                    <td class="font-11">3200</td>
                </tr>
                <tr>
                    <th class="font-11 text-right" colspan="4">Invoice Total</th>
                    <td class="font-11">22700</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row py-3">
            <div class="col-6 text-right font-10 b">Payments Terms:</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox" checked> Chq.	</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> Cash</div>
            <div class="col-2 text-right font-10 b"><input type="checkbox"> Credit</div>
        </div>

        <div class="row">
            <div class="col-8">
                <p class="col-12 font-10 b">Note:  Payable after completion of job</p>
                <p class="col-12 font-10 mt-4">Kindly telex or send bank draft of the amount to:</p>
                <p class="col-12 font-10 ">AI-Meezan Industrial Metrology Services, Lahore, Pakistan</p>
                <p class="col-12 font-10 b mt-4">Bank: Meezan Bank,   Sabzazar Branch, Lahore, Pakistan</p>
                <p class="col-12 font-10 b">Account #:  0002560102439271</p>
                <p class="col-12 font-11 mt-4">Swift Code:  
                    <br><small>Kindly email the remittance advice to info@aimscal.com as soon as the money is transferred</small>
            </div>
            <div class="col-4 text-center">
                <div class="col-12 text-left">
                    For AIMS:
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8 pt-5 mt-5 px-5 custom-bottom-border"></div>
                    <div class="col-2"></div>
                </div>
                <div class="col-12 font-11">
                    Accounts Dept. AIMS<br>
                    Address: 22-C, Sabzazar, Lahore, Pakistan<br>
                    Tel.: +92 42 37497298,<br>
                    Email: info@aimscal.com<br>
                    Website: www.aimscal.com
                </div>

            </div>

            </p>
        </div>
    </div>
</div>
</body>
</html>