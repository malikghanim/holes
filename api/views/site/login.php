<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;
use yii\common\models\LoginForm;

$this->beginPage();
$this->title = 'Sign In';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
        <?= Html::csrfMetaTags() ?>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->head() ?>
        <link rel="stylesheet" type="text/css" href="/css/authorize.css" media="all">
        <script type="text/javascript"  src="/js/vendors.js"></script>
        <meta name="application-name" content="Maqtoo3.com"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
    </head>
    <body>
    <?php $this->beginBody() ?>

<div class="small-12 medium-12 large-12 default-float">
    <div class="small-12 medium-12 large-12 columns section">
        <div class="small-12 medium-12 large-8 large-centered columns text-center ban-box">
            <div class="form-wrapper animated fadeIn fix-box">

                <div class="row">
                    <div class="large-12 medium-12 small-12 columns strike">
                        <span>Sign In Using</span>
                    </div>
                <?php $authAuthChoice = AuthChoice::begin(['baseAuthUrl' => ['site/auth'], 'autoRender' => false, 'popupMode' => true]); ?>
                    <div class="small-12 medium-12 large-12 columns text-center">
                        <div class="social-col">
                            <ul>
                                <li>
                                    <a href="<?= Yii::$app->request->hostInfo ?>/site/auth?authclient=facebook" class="button default-btn social-btn facebook">
                                        <i class="icon icon-facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= Yii::$app->request->hostInfo ?>/site/auth?authclient=google" class="button default-btn social-btn google">
                                        <i class="icon icon-google"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?php AuthChoice::end(); ?>
                </div>
            </div>
        </div>
     </div>
</div>

    
</html>
<?php $this->endPage() ?>
