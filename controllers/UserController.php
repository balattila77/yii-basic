<?php

namespace app\controllers;

use app\models\Group;
use app\models\User;
use app\models\UserGroups;
use app\models\UserSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $group = new Group();
        // itt adható meg

        // set attribute - egy adott property-t állíthatunk be

        if ($this->request->isPost) {
            $model->password = password_hash('12345', PASSWORD_ARGON2I);
            $model->created_at = date('Y-m-d H:i:s');
            $model->auth_key = md5(random_bytes(5));
            $model->access_token = password_hash(random_bytes(10), PASSWORD_DEFAULT);
            if ($model->load($this->request->post()) && $model->save()) {
                if ($model->save(false)) {
                    if (is_array(Yii::$app->request->post()['Group']['id'])) {
                        foreach (Yii::$app->request->post()['Group']['id'] as $groupid) {
                            $usergroups = new UserGroups();
                            $usergroups->user_id = $model->id;
                            $usergroups->group_id = $groupid;
                            $usergroups->save();
                        }
                    }

                    Yii::$app->getSession()->setFlash('success', $model->username . ' created successfully');
                }
                return $this->redirect(['index', 'id' => $model->id]);
            }
            Yii::$app->getSession()->setFlash('success', print_r($model->getErrors(), 1));
            Yii::debug('test');
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'group' => $group,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $group = new Group();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            if ($model->save(false)) {
                UserGroups::deleteAll(['user_id' => $model->id]);
                if (is_array(Yii::$app->request->post()['Group']['id'])) {
                    foreach (Yii::$app->request->post()['Group']['id'] as $groupid) {
                        $usergroups = new UserGroups();
                        $usergroups->user_id = $model->id;
                        $usergroups->group_id = $groupid;
                        $usergroups->save();
                    }
                }

                Yii::$app->getSession()->setFlash('success', $model->username . ' updated successfully');
            }
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'group' => $group,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
