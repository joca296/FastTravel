<div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0; $i<$slider->count();$i++)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i==0){{"class='active'"}}@endif></li>
        @endfor
    </ol>
    <div class="carousel-inner">
        @foreach($slider as $slide)
            <div class="carousel-item @if($loop->first){{"active"}}@endif">
                <img class="d-block w-100" src="{{url('/').$slide->picture->src}}" alt="{{$slide->picture->alt}}">
                <div class="carousel-caption d-block">
                    <h4><span>{{$slide->caption}}</span></h4>
                    <p><span>{{$slide->subCaption}}</span></p>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
