<?php
/**
 * Created by PhpStorm.
 * User: Fede Marquesto
 * Date: 8/7/2017
 * Time: 14:10
 */

namespace App\Controller\Auth;

use App\Controller\Controller;
use App\Models\User;
use App\Util\SendMail;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Respect\Validation\Validator as v;

class AuthController extends Controller
{
    public function getSignUp($request, $response)
    {
        return $this->view->render($response,'auth/auth.twig');
    }

    public function postSignUp($request, $response)
    {

        $validation = $this->validator->validate($request,[
            'form-first-name'=>v::noWhitespace()->notEmpty(),
            'form-last-name'=> v::noWhitespace()->notEmpty(),
            'form-email' => v::noWhitespace()->notEmpty(),
            'form-password' => v::noWhitespace()->notEmpty(),
        ]);

        if($validation->failed()){
            return $response->withRedirect($this->router->pathFor('auth.signup'));
        }

        $userName = strtolower(substr($request->getParam('form-first-name'),0,1).$request->getParam('form-last-name'));

        $user = User::create([
            'username'=> $userName,
            'name' => $request->getParam('form-first-name'),
            'last_name' => $request->getParam('form-last-name'),
            'email'=>$request->getParam('form-email'),
            'password' => password_hash($request->getParam('form-password'), PASSWORD_DEFAULT),
        ]);

        $this->flash->addMessage('info', 'Solicitud enviada correctamente');

        //$this->auth->attempt($user->username,$request->getParam('form-password'));

        /*$mail = new Message;
        $mail->setFrom('John <fede.marquesto@gmail.com>')
            ->addTo('fede.marquesto@gmail.com')
            ->addTo('fede.marquesto@gmail.com')
            ->setSubject('Order Confirmation')
            ->setBody("Hello, Your order has been accepted.");

        $mailer = new SendmailMailer;
        $mailer->send($mail);*/

        SendMail::Send('asas');

        return $response->withRedirect($this->router->pathFor('auth.signin'));
    }

    public function getSignIn($request, $response)
    {
        return $this->view->render($response,'auth/auth.twig');
    }

    public function postSignIn($request, $response)
    {

        $auth = $this->auth->attempt(
            $request->getParam('form-username'),
            $request->getParam('form-password')
        );

        if(!$auth) {

            $this->flash->addMessage('error', 'Usuario o Contraseña inavalido');
            return $response->withRedirect($this->router->pathFor('auth.signin'));
        }

        return $response->withRedirect($this->router->pathFor('home'));
    }

    public function getSignOut($request, $response)
    {
        $this->auth->logout();
        return $response->withRedirect($this->router->pathFor('auth.signin'));

    }
}