@extends('layouts.app')

@section('title', $plan->title)
@section('nav-title', $plan->title)

@section('content')
@include('layouts.public-nav')
<div class="container">
    <div class="mx-auto" style="max-width: 600px;">
        @foreach($plan->planElements as $planElement)
        {{-- ในใใใ --}}
        @if($planElement->type == 1)
        <div class="p-2">
            <div class="card rounded-3 border-0 p-0 bg-light">
                <div class="ratio ratio-16x9">
                    <img @if($planElement->spot->thumbnail_url) src="{{ $planElement->spot->thumbnail_url }}" @else src="https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg" @endif alt="{{$plan->title}}" style="object-fit: cover; border-radius: 0.3rem 0.3rem 0px 0px;">
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-{{$planElement->id}}">
                        <div class="accordion-item"></div>
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$planElement->id}}" aria-expanded="false" aria-controls="collapse-{{$planElement->id}}">
                                    <div class="text-truncate d-flex flex-column">
                                        <div class="d-flex justify-content-start">{{ $planElement->start_date_time->format('G:i') }} ~ {{ $planElement->end_date_time->format('G:i') }}</div>
                                        <div class="d-flex justify-content-start fw-bold">{{ $planElement->spot->name }}</div>
                                    </div>
                                </button>
                            </div>
                            @if($planElement->memo)
                            <div id="collapse-{{$planElement->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{$planElement->id}}">
                                <div class="accordion-body">
                                    {{ $planElement->memo }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- ็งปๅ --}}
        @elseif($planElement->type == 2)
        <div class="p-2">
            <div class="card rounded-3 border-0 p-0 bg-light">
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-{{$planElement->id}}">
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$planElement->id}}" aria-expanded="false" aria-controls="collapse-{{$planElement->id}}">
                                    <div class="w-100 text-center">
                                        @if($planElement->transportation->name == "่ป")
                                        <i class="fas fa-car"></i>
                                        @elseif($planElement->transportation->name == "ๅพๆญฉ")
                                        <i class="fas fa-walking"></i>
                                        @elseif($planElement->transportation->name == "้ป่ป")
                                        <i class="fas fa-subway"></i>
                                        @elseif($planElement->transportation->name == "่น")
                                        <i class="fas fa-ship"></i>
                                        @elseif($planElement->transportation->name == "่ช่ปข่ป")
                                        <i class="fas fa-bicycle"></i>
                                        @elseif($planElement->transportation->name == "ๆฐๅนน็ท")
                                        <i class="fas fa-train"></i>
                                        @else
                                        <i class="fas fa-bus-alt"></i>
                                        @endif
                                        <span class="ms-1">{{ $planElement->duration_min }}min</span>
                                    </div>
                                </button>
                            </div>
                            @if($planElement->memo)
                            <div id="collapse-{{$planElement->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{$planElement->id}}">
                                <div class="accordion-body">
                                    {{ $planElement->memo }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection