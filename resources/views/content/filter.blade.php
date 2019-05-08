<div class="accordion filter-block" id="accordionExample">
    @if(isset($categories) && count($categories)>0)
        @foreach ($categories as $category)
            @if(isset($attributes[$category->id]))

            <div class="card">
                <div class="card-header" id="heading{{$category->id}}">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{$category->id}}" aria-expanded="true" aria-controls="collapse{{$category->id}}">
                            Подобрать {{mb_strtolower($category->name)}}
                        </button>
                    </h5>
                </div>
                <div 
                    id="collapse{{$category->id}}" 
                    class="collapse 
                        {{($category->id == @$filter['category_id'])?'show':''}}
                    " 
                    aria-labelledby="heading{{$category->id}}" 
                    data-parent="#accordionExample"
                >
                    <div class="card-body">
                        <form class="filter-form" method="GET" action="/content/product">
                            <input 
                                type="hidden" 
                                name="category_id" 
                                value="{{$category->id}}"
                            > 
                            
                            @foreach($attributes[$category->id] as $a_key=>$attr)
                            <div class="form-group">
                                <label> {{$attr}}</label>
                                <select 
                                    class="filter-attribute form-control" 
                                    name="attribute[{{$a_key}}]" 
                                >
                                    <option selected value="0">Любой</option>
                                @foreach(App\hm_attribute_value::where('attribute_id',$a_key)->pluck('value','id') as $k_list=>$list)
                                    <option value="{{$k_list}}"
                                        @if(@array_key_exists($a_key, $filter['attribute']))
                                            @if($filter['attribute'][$a_key]==$k_list)
                                                selected 
                                            @endif
                                        @endif
                                    >
                                        {{$list}}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            @endforeach
                            <div class="form-group">
                                <button class="filter-search btn btn-block btn-warning">Найти</button>
                            </div>

                            <div class="form-group">
                                <button type="button" class="filter-clear btn btn-block btn-dark">Сбросить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    @endif
    <!---->
    <div class="card">
        <div class="card-header" id="headingThree">
        <h5 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Подбор по авто
            </button>
        </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                {{Form::open(['url'=>route('search'),'class'=>'filter-form'])}}
                        <div class="form-group">
                            <label>Марка</label>
                            <select name="vendor" class="width-400 form-control" id="filter-vendor" url="{{route('filter')}}">
                                <option selected disabled></option>
                                @foreach(App\hm_car_filter::getBrands() as $brand)
                                    <option value="{{$brand}}">{{$brand}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Модель</label>
                            <select name="car" class="width-400 form-control" id="filter-car" url="{{route('filter')}}">
                                <option selected disabled></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Год</label>
                            <select name="year" class="width-400 form-control" id="filter-year" url="{{route('filter')}}">
                                <option selected disabled></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Исполнение</label>
                            <select name="modification" class="width-400 form-control" id="filter-modification" url="{{route('filter')}}">
                                <option selected disabled></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-warning">Найти</button>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-block btn-dark">Сбросить</button>
                        </div>
                {{Form::close()}}                           
            </div>
        </div>
    </div>
</div>