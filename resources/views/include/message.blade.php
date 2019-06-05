@if(isset($message))
    <div class="col-12">
        <div class="content alert alert-{{$messageType}}" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="alert-heading">{{$messageHeading}}</h4>
            <p>{{$message}}</p>
            @if(isset($showHomeLink))
                <p>
                    Click <a href="{{url('/')}}">here</a> to view the home page.
                </p>
            @endif
        </div>
    </div>
@endif