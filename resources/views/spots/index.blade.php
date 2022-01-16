@extends('layouts.header')

@section('content')
<div class="container">
    <div class="accordion my-2" id="accordion-search">
        <div class="accordion-item">
            <div class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-search" aria-expanded="false">
                    <div class="fw-bold text-truncate d-flex align-items-center">
                        絞り込む
                    </div>
                </button>
            </div>
            <div id="collapse-search" class="accordion-collapse collapse" data-bs-parent="#accordion-search">
                <div class="accordion-body">
                    <form action="">
                        <div class="row">
                            <div class="col px-1">
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center" style="width: 40px;">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control" placeholder="検索">
                                </div>
                            </div>
                            <div class="col px-1">
                                <div class="input-group">
                                    <span class="input-group-text d-flex justify-content-center" style="width: 40px;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input class="form-control" list="pref-list" id="pref" name="pref" placeholder="都道府県">
                                    <datalist id="pref-list">
                                        @foreach(App\Consts\Consts::PREF_LIST as $pref)
                                        <option value="{{ $pref }}">
                                            @endforeach
                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <div class="input-group">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_null" name="is_null">
                                    <label class="form-check-label" for="is_null">画像が未設定のスポットに絞る</label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary btn-sm">検索</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($spots as $spot)
        <div class="col-md-3 px-3 py-2">
            <div class="card shadow rounded border-0 p-0">
                <div class="ratio ratio-16x9">
                    <img @if($spot->thumbnail_url) src="{{ $spot->thumbnail_url }}" @else src="https://www.publicdomainpictures.net/pictures/280000/velka/not-found-image-15383864787lu.jpg" @endif alt="{{$spot->name}}" class="rounded-top" style="object-fit: cover;">
                </div>
                <div class="card-body p-0">
                    <div class="accordion" id="accordion-{{$spot->id}}">
                        <div class="accordion-item border-top-0">
                            <div class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$spot->id}}" aria-expanded="false" aria-controls="collapse-{{$spot->id}}">
                                    <div class="fw-bold text-truncate d-flex align-items-center">
                                        {{ $spot->name }}
                                        <span class="badge bg-success ms-2">{{ $spot->pref }}</span>
                                    </div>
                                </button>
                            </div>
                            <div id="collapse-{{$spot->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion-{{$spot->id}}">
                                <div class="accordion-body">
                                    <form action="">
                                        <div class="input-group mb-2">
                                            <input class="form-control" type="file" accept="image/*" name="img" required>
                                        </div>
                                        <div class="text-center">
                                            <button class="btn btn-primary btn-sm">画像の更新</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="table-responsive mt-4">
        {{ $spots->links() }}
    </div>
</div>
@endsection