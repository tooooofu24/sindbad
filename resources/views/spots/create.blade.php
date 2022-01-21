@extends('layouts.header')

@section('content')
<div class="container">
    <div id="app">
        <example-component></example-component>
    </div><!-- #app -->
    @if(session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-6 p-3">
            <div class="mx-auto h-100">
                <div class="card h-100">
                    <div class="card-header">
                        スポット一括登録
                    </div>
                    <div class="card-body">
                        <form action="{{ route('spots.create.csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="csv" class="form-label">csvファイルをアップロードしてください</label>
                            <div class="input-group">
                                <input class="form-control @error('csv') is-invalid @enderror" type="file" id="csv" accept=".csv" name="csv" required>
                                @error('csv')
                                <div class="invalid-feedback">
                                    <pre>{{ $message }}</pre>
                                </div>
                                @enderror
                            </div>
                            <div class="text-center m-2">
                                <button class="btn btn-primary">送信する</button>
                            </div>
                        </form>
                        <div class="mt-4">
                            <a href="/sample.csv">サンプルはこちら</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 p-3">
            <div class="mx-auto">
                <div class="card">
                    <div class="card-header">
                        スポット登録(1件ずつ)
                    </div>
                    <div class="card-body">
                        <form action="{{ route('spots.create.store') }}" method="POST">
                            @csrf
                            <label for="name" class="form-label">観光地名</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-mountain"></i>
                                </span>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="例：富士山" id="name" name="name" required value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="pref" class="form-label">都道府県</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fas fa-map-marker-alt"></i>
                                </span>
                                <input class="form-control @error('pref') is-invalid @enderror" list="pref-list" id="pref" name="pref" required placeholder="入力してください" value="{{ old('pref') }}">
                                <datalist id="pref-list">
                                    @foreach(App\Consts\Consts::PREF_LIST as $pref)
                                    <option value="{{ $pref }}">
                                        @endforeach
                                </datalist>
                                @error('pref')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center m-2">
                                <button class="btn btn-primary">送信する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection