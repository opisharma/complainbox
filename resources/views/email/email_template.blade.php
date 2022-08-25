<p>Dear sir!, This is {{ $data['name'] }} </p>
<p>{!!  $data['message'] !!} </p>
@if($data['is_approved'] == 0)
    <div class="btn-toolbar form-group mb-0">
        <div class="">
            <a href="{{ route('email.approve', $data['mailId'])}}" method="GET" class="btn btn-primary waves-effect waves-light mb-0" type="submit"><span>Approve</span></a>
        </div>
    </div>
@endif