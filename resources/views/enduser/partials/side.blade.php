 <!-- tag -->
 <div class="p-b-55">
    <div class="how2 how2-cl4 flex-s-c m-b-30">
        <h3 class="f1-m-2 cl3 tab01-title">
            اهم الوسوم
        </h3>
    </div>

    <div class="flex-wr-s-s m-rl--5">
        @foreach($top_tags as $tag)
            <a href="{{url('tag/'. $tag->slug)}}" class="flex-c-c size-h-2 bo-1-rad-20 bocl12 f1-s-1 cl8 hov-btn2 trans-03 p-rl-20 p-tb-5 m-all-5">
                {{$tag->name}}
            </a>
        @endforeach
    </div>	
</div>
 <!-- category -->
<div class="p-b-37">
    <div class="how2 how2-cl4 flex-s-c">
        <h3 class="f1-m-2 cl3 tab01-title">
            اهم الاقسام
        </h3>
    </div>

    <ul class="p-t-32">
        @foreach($top_categories as $category)
            <li class="p-rl-4 p-b-19">
                <a href="{{url('category/'. $category->slug)}}" class="flex-wr-sb-c f1-s-10 text-uppercase cl2 hov-cl10 trans-03">
                    <span>
                        {{$category->name}}
                    </span>

                    <span>
                        ({{$category->posts_count}})
                    </span>
                </a>
            </li>
        @endforeach
    </ul>
</div>