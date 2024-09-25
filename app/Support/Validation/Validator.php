<?php 

namespace SlimInitial\Support\Validation;

use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator implements Contracts\ValidatorInterface
{

    protected $errors = [];

    public function validate(ServerRequestInterface $data, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try{
                $rule->setName(ucfirst($field))->assert($data->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }

        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }

}