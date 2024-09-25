<?php 

namespace SlimInitial\Controllers\Auth;

use SlimInitial\Controllers\BaseController;
use Respect\Validation\Validator as v;

class PasswordController extends BaseController
{
    public function getForgot()
    {
        return $this->render('auth/password/forgot.twig');
    }

    public function postForgot()
    {
        $this->validator->validate(
            $this->request,
            [
                'email' => v::noWhitespace()->notEmpty()->email()
            ]
        );

        if($this->validator->fails()) {
            return $this->redirect('auth.password.forgot');
        }

        $this->flash->addMessage('info', 'Se o seu e-mail existir em nosso sistema, as instruções para redefinir a senha serão enviadas para você.');

        return $this->redirect('auth.password.forgot');
    }

    public function getReset($token)
    {
        return $this->render('auth/password/reset.twig', [
            'token' => $token
        ]);
    }

    public function postReset($token)
    {
        $this->validator->validate($this->request, [
            'password' => v::noWhitespace()->notEmpty(),
            'password_confirmation' => v::noWhitespace()->notEmpty()->matchesPassword($this->request->getParam('password'))
        ]);

        if($this->validator->fails()) {
            return $this->redirect('auth.password.reset', ['token' => $token]);
        }

        $this->flash->addMessage('info', 'Sua senha foi redefinida com sucesso.');

        return $this->redirect('auth.password.reset', ['token' => $token]);
    }
}