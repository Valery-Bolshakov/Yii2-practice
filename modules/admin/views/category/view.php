<?php
/*Вид просмотра какой нибудь категории товара
например Fruits http://yii2-practice/admin/category/view?id=5*/

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Category */

$this->title = "Категория: " . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="row"><!--обернем таблицу в класс row-->
    <div class="col-md-12"><!--Задаем ширину таблицы на всю страницу-->
        <!--https://adminlte.io/themes/AdminLTE/pages/tables/simple.html
        Копируем готовую разметку для таблицы с сайта шаблона админки-->

        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <div class="box-body">

                <div class="category-view">

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
//                            'parent_id',
                            [
                                'attribute' => 'parent_id', // указываем с каким полем работаем
                                /* так как в виджете имеется $model, мы все можем брать оттуда и не требуется
                                выполнять коллбек функцию.
                                Если у этого обьекта имеется тайтл "?" то возвращаем тайтл в виде ссылки на
                                эту категорию,
                                 ":" если нет тайтла - возвращаем 'Самостоятельная категория'*/
                                'value' => isset($model->category->title) ?
                                    '<a href="' . \yii\helpers\Url::to(['category/view', 'id' => $model->category->id])
                                    . '">' . $model->category->title . '</a>' : 'Самостоятельная категория',
                                'format' => 'raw',  // что бы ссылка корректно отрабатывала дописываем данное свойство
                                /*'format' => 'html' что бы ссылка корректно отрабатывала дописываем данное свойство*/
                            ],
                            'title',
                            'description',
                            'keywords',
                        ],
                    ]) ?>

                </div>

            </div>
        </div>
    </div>
</div>





