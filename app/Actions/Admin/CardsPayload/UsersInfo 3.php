<?php

namespace App\Actions\Admin\CardsPayload;

use App\Models\User;
use Auth;

class UsersInfo
{

    public static function payload($user)
    {
        $auth = Auth::user();
        if (!$user) {
            return [
                'cardTitle' => $user->name,
                'msg' => 'no data found',
            ];
        }

        return [
            'cardTitle' => 'account',
            'authPermissions' => $auth->permissionsOn('User'),
            'items' => [
                [
                    'key' => 'user-name',
                    'displayName' => __('admin/user.user-name'),
                    'component' => ['Text'],
                    'payload' => $user->name,
                    'options' => [
                        'minWidth' => 70,
                        'onlyWhenAuthCan' => 'browse',
                    ],
                ],
                [
                    'key' => 'user-email',
                    'displayName' => __('admin/user.email-address'),
                    'component' => 'Text',
                    'payload' => $user->email,
                ],
                [
                    'key' => 'created-at',
                    'displayName' => __('admin/user.date-registration'),
                    'component' => ['Text'],
                    'payload' => $user->created_at->format('d/m/Y'),
                    'options' => [
                        'minWidth' => 70,
                        'pushToEnd' => true,
                    ],
                ],

            ],
            'actions' => [
                [
                    'title' => ['<i class="bi bi-folder-minus"></i> نقل ','text-danger'],
                    'onlyWhenAuthCan' => 'delete',
                    'route' => route('admin.index'),
                    'withConfirm'=> [
                        'msg' => 'are you Shore ?', // (required)
                        'buttonClass' => 'btn-info text-white' // button Confirm class (optional) default is class btn-danger text-white
                    ],
                ],
                [
                    'title' => ['<i class="bi bi-folder-minus"></i> حذف ', 'text-info'],
                    'url' => 'https://laravel.com'

                ],
            ],
            'structure' => [
                [
                    ['user-name','user-email', 'created-at'],
                ],
            ],
        ];
    }
}
