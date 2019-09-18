<?php
/**
 * Created by PhpStorm.
 * User: 沁塵
 * Date: 2019/4/20
 * Time: 19:57
 */

namespace app\api\controller\v1;

use app\api\model\ProductCategory as ProductCategoryModel;
use think\facade\Hook;
use think\Request;
use WangYu\exception\Exception;

/**
 * Class ProductCategory
 * @doc('商品分类')
 * @group('/v1/product_category')
 * @package app\api\controller\v1
 */
class ProductCategory
{
    /**
     * @doc('查询指定id的商品分类')
     * @route(':id','get')
     * @param Request $id
     * @param('id','图书id','require')
     * @return mixed
     */
    public function getProductCategory($id)
    {
        $result = ProductCategoryModel::get($id);
        return $result;
    }

    /**
     * @doc('查询所有商品分类')
     * @route('','get')
     * @return mixed
     */
    public function getProductCategorys()
    {
        $result = ProductCategoryModel::all()->toArray();
        $topCategory = ['id'=>0,'title'=>'顶级分类'];
        return !empty($result) ? array_unshift($result,$topCategory): [$topCategory];

    }

    /**
     * 搜索图书
     */
    public function search()
    {

    }

    /**
     * @doc('新建图书')
     * @route('/v1/book/','post')
     * @param Request $request
     * @param('title','图书名称','require')
     * @param('author','图书作者','require')
     * @param('image','图书img','require')
     * @param('summary','简介','require')
     * @return \think\response\Json
     */
    public function create(Request $request)
    {
        $params = $request->post();
        ProductCategoryModel::create($params);
        return writeJson(201, '', '新建图书成功');
    }

    /**
     * @doc('更新图书')
     * @route('/v1/book/:id','put')
     * @param Request $request
     * @param('id','图书id','require')
     * @return \think\response\Json
     */
    public function update(Request $request)
    {
        $params = $request->put();
        $bookModel = new ProductCategoryModel();
        $bookModel->save($params, ['id' => $params['id']]);
        return writeJson(201, '', '更新图书成功');
    }

    /**
     * @doc('删除图书')
     * @route('/v1/book/:id','delete')
     * @auth('删除图书','图书')
     * @param $bid
     * @return \think\response\Json
     */
    public function delete($bid)
    {
        ProductCategoryModel::destroy($bid);
        Hook::listen('logger', '删除了id为' . $bid . '的图书');
        return writeJson(201, '', '删除图书成功');
    }
}