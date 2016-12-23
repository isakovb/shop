<?php
namespace App\Http\Controllers;
use App\Models\Query;
use App\Models\Product;
use App\Models\Category;
use App\Models\Property;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $query = Input::get('query');
        $query = substr($query, 0, 64);
        $query = preg_replace('/[^\p{L}0-9 ]/iu','',$query);
        $queryModel = new Query;

        if(!empty($query)){
            $queries = $queryModel->where('query','LIKE','%'.$query.'%');
            $exact_match = $queryModel->where('query','LIKE', $query);
        }

        $data = $queries->get()->toArray();
        $exact = $exact_match->get()->toArray();
        if(count($exact) < 1){
            $queryModel->query = $query;
            $queryModel->save();
        }else{
            $exact = reset($exact);
            $queryModel->where('id', $exact['id'])
                       ->update(['weight' => DB::raw($exact['weight']+1)]);
        }

        return response()->json(array('data' => $data), 200);
    }

    public function suggestion(){
      $query = Input::get('query');
      $data = [];
      $dictionary = Dictionary::search($query, ['name'])->select('name', 'relevance')->get();
      foreach($dictionary as $key=>$d)
      {
        $dictionary[$key]['relevance'] = round($dictionary[$key]['relevance']/($this->stringCompare($query, $d['name']) + 1), 5);
        if($dictionary[$key]['relevance']<0.05) unset($dictionary[$key]);
      }
      return response()->json(array('data' => $dictionary), 200);
    }

    public function products(){
      DB::enableQueryLog();
      $data = [];
      $query = Input::get('query');
      $categories = Category::search($query, ['name'])->get()->toArray();
      $ids = [];
      foreach($categories AS $category)
      {
        if(!empty($category['childs']))
            foreach(explode(',', $category['childs']) AS $id)
            {
                if(!in_array($id, $ids)) $ids[] = $id;
            }
      }
      //$data = Product::search($query.'*', ['name','categories.name','values.name'], true, ['category.id' => $ids])
        $data = Product::search($query, ['name','categories.name','values.name','categories.subcategories.name'])
                     ->with('shops')
                     ->get();
      $products = $data->toArray();
      $productIds = array();
      foreach($products AS $key=>$product)
      {
        $products[$key]['relevance'] = round($products[$key]['relevance']/($this->stringCompare($query, $product['name']) + 1), 5);
      }
      return response()->json(array('data' => $products), 200);
    }

    private function stringCompare($s1, $s2)
    {
        $charMap = array();
        $s1 = $this->utf8_to_extended_ascii($s1, $charMap);
        $s2 = $this->utf8_to_extended_ascii($s2, $charMap);

        return levenshtein($s1, $s2);
    }

    private function utf8_to_extended_ascii($str, &$map)
    {
        // find all multibyte characters (cf. utf-8 encoding specs)
        $matches = array();
        if (!preg_match_all('/[\xC0-\xF7][\x80-\xBF]+/', $str, $matches))
            return $str; // plain ascii string

        // update the encoding map with the characters not already met
        foreach ($matches[0] as $mbc)
            if (!isset($map[$mbc]))
                $map[$mbc] = chr(128 + count($map));

        // finally remap non-ascii characters
        return strtr($str, $map);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
