<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\my_slider as slider;
use App\hm_product as product;
use App\hm_category as category;
use App\hm_attribute as attribute;
use App\hm_new as news;
use App\hm_feedback as feedback;
use App\hm_car_filter as filter;
use App\hm_attribute_value as valattr;
use App\hm_action as action;
use App\hm_service as service;

use DB;
use Cart;
use Session;

class ContentController extends Controller
{
    public function index()
    {   
        $attributes = array();
        $products = array();
        $sliders = slider::where('status','>','0')->get();
        $news = news::where('status','>','0')->get();
        $feedbacks = feedback::where('status','>','0')->get();
        $categories = category::get();

        if(is_object($categories) && count($categories)>0)
        {   
            foreach($categories as $cat)
            {   
                $products[$cat->id]['products'] = product::with('category')
                    ->with('attributes')
                    ->where('category_id',$cat->id)
                    ->get();
                if($products[$cat->id]['products']->count()>0)
                {
                    $products[$cat->id]['category'] = $cat->name;
                    $attributes[$cat->id] = attribute::where('category_id',$cat->id)
                        ->pluck('name','id')->toArray();                        
                }
                else
                    unset($products[$cat->id]);
            }
        }
        return view('content.index')
            ->with('sliders',$sliders)
            ->with('products',$products)
            ->with('attributes',$attributes)
            ->with('categories',$categories)
            ->with('news',$news)
            ->with('feedbacks',$feedbacks);
    }

    public function productlist(Request $request)
    {   
        $sliders = slider::where('status','>','0')->get();

        $data = $request->all();
        unset($data['_token']);

        $query = product::select(DB::raw('hm_products.*,avg(hm_product_attributes.id)'))
                ->leftjoin('hm_product_attributes','hm_product_attributes.product_id','=','hm_products.id')
                ->with('attributes');

        if($request->has('category_id'))
            $query->where('hm_products.category_id',$data['category_id']);
        else
            return redirect()->route('main');

        $query->groupBy('hm_products.id');

        if(isset($data['attribute'])) 
        {    
            $mas = []; 
            foreach($data['attribute'] as $a_id=>$v_id)
            {                       
                if($v_id)  
                {
                    $mas[$a_id] = $v_id;
                }
            }
            if(count($mas))
            {
                $query->whereIn('hm_product_attributes.value_id',$mas);
                $query->having(DB::raw('COUNT(hm_product_attributes.id)'),'=',count($mas));
            }
            unset($data['attribute']);
            $data['attribute'] = $mas;
        }
        $products = $query->paginate(env('PAGINATE'));

        $categories = category::get();
        foreach ($categories as $key => $cat) {
            $attributes[$cat->id] = attribute::where('category_id',$cat->id)
                ->pluck('name','id')->toArray(); 
        }

        $catName = $categories->keyBy('id');
        $catName = $catName[$data['category_id']]->name;
        
        return view('content.productlist')
            ->with('categories',$categories)
            ->with('attributes',$attributes)
            ->with('products',$products)
            ->with('catName',$catName)
            ->with('filter',$data)
            ->with('sliders',$sliders);
    }

    public function search(Request $request)
    {   
        $filter = new filter();

        $data = $request->all();
        unset($data['_token']);

        $search = array();

        if(count($data)==4)
        {   
            foreach ($data as $key => $param) 
            {
                if($param)
                {
                    if($key=='vendor')
                    {
                        $filter=$filter->where('vendor',$param);
                    }
                    if($key=='car')
                    {
                        $filter=$filter->where('car',$param);
                    }
                    if($key=='year')
                    {
                        $filter=$filter->where('year',$param);
                    }
                    if($key=='modification')
                    {
                        $filter=$filter->where('modification',$param);
                    }
                }
            }
            
            $list = $filter->first();
            
            if(!empty($list->zavod_diskov))
            {
                $stock_disk = explode('|', $list->zavod_diskov);
                foreach ($stock_disk as $key => $disk) {
                    $disk = str_replace('x ', '', $disk);
                    $disk = explode(' ', $disk);
                    $search['stock_disk'][] = [
                        'pcd'=>$list->pcd,
                        'co'=>$list->diametr,
                        'width'=>$disk[0],
                        'diameter'=>$disk[1],
                        'et'=>$disk[2]
                    ]; 
                }
            }

            if(!empty($list->zamen_diskov))
            {
                $change_disk = explode('|', $list->zamen_diskov);
                foreach ($change_disk as $key => $disk) {
                    $disk = str_replace('x ', '', $disk);
                    $disk = explode(' ', $disk);
                    $search['change_disk'][] = [
                        'pcd'=>$list->pcd,
                        'co'=>$list->diametr,
                        'width'=>$disk[0],
                        'diameter'=>$disk[1],
                        'et'=>$disk[2]
                    ]; 
                }
            }

            if(!empty($list->zavod_shini))
            {
                $stock_tires = explode('|', $list->zavod_shini);
                foreach ($stock_tires as $key => $tire) {
                    $tire = str_replace('/', ' ', $tire);
                    $tire = str_replace('R', 'R ', $tire);
                    $tire = explode(' ', $tire);
                    $search['stock_tires'][] = [
                        'width_tire'=>$tire[0],
                        'profile_tire'=>$tire[1],
                        'type_tire'=>$tire[2],
                        'diameter_tire'=>$tire[3]
                    ]; 
                }
            }

            if(!empty($list->zamen_shini))
            {
                $change_tires = explode('|', $list->zamen_shini);
                foreach ($change_tires as $key => $tire) {
                    $tire = str_replace('/', ' ', $tire);
                    $tire = str_replace('R', 'R ', $tire);
                    $tire = explode(' ', $tire);
                    $search['change_tires'][] = [
                        'width_tire'=>$tire[0],
                        'profile_tire'=>$tire[1],
                        'type_tire'=>$tire[2],
                        'diameter_tire'=>$tire[3]
                    ]; 
                }
            }
            $categories = category::get();
            foreach ($categories as $key => $cat) {
                $attributes[$cat->id] = attribute::where('category_id',$cat->id)
                    ->pluck('name','id')->toArray(); 
            }

        }
        return view('content.search')
            ->with('search',$search)
            ->with('attributes',$attributes)
            ->with('categories',$categories);
    }

    public function actionList(Request $request)
    {
        $actions = action::get();
        $title = 'Список акций';
        return view('content.action')
            ->with('list',$actions)
            ->with('title',$title);
    }

    public function actionItem($id,Request $request)
    {
        $action = action::find($id);
        $title = $action->name;
        return view('content.action')
            ->with('action',$action)
            ->with('title',$title);
    }

    public function services($alias,Request $request)
    {
        $service = service::where('alias',$alias)->first();
        $title = isset($service->name)?$service->name:'Страница не найдена';
        return view('content.service')
        ->with('service',$service)
        ->with('title',$title);
    }

    public function siteList()
    {
        $list = news::where('status',1)->paginate(env('PAGINATE'));
        return view('content.newslist')
        ->with('list',$list);
    }

    public function siteItem($id)
    {
        $new = news::find($id);
        return view('content.newslist')
        ->with('new',$new);
    }
}
