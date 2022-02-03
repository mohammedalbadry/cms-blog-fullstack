<footer>
    <div class="bg2 p-t-40 p-b-25">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <a href="{{url('/')}}" style="height: 33%">
                            <img style="max-height: 100%" class="max-s-full" src="{{$setting->logo_path}}" alt="{{$setting->name}}">
                        </a>
                    </div>

                    <div>
                        <p class="f1-s-1 cl11 p-b-16">
                            {{$setting->description}}
                        </p>

                        <p class="f1-s-1 cl11 p-b-16">
                            Any questions? Call us on (+1) 96 716 6879
                        </p>

                        <div class="p-t-15">
                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-facebook-f"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-twitter"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-pinterest-p"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-vimeo-v"></span>
                            </a>

                            <a href="#" class="fs-18 cl11 hov-cl10 trans-03 m-r-8">
                                <span class="fab fa-youtube"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <h5 class="f1-m-7 cl0">
                            افضل المقالات
                        </h5>
                    </div>

                    <ul>

                        @foreach($popular_article as $post)
                            <li class="flex-wr-sb-s p-b-20">
                                <a href="{{url('/' . $post->slug)}}" class="size-w-4 wrap-pic-w hov1 trans-03 img-size-footer">
                                    <img data-src="{{$post->image}}" alt="{{$post->title}}">
                                </a>

                                <div class="size-w-5">
                                    <h6 class="p-b-5">
                                        <a href="{{url('/' . $post->slug)}}" class="f1-s-5 cl11 hov-cl10 trans-03">
                                            {{$post->title}}
                                        </a>
                                    </h6>

                                    <span class="f1-s-3 cl6">
                                        {{$post->created_at}}
                                    </span>
                                </div>
                            </li>
                        @endforeach
    
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-4 p-b-20">
                    <div class="size-h-3 flex-s-c">
                        <h5 class="f1-m-7 cl0">
                            الارشيف
                        </h5>
                    </div>

                    <ul class="m-t--12">
                        @foreach($archives as $item)
                            <li class="how-bor1 p-rl-5 p-tb-10">
                                <a href="{{url('?month='  . $item->month.'&year='.$item->year)}}" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                    {{'(' . $item->count . ')' . " - " . MonthNameAR($item->month)  . " - "  . $item->year}}
                                </a>
                            </li>
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="bg11">
        <div class="container size-h-4 flex-c-c p-tb-15">
            <span class="f1-s-1 cl0 txt-center">

                <a href="{{url('/policy')}}" class="f1-s-1 cl10 hov-link1">سياسة الخصوصية.</a>

            </span>
        </div>
    </div>
</footer>