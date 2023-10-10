<?php

namespace App\Actions\Admin\CardsPayload;


class UsersInfo
{

    public static function payload($user)
    {
        

        $items = [
            [
                'key' => 'user-id',
                'displayName' => 'name',
                'component' => 'Text',
                'payload' => $user->name, 
                
            ],
            [
                'key' => 'user-name',
                'displayName' => 'email',
                'component' =>'Text',
                'payload' => $user->email, 
                'options' => [ // (optional)
                    'pushToEnd' => true,
                ],
            ],
        ];

        $card =  [
            'cardTitle' => 'account',
            'items' => $items,
            'actions' => [
                // actions
                [
                    'title' => [' <i class="bi bi-trash3-fill"></i> delete ','text-danger'], 
                    'route' => route('admin.users.destroy', $user->id ), 
                    'type' => 'delete', // default is get
                    'withConfirm'=> [
                        'msg' => 'are you shore for delete '.$user->name.'?', // msg (required)
                        'buttonClass' => 'btn-danger text-white' // button Confirm class (optional) default is class btn-danger text-white
                    ],
                ],
                

            ],
            'structure' => [ // items keys
                  
                    ['user-id','user-name'],
                    
            ],
        ];

        return $card ;
    }
}