<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * This is for generating Rbac roles
 *
 * You can use this command to generate models, controllers, etc. For example,
 * to generate an ActiveRecord model based on a DB table, you can run:
 *
 * ```
 * $ ./yii rbac --tableName=city --modelClass=City
 * ```
 *
 * @author Sandino
 * @author sandino
 * @since 1.0
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "createPost" permission
        /*$updateBandera = $auth->createPermission('updateCountryBandera');
        $updateBandera->description = 'Permiso para modificar el campo flag_url del modelo country';
        $auth->add($updateBandera);


        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('author');
        $auth->add($author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updateBandera);
        $auth->addChild($admin, $author);*/

        $gerente = $auth->createRole('gerente');
       // $auth->add($gerente);

        $despachador = $auth->createRole('despachador');
        //$auth->add($despachador);

        $cliente = $auth->createRole('cliente');
//        $auth->add($cliente);

        $auth->assign($gerente, 3);
        $auth->assign($cliente, 5);
        $auth->assign($despachador, 4);
        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
        // $auth->assign($author, 2);
        // $auth->assign($admin, 1);
    }
}