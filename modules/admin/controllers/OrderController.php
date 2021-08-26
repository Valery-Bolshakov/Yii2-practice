<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\OrderProduct;
use Yii;
use app\modules\admin\models\Order;
use yii\data\ActiveDataProvider;
use app\modules\admin\controllers\AppAdminController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.(работает с моделью Order)
 *
 * Создали контроллер и представления с помощью генератора года Gii. (создает экшены CRUD)
 *
 * Образец:
 * Model Class:
 * app\modules\admin\models\Order - модель с которой работает контроллер
 *
 * Controller Class:
 * app\modules\admin\controllers\OrderController - Название создаваемого контроллера
 *
 * View Path
 * @app/modules/admin/views/order - Путь к дирректории в которой надо создать представления
 *
 * Base Controller Class:
 * app\modules\admin\controllers\AppAdminController - наследуемый контроллер
 */
class OrderController extends AppAdminController
{
    /**
     * ВНИМАНИЕ! класс OrderController наследует AppAdminController. И данное поведение
     * behaviors перезапишет главное поведение в AppAdminController. Что бы этого не произошло
     * переносим поведение из AppAdmin в app/modules/Module. Так как все начинается с данного
     * файла и он в приоритете.
     */
    public function behaviors()
    {
        /*поведение указывает какой тип запроса нужен ждя данного экшена
        для экшена delete принимается запрос POST*/
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            /*получаем данные из модели Order и передаем их в вид
            так же можно здесь же настроить пагинацию, обращаемся к свойству pagination и 'pageSize' => 3*/
            'query' => Order::find(),
            'pagination' => [
                'pageSize' => 5,  // выставляем по 3 записи на 1 страницу
            ],
            /*Добавляем свойство сортировки и сортируем*/
            'sort' => [
                'defaultOrder' => [
//                    'id' => SORT_DESC,  // Отсортировали по id в обратном порядке (SORT_ASC - прямой порядок)
                    'status' => SORT_ASC  // отсортировали по полю статус
                ]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*если данные из формы успешно пришли и сохранились - выводим сетфлешку*/
            Yii::$app->session->setFlash('success', 'Заказ обновлен');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*Настроим экшен делит так что бы он удалял данные и из таблицы
    orders и из таблицы order_product*/
    public function actionDelete($id)
    {
        /*Так как модели Order и Order_Product связаны - то сначала надо удалить связь,
        а затем удалить сам обьект

        unlinkAll('название связи')*/
//        $this->findModel()->unlinkAll('orderProduct', true);  // первый вариант удаления

        $this->findModel($id)->delete();

        OrderProduct::deleteAll(['order_id' => $id]);  // второй вариант удаления

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    /*Метод findModel возвращает результат работы метода findOne*/
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
