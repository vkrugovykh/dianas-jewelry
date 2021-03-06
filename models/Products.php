<?php
/**
 * Created by PhpStorm.
 * User: Vassiliy
 * Date: 25.01.2019
 * Time: 0:36
 */

namespace app\models;


use Yii;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\db\Query;

class Products extends ActiveRecord
{

    //Название таблицы с которой будем работать
    public static function tableName()
    {
        return 'products';
    }

    //Получим все товары и закэшируем
    public function getAllProducts($limit = 10)
    {
        $products = Yii::$app->cache->get('products');
        if (!$products) {
            $products = Products::find()->orderBy(['id'=>SORT_DESC])->limit($limit)->asArray()->all();
            Yii::$app->cache->set('products', $products, 10);
        }

        return $products;
    }


    //Получим все товары определенной категории  и закэшируем
    public function getProductsCategories($id, $page = 1, $pageSize = '8')
    {

        //Получаем ID категории товаров
        $categoryId = Category::find()->where(['category_alias' => $id])->one();

        switch ($id) {

            case 'promo':
                $query = Products::find()->innerJoin('promo', 'products.id = promo.product_id');
                break;
            default:
                $query = Products::find()->where(['category_id' => $categoryId['id']]);
                break;
        }

        //Общее количество товаров в категории

        $count = $query->count();

        //Для пагинации
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        //Получаем данные из кэша
        $data['catProducts'] = Yii::$app->cache->get($id . $page);

        //Проверяем наличие данных в кэше, если нет, то не используем кэш, но добавляем в него данные для дальнейшей работы
        if (!$data['catProducts']) {


            $catProducts = $query->offset($pagination->offset)
                ->limit($pagination->limit)
                ->asArray()->all();

            $data['catProducts'] = $catProducts;
            Yii::$app->cache->set($id . $page, $data['catProducts'], 10);
        }

            $data['pagination'] = $pagination;

        return $data;
    }

    //Получим один товар по alias
    public function getOneProduct($alias)
    {
        return Products::find()->where(['alias' => $alias])->one();
    }

    public function getProductPromo($alias)
    {
        $product = new Products();
        $product = $product->getOneProduct($alias);

        $promo = new Promo();
        $percent = $promo->getPromoOfProduct($product['id']);

        if (Yii::$app->user->isGuest) {
            $price = $product['price'];
        } else {
            $price = $product['price'] - ($product['price']) * 10 / 100;
        }

        return $price - ($product['price'] * $percent / 100);
    }

    //Получим все товары поиска по имени
    public function getSearchResults($search, $pageSize = 8)
    {
        //Запрос в БД
        $query = Products::find()
            ->where(['like', 'name', $search])
            ->orWhere(['like', 'short_description', $search])
            ->orWhere(['like', 'description', $search])
            ->orWhere(['like', 'specification', $search]);


        //Общее количество товаров в категории
        $count = $query->count();

        //Для пагинации
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        //Результат для дальшейшего использования с учетом пагинации
        $searchResults = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->asArray()->all();

        $data['searchResults'] = $searchResults;
        $data['pagination'] = $pagination;

        return $data;
    }
}