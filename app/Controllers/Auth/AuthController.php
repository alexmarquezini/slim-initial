<?php 

namespace SlimInitial\Controllers\Auth;

use SlimInitial\Controllers\BaseController;
use SlimInitial\Handlers\UserWasCreated;
use SlimInitial\Models\User;
use Respect\Validation\Validator as v;

class AuthController extends BaseController
{
    public function getLogin()
    {
        return $this->render('auth/login.twig');
    }

    public function postLogin()
    {
        $this->validator->validate(
            $this->request,
            [
                'email' => v::noWhitespace()->notEmpty(),
                'password' => v::noWhitespace()->notEmpty()
            ]
        );

        if ($this->auth->attempt($this->request->getParam('email'), $this->request->getParam('password'))) {
            $this->flash->addMessage('success', 'Você está logado.');
            return $this->redirect('home');
        }

        $this->flash->addMessage('error', 'Não foi possível fazer login com esses detalhes.');
        return $this->redirect('auth.login');
    }

    public function getRegister()
    {
        return $this->render('auth/register.twig');
    }

    public function postRegister()
    {
        $this->validator->validate(
            $this->request,
            [
                'name' => v::noWhitespace()->notEmpty(),
                'email' => v::noWhitespace()->notEmpty()->email()->emailAvailable(),
                'password' => v::noWhitespace()->notEmpty(),
                'password_confirmation' => v::noWhitespace()->notEmpty()->matchesPassword($this->request->getParam('password'))
            ]
        );

        $user = User::create([
            'name' => $this->request->getParam('name'),
            'email' => $this->request->getParam('email'),
            'password' => password_hash($this->request->getParam('password'), PASSWORD_DEFAULT)
        ]);

        event(new UserWasCreated($user));

        $this->auth->attempt($user->email, $this->request->getParam('password'));

        $this->flash->addMessage('success', 'Sua conta foi criada e você está logado.');
        return $this->redirect('home');
    }

    public function getLogout()
    {
        $this->auth->logout();
        return $this->redirect('home');
    }
}