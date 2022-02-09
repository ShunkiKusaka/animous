@extends('layouts.app')

@section('title')
    ペット投稿
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-8 offset-2 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">投稿する</div>

                <form method="POST" action="{{ route('sell') }}" class="p-5" enctype="multipart/form-data">
                    @csrf
    
                    {{-- ペット画像 --}}
                    <div>ペット画像</div>
                    <span class="item-image-form image-picker">
                        <input type="file" name="item-image" class="d-none" accept="image/png,image/jpeg,image/gif" id="item-image" />
                        <label for="item-image" class="d-inline-block" role="button">
                            <img src="/images/item-image-default.png" style="object-fit: cover; width: 300px; height: 300px;">
                        </label>
                    </span>
                    @error('item-image')
                        <div style="color: #E4342E;" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    {{-- ペット名 --}}
                    <div class="form-group mt-3">
                        <label for="name">ペット名</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- ペットの説明 --}}
                    <div class="form-group mt-3">
                        <label for="description">ペットの説明</label>
                        <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus>{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- カテゴリ --}}
                    <div class="form-group mt-3">
                        <label for="category">カテゴリ</label>
                        <select name="category" class="custom-select form-control @error('category') is-invalid @enderror">
                            @foreach ($categories as $category)
                                <optgroup label="{{$category->name}}">
                                    @foreach($category->secondaryCategories as $secondary)
                                    <!-- $category->secondaryCategoriesはapp/Models/PrimaryCategory.phpで1対多のリレーションを定義してるから
                                    簡単にこのように大カテゴリに紐づく小カテゴリの一覧が取得できる -->
                                        <option value="{{$secondary->id}}" {{old('category') == $secondary->id ? 'selected' : ''}}>
                                            {{$secondary->name}}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- ペットの状態 --}}
                    <div class="form-group mt-3">
                        <label for="condition">ペットの状態</label>
                        <select name="condition" class="custom-select form-control @error('condition') is-invalid @enderror">
                            <!-- コントローラで取得した「商品の状態」の配列から選択肢を作成 -->
                            @foreach ($conditions as $condition)
                                <option value="{{$condition->id}}" {{old('condition') == $condition->id ? 'selected' : ''}}>
                                    {{$condition->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('condition')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- 譲渡価格 --}}
                    <div class="form-group mt-3">
                        <label for="price">譲渡価格</label>
                        <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price" autofocus>
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-secondary">
                            投稿する
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection