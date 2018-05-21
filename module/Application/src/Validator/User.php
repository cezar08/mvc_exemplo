<?php
/**
 * Created by PhpStorm.
 * User: unochapeco
 * Date: 07/05/18
 * Time: 19:16
 */

namespace Application\Validator;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class User extends InputFilter
{

    public function __construct()
    {
        $factory = new InputFactory();
        $this->add(
            $factory->createInput([
                'name' => 'id',
                'required' => false,
                'filters' => [
                    ['name' => 'Int']
                ]
            ])
        );
        $this->add(
            $factory->createInput([
                'name' => 'name',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min' => 3,
                            'max' => 100,
                        ]
                    ],
                ]
            ])
        );
        $this->add(
            $factory->createInput([
                'name' => 'email',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim']
                ],
                'validators' => [
                    [
                        'name' => 'EmailAddress',

                    ],
                ]
            ])
        );
    }

}