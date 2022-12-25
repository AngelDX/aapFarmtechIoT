@inject('carbon', 'Carbon\Carbon')
<div class="container" data-aos="fade-up">
    <div class="section-title">
        <h2>Noticias</h2>
        <p>Continuamente publicamos noticias relacionadas al clima, pronosticos, tecnologías para cultivos, etc.</p>
    </div>
    <div class="d-flex m-auto">
        <div class="col">
            <div class="">
                <a onclick="prev()" class="">
                    <i class="fa-solid fa-circle-left fa-2x"></i>
                </a>
            </div>
        </div>
        <div id="sliderContainer" class="col-12 overflow-hidden">
            <ul id="slider" class="row row-cols-1 row-cols-md-4 g-2 list-unstyled" style="transition: margin 1000ms ease-in-out, box-shadow 1000ms ease-in-out;">
            @foreach ($news as $item)
                <li>
                    <div class="col">
                        <div class="card h-100">
                            <img src="@if($item->image){{Storage::url($item->image->url)}}@else assets/img/defaultnews.jpg @endif" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->title}}</h5>
                                <p class="card-text">{{Str::limit($item->body,120)}}</p>
                                <div class="d-flex justify-content-end"><a href="#" class="buy-btn">Ver mas</a></div>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">{{ $carbon::parse($item->created_at)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
        <div class="col">
            <div class="">
                <a onclick="next()" class="">
                    <i class="fa-solid fa-circle-right fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        let sliderContainer=document.getElementById('sliderContainer');
        let slider=document.getElementById('slider');
        let cards=slider.getElementsByTagName('li');

        let elementsToShow=4;
        if(document.body.clientWidth<1000){
            let elementsToShow=1;
        }else if(document.body.clientWidth<1500){
            let elementsToShow=2;
        }
        let sliderContainerWidth=sliderContainer.clientWidth;
        let cardWidth=sliderContainerWidth/elementsToShow;

        slider.style.width=cards.length*cardWidth+'px';
        // slider.style.transition='margin';
        // slider.style.transitionDuration='1s;'

        for(let index=0; index<cards.length; index++){
            const element=cards[index];
            element.style.width=cardWidth+'px';
        }

        function prev(){
            //console.log(+slider.style.marginLeft.slice(0,-2));
            //console.log(cardWidth*(cards.length-elementsToShow));
            if(+slider.style.marginLeft.slice(0,-2) != -cardWidth*(cards.length-elementsToShow))
                slider.style.marginLeft=((+slider.style.marginLeft.slice(0,-2))-cardWidth)+'px';
        }

        function next(){
            //console.log(+slider.style.marginLeft.slice(0,-2));
            //console.log(cardWidth*(cards.length-elementsToShow));
            if(+slider.style.marginLeft.slice(0,-2) != 0)
                slider.style.marginLeft=((+slider.style.marginLeft.slice(0,-2))+cardWidth)+'px';
        }

    </script>
    @endpush
