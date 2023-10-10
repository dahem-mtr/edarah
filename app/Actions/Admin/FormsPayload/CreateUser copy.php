<?php

namespace App\Actions\Admin\FormsPayload;


class CreateUser
{

    public static function payload()
    {
        $fields = [
            [
                'displayName' => 'user name',
                'name' => 'name',
                'component' => 'TextInput',
                'value' => 'sami',
                'placeholder' => 'your name',
                'withRequiredMark' => true,
            ],
            [
                'displayName' => 'user email',
                'name' => 'email',
                'component' => 'TextInput',
                'type' => 'email',
            ],
            [
                'displayName' => "car",
                'name' => 'car',
                'component' => 'Select',

                'options' => [
                    ['displayName' => 'camry', 'value' => 'camry'],
                    ['displayName' => 'elentra', 'value' => 'elentra'],
                ],
                'value' => 'camry',
            ]

            
            
        ];

        $form = [
            'title' =>'new user',
            'headerLayout' => false,
            'fields' => $fields,
            'action' => [route('admin.users.store'),'post'],
            'structure' => [
                ['name' => '6','email' => '6'],
                ['car' => '6'],
            ],

        ];

        return $form ;

    }
}