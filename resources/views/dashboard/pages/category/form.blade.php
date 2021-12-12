@inject('category','App\Category')
<?php
    $id = collect(explode('/',\Illuminate\Http\Request::capture()->url()))->last();
    if ($id == 'category'){
        $category = $category->where('parent_id', 0)->pluck('name', 'id')->toArray();
    }else{
        $category = $category->where('parent_id',$id)->pluck('name', 'id')->toArray();
    }
?>

<div class="mb-3 row">
    <label class="col-md-2 col-form-label" for="name">{{ __('category.nameColumn') }} </label>
    <div class="col-md-10">
        {!! Form::text('name',null, ['class' => 'form-control', 'id' => 'name']) !!}
    </div>
</div>

<div class="mb-3 row">
    <label class="col-md-2 col-form-label" for="parent_id">{{ __('category.category') }}</label>
    <div class="col-md-10">
        {{ Form::select('parent_id', $category, null, array('class'=>'form-select', 'id' => 'parent_id', 'placeholder'=>'Category')) }}
    </div>
</div>


<div class="mb-3 row">
    <label class="col-md-2 col-form-label" for="image">{{ __('category.imageColumn') }}</label>
    <div class="col-md-10">
        {!! Form::file('image', array('class'=>'form-control', 'id'=>'image')) !!}
    </div>
</div>
