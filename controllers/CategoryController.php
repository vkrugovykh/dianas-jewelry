<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 24.01.2019
 * Time: 23:43
 */

namespace app\controllers;


use app\models\Category;
use Yii;
use yii\web\Controller;
use app\models\Products;
use yii\helpers\Html;

class CategoryController extends Controller
{
    public function actionIndex()
    {
        $products = new Products();
        $products = $products->getAllProducts(10);
        return $this->render('index', compact('products'));
    }

    public function actionView($id)
    {
        $products = new Products();
        $products = $products->getProductsCategories($id, $_GET['page'], 8);

        //Получаем название категории
        $title = new Category();
        $title = $title->getCategoryTitle($id);

        return $this->render('view', compact('products', 'title'));
    }

    public function actionSearch()
    {
//        $search = Yii::$app->request->get('search');
//        $search = \yii\helpers\Html::encode(Yii::$app->request->get('search')); //Защита от XSS
        $search = Html::encode(Yii::$app->request->get('search')); //Защита от XSS
        $products = new Products();
        $products = $products->getSearchResults($search, 8);
        return $this->render('search', compact('products', 'search'));
    }
}