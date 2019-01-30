<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 24.01.2019
 * Time: 23:43
 */

namespace app\controllers;


use app\models\Category;
use app\models\Promo;
use Yii;
use yii\web\Controller;
use app\models\Products;
use yii\helpers\Html;

class CategoryController extends Controller
{
    public function actionIndex()
    {

        $allProducts = new Products();
        $products = $allProducts->getAllProducts(10);

        return $this->render('index', compact('products', 'allProducts'));
    }

    public function actionView($id)
    {
        $allProducts = new Products();

        if ($id == 'new') {
            $products = new Products();
            $products = $products->getAllProducts(10);
            return $this->render('new', compact('products', 'allProducts'));
        } else {
            $products = new Products();
            $page = (empty($_GET['page'])) ? 1 : $_GET['page'];
            $pageSize = (empty($_GET['per-page'])) ? 8 : $_GET['per-page'];
            $products = $products->getProductsCategories($id, $page, $pageSize);
//        $products = $products->getProductsCategories($id, $_GET['page'], $_GET['per-page']);

            //Получаем название категории
            $title = new Category();
            $title = $title->getCategoryTitle($id);

            return $this->render('view', compact('products', ['title', 'allProducts']));
        }

    }

    public function actionSearch()
    {

        $allProducts = new Products();
//        $search = Yii::$app->request->get('search');
//        $search = \yii\helpers\Html::encode(Yii::$app->request->get('search')); //Защита от XSS
        $search = Html::encode(Yii::$app->request->get('search')); //Защита от XSS
        $products = new Products();
        $products = $products->getSearchResults($search, 8);
//        return $this->render('search', compact('products', 'search'));
        return $this->render('search', compact('products', ['search', 'allProducts']));
    }
}