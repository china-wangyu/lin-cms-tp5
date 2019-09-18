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
     * @param('id','分类id','require')
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
        return $result;
    }

    /**
     * 搜索分类
     */
    public function search()
    {

    }

    /**
     * @doc('新建分类')
     * @route('','post')
     * @param Request $request
     * @param('title','分类名称','require|chsDash')
     * @param('parent_id','分组父ID','require')
     * @return \think\response\Json
     */
    public function create(Request $request)
    {
        $params = $request->post();
        dump($params);die;
        ProductCategoryModel::create($params);
        return writeJson(201, '', '新建分类成功');
    }

    /**
     * @doc('更新分类')
     * @route('/v1/book/:id','put')
     * @param Request $request
     * @param('id','分类id','require')
     * @return \think\response\Json
     */
    public function update(Request $request)
    {
        $params = $request->put();
        $bookModel = new ProductCategoryModel();
        $bookModel->save($params, ['id' => $params['id']]);
        return writeJson(201, '', '更新分类成功');
    }

    /**
     * @doc('删除分类')
     * @route('/v1/book/:id','delete')
     * @auth('删除分类','分类')
     * @param $bid
     * @return \think\response\Json
     */
    public function delete($bid)
    {
        ProductCategoryModel::destroy($bid);
        Hook::listen('logger', '删除了id为' . $bid . '的分类');
        return writeJson(201, '', '删除分类成功');
    }
}