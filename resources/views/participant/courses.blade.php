@extends('layouts.app')

@section('content')

<section class="latest-blog spad">
    <div class="container">
        <h2 class="text-center">Mes cours</h2>
        <div class="jumbotron row">
            <div class="courses">
                @if (count($coursesUser) > 0)
                    @foreach ($coursesUser as $item)
                       
                    
                    <div class="course my-5 row">
                        <div class="col-lg-3">
                            <div class="about-pic">
                                <a href="#">
                                    <img src="/storage/courses/{{ $item->course->user_id}}/{{ $item->course->image }}" alt="Course img">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="about-text pt-0">
                                <h3>{{ $item->course->title }}</h3>
                                <p>{{ $item->course->subtitle }}</p>
                                <p>Par <b>{{ $item->course->user->name}}</b></p>
                                <span class="tag">{{ $item->course->category->name}}</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <a href="{{route('participant.show',$item->course->slug )}}" class="primary-btn">
                                Continuer
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    @else
                        <h5 class="text-center"> Vous n'êtes inscrit à aucun cours !</h5>
                    @endif
            </div>
        </div>
    </div>
</section>

@stop