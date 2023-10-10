<?php

namespace App\Actions\Admin\FormsPayload;

use App\Models\User;

class CreateUser
{

    public static function payload()
    {

        $user = User::find(25);

        $fields = [
            [
                'displayName' => 'user name', // (required)
                'name' => 'name', // (required)
                'component' => 'TextInput',
                'value' => 'sami', // (optional) : default value
                'placeholder' => 'your name', //  (optional)
                // 'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                'note' => '', // (optional) : Write a specific note under the field
            ],
            [
                'displayName' => 'user email', // (required)
                'name' => 'email', // (required)
                'component' => 'TextInput',
                'type' => 'email', // (required)

            ],
            [
                'displayName' => '<i class="bi
                bi-trash3-fill"></i> user address', // (required)
                'name' => 'address', // (required)
                'component' => 'TextInput',

            ],
            [
                'displayName' => 'user avatar',
                'name' => 'avatar',
                'component' => 'FileUpload',
                'fileType' => 'image',
                'oldImage' => $user->profile->avatar ??
                [
                    'name' => $user->profile->avatar->name,
                    'type' => $user->profile->avatar->type,
                    'path' => $user->profile->avatar->path,
                ],
                'imageDisplaySize'=> [200,200],
                'placeholder' => 'your name', //  (optional)
                'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                'note' => '', // (optional) : Write a specific note under the field
            ],

        ];

        $form = [
            'title' => 'new user',
            'headerLayout' => false, // (optional) default is true
            'fields' => $fields,
            'submit'=> [ 
                'title' => ['send','btn-success'], // form button title
                // if you want change button class you make it as array example : 
                //  'title' => ['send','btn-danger'] bootstrab btns class (default is btn-primary )
                'type' => 'post', // type  ( post, put, patch , delete)
                'action' => route('admin.users.store'), // form action url
            ],
            'structure' => [ // pass fields name with botstrab col like : col-md-6
                ['name' => '4', 'email' => '4', 'address' => '4'], // maxum is 12
                ['avatar' => '4'],
            ],

        ];

        return $form;

    }
}
