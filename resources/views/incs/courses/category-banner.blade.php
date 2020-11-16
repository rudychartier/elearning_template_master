<div class="bd-title text-center">
    <div class="bd-tag-share">
        <div class="tag d-flex justify-content-around">

            @foreach (\App\Category::all() as $category)
                <a class="primary-btn" href="{{route('courses.filter', $category->id)}}">{!!$category->icon!!}{{$category->name}}</a>
            @endforeach

        </div>
    </div>
</div>