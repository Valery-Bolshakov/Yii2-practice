<?php
/*СТРАНИЦА ВИДА  Категории товаров
http://yii2-practice/admin/category/index*/

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row"><!--обернем таблицу в класс row-->
    <div class="col-md-12"><!--Задаем ширину таблицы на всю страницу-->
        <!--https://adminlte.io/themes/AdminLTE/pages/tables/simple.html
        Копируем готовую разметку для таблицы с сайта шаблона админки-->

        <div class="box">
            <div class="box-header with-border">
                <!--a("название кнопки", ["экшен"], ['class'])-->
                <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
            <div class="box-body">

                <div class="category-index">

                    <!--добавляет форму поиска в более наглядном виде-->
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
//                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
//                            'parent_id',  // пока что выводит цифры - к какой категории принадлежит товар
                            [
                                'attribute' => 'parent_id', // указываем с каким полем работаем
                                /*выполняем коллбек функцию, параметром будет принимать данные(обьект категории).
                                И проверяем. Если у этого обьекта имеется тайтл - то возвращаем тайтл, "??"
                                если нет тайтла - возвращаем 'Самостоятельная категория'

                                Здесь "->category" это геттер который мы установили через связь в модели Category
                                Он вернет либо обьект модели либо пустоту*/
                                'value' => function ($data) {
                                    return $data->category->title ?? 'Самостоятельная категория';
                                },
                            ],

                            'title',
//                            'description',
//                            'keywords',

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>

            </div>
        </div>
    </div>
</div>





