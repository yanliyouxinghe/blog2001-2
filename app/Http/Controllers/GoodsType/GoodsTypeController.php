<?php

namespace App\Http\Controllers\GoodsType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\GoodsType;
use App\Model\Attribute;
class GoodsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $GoodsType = new GoodsType();
      $data = $GoodsType->orderBy('cat_id','desc')->paginate(4);
    //   dd($data);
      if (Request()->ajax()){
          return view('goodstype.ajaxpage', ['data' => $data]);
      }
      return view('goodstype.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view('goodstype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $cat_name =  $request->input('cat_name');
        if(empty("cat_name")){
          return redirect('/goodstype/create')->with('msg', '必填项不能为空');
          die;
        }
        $GoodsType = new GoodsType();
        //唯一性验证
        $ret_name = $GoodsType::where('cat_name', $cat_name)->first();
        if ($ret_name) {
            return redirect('/goodstype/create')->with('msg', '此类型已存在，请重新添加');
            die;
        }
        //需要添加的数据
        $data = [
            'cat_name' => $cat_name,
        ];
        //执行添加
        $res = $GoodsType->create($data);
        if ($res) {
            //添加成功
            echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/goodstype/list"</script>';
            die;
        } else {
            //添加失败
            return redirect('/goodstype/create ')->with('msg', '操作繁忙，请稍后重试...');
            die;
        }
    }

    public function destroy(Request  $request)
    {
      $ids = Request()->all();
      if(!$ids){
          return $this->JsonResponse('11','请选择要删除的数据');
      }
      foreach ($ids as $k=>$v){
          $isdel = GoodsType::destroy($v);
      }
      if($isdel){
          return $this->JsonResponse('0','OK');
      }else{
          return $this->JsonResponse('1','删除失败');
      }
    }

    public function addprop($id){
        return view('goodstype.addprop',['id'=>$id]);
    }
    public function addpropdo(Request $request){
        $cat_id = $request->input('cat_id');
        $attr_name = $request->input('attr_name');
        $attr_values = $request->input('attr_values');

        // $post = request()->all();

        if(empty($cat_id) || empty($attr_name) || empty($attr_values)){
            return redirect('/goodstype/create ')->with('msg', '操作繁忙，请稍后重试...');die;
        }
        $ret = Attribute::where(['cat_id'=>$cat_id,'attr_name'=>$attr_name])->first();
        if($ret){
          return redirect('/goodstype/create ')->with('msg', '属性名称已经存在');die;
        }
        $data = [
          'cat_id'=>$cat_id,
          'attr_name'=>$attr_name,
          'attr_values'=>$attr_values
        ];
        $res = Attribute::create($data);
        if($res){
          echo '<script>alert("添加成功，正在为您跳至列表页....");location.href="/goodstype/list"</script>';
          die;
        }else{
          return redirect('/goodstype/create ')->with('msg', '添加失败');die;
        }
    }
    public function proplist($id){
        
        $Attrlist = Attribute::leftjoin('goods_type','goods_type.cat_id','=','attribute.cat_id')
        ->where('attribute.cat_id',$id)
        ->get();
        return view('goodstype.attrlist',['Attrlist'=>$Attrlist,'cat_id'=>$id]);
    }
    public function delattr(){
        $ids = Request()->all();
        if(!$ids){
            return $this->JsonResponse('11','请选择要删除的数据');
        }
        foreach ($ids as $k=>$v){
            $isdel = Attribute::destroy($v);
        }
        if($isdel){
            return $this->JsonResponse('0','OK');
        }else{
            return $this->JsonResponse('1','删除失败');
        }
    }
    public function addattr($id){
         $type = GoodsType::get();
        return view('goodstype.attrcreate',['type'=>$type,'id'=>$id]);
    }

    public function storeattr(Request $request){
         $post = $request->all();
         $ret = Attribute::where(['cat_id'=>$post['cat_id'],'attr_name'=>$post['attr_name']])->first();
        if($ret){
            return redirect('/goodstype/addattr/'.$post['cat_id'])->with('msg','此属性已存在');die;
        }
        $res = Attribute::create($post);
        if($res){
            return redirect('/goodstype/proplist/'.$post['cat_id']);
        }else{
            return redirect('/goodstype/addattr/'.$post['cat_id'])->with('msg','操作繁忙，请稍后重试');die;

        }

    }
}
