@inject('category','App\Category')
<?php
    $id = collect(explode('/',\Illuminate\Http\Request::capture()->url()))->last();
    if ($id == 'category'){
        $category = $category->where('parent_id', null)->pluck('name', 'id')->toArray();
    }else{
        $category = $category->where('parent_id',$id)->pluck('name', 'id')->toArray();
    }
    ?>
    {{-- <div class="form-group">
        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.name')}} </label>
        {!! Form::text('name',null,[
        'class' => 'form-control',
        'id' => 'name'
        ]) !!}
    </div> --}}

    <div class="mb-3 row">
        <label for="name" class="col-md-2 col-form-label">{{__('lang.name')}}</label>
        <div class="col-md-10">
            <input class="form-control" type="text" name="name" value="{{$category[1]}}"
                id="name">
        </div>
    </div>

    {{-- <div class="form-group">
        <label for="inputProjectLeader">{{__('lang.category')}}</label>

        {{ Form::select('parent_id', $category, null, array('class'=>'form-control select2', 'id' => 'parent_id', 'placeholder'=>'Category')) }}
    </div> --}}

    {{-- <div class="form-group">
        <label style="color:#000;font-size: 15px;padding-bottom: 15px" class="label">{{__('lang.image')}} </label>
        <div class="col-md-4">
            {!! Form::file('image') !!}
        </div>
    </div> --}}

    <div class="mb-3 row">
        <label class="col-md-2 col-form-label" for="inputGroupFile02">image</label>
        <div class="col-md-10">
            <input type="file" class="form-control" id="inputGroupFile02">
        </div>
    </div>



