<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master List of Documents</title>
    <link rel="stylesheet" href="{{url('docs.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style> .font-custom{font-size: 12px;} </style>
</head>
<body>
<div class="container">
    <div class="col-12 font-style mt-2">
        <div class="row custom-border">
            <div class="col-2 text-center custom-border-right">
                <img src="{{url('/img/AIMS.png')}}" width="150" class="img-fluid p-1">
            </div>
            <div class="col-7  my-auto py-auto">
                <h3 class="text-center" style="margin-top: 10px">
                    MASTER LIST OF DOCUMENTS
                </h3>
            </div>
            <div class="col-3 row custom-border-left font-9 p-0">
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
        <div class="row">
            <table class="table table-stripped mt-4 table-sm table-bordered font-custom">
                    <tr>
                        <th class="text-center" width="10">Sr.</th>
                        <th class="text-center" width="10">Document Description</th>
                        <th class="text-center" width="10">Document No.</th>
                        <th class="text-center" width="10">Rev. No. / Issue No.</th>
                        <th class="text-center" width="10">Issued on</th>
                        <th class="text-center" width="10">Location of Filled Formats</th>
                        <th class="text-center" width="10">Reviewed on</th>
                        <th class="text-center" width="10">Next Review</th>
                        <th class="text-center" width="10">Reviewed by</th>
                        <th class="text-center" width="10">Status</th>
                        <th class="text-center" width="10">Mode of Storage</th>
                    </tr>
                    @foreach($documents as $key=>$document)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$document->name}}</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->doc_no}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->rev_no}} / {{$item->issue_no}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->issue}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->location}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{date('d-m-Y',strtotime($item->reviewed_on))}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{date('d-m-Y',strtotime($item->reviewed_on)+(60*60*24*365))}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->reviewedby->designations->name}} @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) @if($item->status==1) Active @endif @endif @endforeach</td>
                            <td> @foreach($document->child as $key=>$item) @if(count($document->child)==$key+1) {{$item->mode_of_storage}} @endif @endforeach</td>

                        </tr>
                    @endforeach

                </table>
        </div>
    </div>

</div>
</body>
</html>