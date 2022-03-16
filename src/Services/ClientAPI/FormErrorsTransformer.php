<?php
namespace App\Services\ClientAPI;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\ConstraintViolation;

class FormErrorsTransformer
{
public function transform(FormInterface $form): ResponseBody
    {
        $errors = [];
        foreach ($form->getErrors(true, true) as $error) {
            $cause = $error->getCause();
                $errors[] = new Error($cause, $this->buildPath($error->getOrigin()));

        }

        if ($form->isEmpty()) {
            $errors[] = new Error(Error::ERR_FORM_EMPTY);
        }

        return new ResponseBody(null, $errors);
    }

    private function buildPath(FormInterface $form): string
    {
        $pathParts = [];
        while ($form) {
            array_unshift($pathParts, $form->getName());
            $form = $form->getParent();
        }

        return ltrim(implode('.', $pathParts), '.');
    }

}
