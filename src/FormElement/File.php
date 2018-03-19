<?php

declare(strict_types=1);

namespace Xtreamwayz\HTMLFormValidator\FormElement;

use Zend\InputFilter\FileInput;
use Zend\Validator\File\MimeType as MimeTypeValidator;

class File extends BaseFormElement
{
    public function getInputSpecification() : array
    {
        $spec = [
            'type'     => FileInput::class,
            'name'     => $this->getName(),
            'required' => $this->isRequired(),
        ];

        if ($this->node->hasAttribute('accept')) {
            $spec['validators'] = [
                [
                    'name'    => MimeTypeValidator::class,
                    'options' => [
                        'mimeType'          => $this->node->getAttribute('accept'),
                        'enableHeaderCheck' => true,
                    ],
                ],
            ];
        }

        return $spec;
    }
}
