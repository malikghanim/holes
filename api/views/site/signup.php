<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\helpers\MakePrintable;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->beginPage();

$this->title = 'Maqtoo3: Sign Up';
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
<?= Html::csrfMetaTags() ?>
        <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= MakePrintable::GetMetaTags(); ?>
        <?php $this->head() ?>
        <link rel="icon" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-57x57.png" type="image/x-icon" />
        <?php //if(Url::current()== '/site/index'):  ?>

<?php //else:  ?>
        <link rel="stylesheet" type="text/css" href="/css/authorize.css" media="all">

        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-60x60.png" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/apple-touch-icon-152x152.png" />
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/favicon-196x196.png" sizes="196x196" />
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/favicon-32x32.png" sizes="32x32" />
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/favicon-16x16.png" sizes="16x16" />
        <link rel="icon" type="image/png" href="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/favicon-128.png" sizes="128x128" />
        <meta name="application-name" content="Maqtoo3.com"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/mstile-144x144.png" />
        <meta name="msapplication-square70x70logo" content="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/mstile-70x70.png" />
        <meta name="msapplication-square150x150logo" content="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/mstile-150x150.png" />
        <meta name="msapplication-wide310x150logo" content="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/mstile-310x150.png"/>
        <meta name="msapplication-square310x310logo" content="<?= Yii::$app->request->hostInfo ?>/images/favicomatic/mstile-310x310.png" />
        <script src="https://cdn.optimizely.com/js/5002581356.js"></script>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({'gtm.start':
                            new Date().getTime(), event: 'gtm.js'});
                var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', 'GTM-5NCS6RG');</script>
        <!-- End Google Tag Manager -->
    </head>
    <body>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NCS6RG"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
<?php $this->beginBody() ?>
        <div class="off-canvas-wrap" data-offcanvas>
            <div class="inner-wrap">				
                <div class="small-12 medium-12 large-12 default-float">
                    <div class="small-12 medium-12 large-12 columns section static auth">
                        <div class="row">
                            <div class="small-12 medium-12 large-12 columns">
                                <h1 style="line-height: 0 !important;">Create an Account</h1>
                            </div>
                        </div>
                    </div>
                    <div class="small-12 medium-12 large-12 columns section banner">
                        <?php
                        $form = ActiveForm::begin([ 'action' => Yii::$app->request->absoluteUrl, 'id' => 'SignupForm',
                                    'fieldConfig' => [
                                        'options' => [
                                            'tag' => false
                                        ],
                                        'template' => "{label}\n{beginWrapper}\n{input}\n<span></span>\n{hint}\n{error}\n{endWrapper}",
                        ]]);
                        ?>
                        <div class="small-12 medium-12 large-8 large-centered columns ban-box">
                            <div class="form-wrapper animated fadeInUp">
                                <div class="row">
                                    <div class="small-12 medium-6 large-6 columns">
                                        <p class="form-title">Enter your details below:</p>
                                    </div>
                                </div>
                                <form id="SignupForm" name="SignupForm" data-name="SIGN-UP">
                                    <div class="row collapse prefix-radius">
                                        <div class="small-12 medium-1 large-1 columns">
                                            <span class="prefix"><i class="icon icon-first-name"></i></span>
                                        </div>
                                        <div class="small-12 medium-5 large-5 columns input-left">
                                          <?= $form->field($model, 'first_name')->textInput(['autofocus' => 'autofocus', 'placeholder' => "First Name"])->label(false) ?>
                                        </div>
                                        <div class="small-12 medium-5 large-5 columns input-right">
                                          <?= $form->field($model, 'last_name')->textInput(['placeholder' => "Last Name"])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="row collapse prefix-radius">
                                        <div class="small-12 medium-1 large-1 columns">
                                            <span class="prefix"><i class="icon icon-email"></i></span>
                                        </div>
                                        <div class="small-12 medium-11 large-11 columns">
                                            <?=
                                            $form->field($model, 'email')->textInput(['placeholder' => "Enter Email Address",
                                                'options' => [
                                                    'tag' => false,
                                                ],
                                            ])->label(false)
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row collapse prefix-radius">
                                        <div class="small-12 medium-1 large-1 columns">
                                            <span class="prefix"><i class="icon icon-password"></i></span>
                                        </div>
                                        <div class="small-12 medium-5 large-5 columns input-left">
                                          <?= $form->field($model, 'password')->passwordInput([ 'placeholder' => "Password", 'id' => 'Pass'])->label(false) ?>
                                        </div>
                                        <div class="small-12 medium-5 large-5 columns input-right">
                                          <?= $form->field($model, 'retype_password')->passwordInput([ 'placeholder' => "Retype Password"])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="large-12 small-12 medium-12 columns text-left capcha">
                                         <?php  if (isset($show_captcha) && $show_captcha) : ?>
                                        <?=
                                                $form->field($model, 'captcha')
                                                ->widget(
                                                        \himiklab\yii2\recaptcha\ReCaptcha::className(), ['siteKey' => Yii::$app->params['reCaptcha']['siteKey']]
                                                )->label(false)
                                        ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="large-12 small-12 medium-12 columns agree-section">
                                        <p>By signing up, you agree to 
                                            <a href="<?= Yii::$app->params['siteUrl'] ?>/help/terms-of-use" target="_blank">Terms of Use</a>
                                        </p>
                                    </div>
                                    <div class="small-12 medium-6 large-6 columns noPadding">
                                        <?= Html::submitButton('Create Account', ['class' => 'button default-btn expend', 'name' => 'signup-button']) ?>
                                    </div>
                                    <div class="small-12 medium-6 large-6 columns noPadding">
                                      <?= Html::a('SIGN IN', Url::to(['/site/login']), ['class' => 'button secondary default-btn expend', 'name' => 'signin-button']) ?>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="large-12 medium-12 small-12 columns strike">
                                        <span>Or Sign Up Using</span>
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
                                                <li>
                                                    <a href="<?= Yii::$app->request->hostInfo ?>/site/auth?authclient=box" class="button default-btn social-btn box">
                                                        <i class="icon icon-box"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
<?php AuthChoice::end(); ?>
                                </div>
                            </div>
                        </div>
<?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript"  src="<?= Url::to("/js/mxd.app.js") ?>"></script>
        <script>
        /* Replace 'APP_ID' with your app ID */
        window.intercomSettings = {
        app_id: '<?= Yii::$app->params['intercom']['app_id'] ?>'
        };
        /* Repace 'APP_ID' with your app ID */
        (function () {
        var w = window;
        var ic = w.Intercom;
        if (typeof ic === "function") {
            ic('reattach_activator');
            ic('update', intercomSettings);
        } else {
            var d = document;
            var i = function () {
                i.c(arguments)
            };
            i.q = [];
            i.c = function (args) {
                i.q.push(args)
            };
            w.Intercom = i;
            function l() {
                var s = d.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = 'https://widget.intercom.io/widget/<?= Yii::$app->params['intercom']['app_id'] ?>';
                var x = d.getElementsByTagName('script')   [0];
                x.parentNode.insertBefore(s, x);
            }
            if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
        })();
        window.appUrl = "<?= Yii::$app->request->hostInfo ?>";
        </script>

<?php $this->endBody() ?>

</html>
<?php $this->endPage() ?>
