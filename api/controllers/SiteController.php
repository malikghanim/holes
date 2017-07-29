<?php

namespace api\controllers;

use Yii;
//use common\models\Apps;
use common\models\LoginForm;
use common\models\User;
use common\models\SignupForm;
//use frontend\models\PasswordResetRequestForm;
//use frontend\models\ResetPasswordForm;
//use frontend\config;
//use common\models\UserGroup;


class SiteController extends \yii\rest\ActiveController {

	public $modelClass = 'common\models\User';
	public $layout = 'auth';
	
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
			'auth' => [
				'class' => 'yii\authclient\AuthAction',
				'successCallback' => [$this, 'oAuth2Callback'],
			],
		];
	}

	public function afterAction($action, $result){
        $afterAction = parent::afterAction($action, $result);
        return $afterAction;
    }

	public function actionIndex() {
		return [
			'message' => 'Welcome to Maqtoo3 Api',
			'status' => 'Up & Running...'
		];
	}

	/**
	 * @return mixed
	 */
	public function actionAuthorize() {
		if (Yii::$app->getUser()->isGuest) {
			return $this->redirect('/site/login?ref=' . urlencode(Yii::$app->request->absoluteUrl));
		}

		if (Yii::$app->request->isPost) {
			$user = Yii::$app->user->identity;
			/**
			 * @var $module \filsh\yii2\oauth2server\Module
			 */

            $module = Yii::$app->getModule('oauth2')->getServer();
            try {
                $response = $module->handleAuthorizeRequest(
                    \OAuth2\Request::createFromGlobals(), // builds the request.
                    new \OAuth2\Response(), // new response instance.
                    filter_var(Yii::$app->request->post('authorized'), FILTER_VALIDATE_BOOLEAN), // user's decision to grant access (boolean).
                    (string) $user->id // User id.
                );    
            } catch (\Exception $e) {
                return ['status_code' => 400, 'message' => 'Unable to connect redis!'];
            }
			

			if (($statusCode = $response->getStatusCode()) != 302) {
				Yii::$app->response->setStatusCode($statusCode);
				return ['status_code' => $response->getStatusCode(), 'message' => $response->getParameters()];
			}
			return $this->redirect($response->getHttpHeaders()['Location']);
		} else {
			$client_id = Yii::$app->request->get('client_id', '');
			
			$app = (object)[
                'id' => '58f877dad13f4a398c3b13e6',
                'name' => 'TestMe',
                'description' => 'TestME',
                'user_id' => Yii::$app->user->identity->id,
                'scope' => 'all',
                'redirect_url' => 'https://www.getpostman.com/oauth2/callback',
                'grant_type' => 'client_credentials',
                'contact_email' => 'malik@maqtoo3.com',
                'contact_phone' => '+962787773352',
                'contact_person' => 'malik',
                'website' => 'http://www.maqtoo3.com',
                'status' => '1',
                'client_id' => 'MzO87bfoPdBkyvgtqHrR',
                'client_secret' => 'ZQGo3Cd2sAcztwHqnFrR',
                'app_token' => '',
                'access_token' => '',
                'expiry' => ''
            ];
   //          var_dump($client_id);die;
   //          var_dump($app->client_id);die;

			// if ($app->client_id != $client_id)
			// 	throw new \yii\web\NotFoundHttpException();


            //$app = reset($app['data']);
            $redisApp = json_encode([
                'redirect_uri' => 'https://www.getpostman.com/oauth2/callback',
                'client_secret' => 'ZQGo3Cd2sAcztwHqnFrR',
                'user_id' => '586e1390520f1e632b8b833a'
            ]);
            //var_dump($redisApp);
            try {
            	Yii::$app->redis->set("oauth_clients:$client_id", $redisApp);
            	Yii::$app->redis->set("oauth_scopes:default:$client_id", '{"scope_key": "All"}');
            } catch (\Exception $e) {
            	//var_dump('failed redis'.$e);
            }
            

			try {
				Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_HTML;
			} catch (Exception $e) {
				var_dump('something else fucking my life!');
			}

			return $this->render('authorize', ['app' => $app]);
		}
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin() {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $captcha = Yii::$app->request->post('g-recaptcha-response', false);
        $model->captcha = $captcha;

        $cookies = Yii::$app->response->cookies;
        if (Yii::$app->request->get('ref', FALSE))
            $cookies->add(new \yii\web\Cookie([
                'name' => 'ref',
                'value' => Yii::$app->request->get('ref', FALSE),
            ]));

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->set('login_failure_count', 0);
            $cookies = Yii::$app->request->cookies;
            if ($ref = $cookies->getValue('ref', false))
                return $this->redirect($ref);
            else
                return $this->redirect('/');
        } else {
            $login_failure = intval(Yii::$app->session->get('login_failure_count')) + 1;
            // var_dump($login_failure); die;
            Yii::$app->session->set('login_failure_count', $login_failure);
            $show_captcha = $login_failure > 3;

            Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_HTML;
            return $this->render('login', [
                        'model' => $model,
                        'show_captcha' => $show_captcha,
            ]);
        }

        Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_HTML;

        return $this->render('authorize', ['app' => $app]);
    }

    /**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	

	public function actionSignup() {

		Yii::$app->getResponse()->format = \yii\web\Response::FORMAT_HTML;
        $model = new SignupForm();
        $cookies = Yii::$app->request->cookies;
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->user->login($user)) {
                	$cookies = Yii::$app->request->cookies;
                    if ($ref = $cookies->getValue('ref', false))
                        return $this->redirect($ref);
                    else
                        return $this->redirect('/');
                }
            }
        }
        $signup_failure = intval(Yii::$app->session->get('signup_failure_count')) + 1;
        Yii::$app->session->set('signup_failure_count', $signup_failure);
        $show_captcha = $signup_failure > 3;
        return $this->render('signup', [
                    'model' => $model,
                    'show_captcha' => $show_captcha,
        ]);
    }

    public function actionLogout() {
		Yii::$app->user->logout();
		return $this->redirect('/site/login');
	}

	public function oAuth2Callback($client)
	{
        //var_dump('dddd');die;
		$clientName = $client->getName();
		$userAttributes = $client->getUserAttributes();

		if ($clientName == 'google') {
			$params['username'] = $userAttributes['emails'][0]['value'];
			$params['email'] = $userAttributes['emails'][0]['value'];
			$params['first_name'] = $userAttributes['name']['givenName'];
			$params['last_name'] = $userAttributes['name']['familyName'];
			$params['id'] = $userAttributes['id'];
		} elseif ($clientName == 'facebook') {
			$parts = explode(' ', $userAttributes['name']);
			$params['last_name'] = end($parts);
			$params['first_name'] = implode(' ', array_slice($parts, 0, count($parts)-1));
			$params['email'] = $userAttributes['email'];
			$params['username'] = $userAttributes['email'];
			$params['id'] = $userAttributes['id'];
		} else {
			throw new \yii\web\HttpException(401,'Client not recognised');
		}


		$id_field = $clientName.'_id';
		$user = User::findOne(['username' => $params['email']]);
        if($user) {

			$user->{$id_field} = $params['id'];
			
			if(!$user->save()) {
				throw new yii\web\BadRequestHttpException("We couldn't sign you in.");
			}


		} else {
			$user  = new User();
			$user->username = $params['username'];
			$user->email = $params['email'];
			$user->first_name = $params['first_name'];
			$user->last_name = $params['last_name'];
			$user->setPassword("temp_password_for_reset");
			$user->is_system_password = true;
			$user->generateAuthKey();
			$user->{$id_field} = $params['id'];
			if(!$user->save()) {
				throw new \yii\web\BadRequestHttpException("We couldn't sign you in.");
			}
		}


		if(Yii::$app->user->login($user, 3600 * 24 * 30)) {
			$cookies = Yii::$app->request->cookies;
			if ($ref = $cookies->getValue('ref')){
				return $this->redirect($ref);
			}
			else
				return $this->goBack();
		}else{
			throw new \yii\web\BadRequestHttpException("Something Wrong happaned, please try again.");
		}
	}

}
