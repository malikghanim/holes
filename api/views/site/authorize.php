<?php
  use yii\widgets\ActiveForm;
  use yii\helpers\Html;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maqtoo3</title>
    <link rel="stylesheet" type="text/css" href="/css/authorize.css">
    
  </head>
  <body>
    <div class="off-canvas-wrap" data-offcanvas>
      <div class="inner-wrap">
        <div class="small-12 medium-12 large-12 columns nav fixed">
          <div class="separator gradient"></div>
          <div class="row">
            <div class="small-12 medium-12 large-12 logo default-float">
              <a href="javascript:void(0)">
                <?= Html::img(Yii::getAlias('@front').'/images/App_image.png', ['alt'=>'logo', 'style' => 'margin-top:20px ;']);?>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="small-12 medium-12 large-12 default-float">
      <div class="small-12 medium-12 large-12 columns section static heda-title">
          <div class="row">
            <div class="small-12 medium-12 large-12 columns page-title text-center">
               <h1 class="auth-title">Allow to access you account</h1>
            </div>
          </div>
        </div>
        <div class="row auth-float">
          <div class="smnall-12 medium-6 large-6 columns">
              <div class="card">
                  <?= Html::img(Yii::getAlias('@front').'/images/App_image.png', ['alt'=>'Authorize Icon']);?>
              </div>
          </div>
          <div class="smnall-12 medium-6 large-6 columns">
            <div class="list-auth">
              <h3>This app will be able to:</h3>
              <ul>
                <p>Post to your account</p>
                <li>Access your account information.</li>
                <li>Access your models, make changes to them.</li>
              </ul>
              <p>-By clicking allow you agree to our <a href="https://Maqtoo3.com/help/terms-of-use" target="_blank">Terms of Use.</a></p>
              <div class="smnall-12 medium-12 large-12 text-right">
                <?php $form = ActiveForm::begin(['method' => 'POST']); ?>
                  <button type="submit" name="authorized" class="button secondary" value="false">deny</button>
                  <button type="submit" name="authorized" class="button" value="true">allow</button>
                <?php ActiveForm::end(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>