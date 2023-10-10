<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, Role, Permission};
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Helpers\TableOptions;
use App\Actions\Admin\UsersInfoPayload;

class UserController extends Controller
{

    public function getItems()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        if (!$auth->isAuthorizedTo('User', 'browse')) {
            return redirect()->route('admin.index');
        }

        $usersInfoSection = [
//            'title' => 'users',
            'component' => 'CustomUiCard',
            'payload' => UsersInfoPayload::get(),
        ];

        $listUserSection = [
            'component' => 'sdf',
            'payload' => [
                'listRoute' => route('admin.users.index')
            ],
        ];


        return Inertia::render('Admin/Page', ['pageSections' => [$usersInfoSection]]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}




//$auth = Auth::user();
//
//$table = new TableOptions(User::class);
//$table->displayName = "Users";
//$table->query = fn($query) => $query->with('role');
//$table->columns = [
//    [
//        'name' => 'role',
//        'displayName' => __('dash/user.id'),
//        'value' => fn($row) => $row->role->name ??  'user',
//        'type' => 'text',
//    ],
//];
//$table->orderBy = ['id','latest'];
//$table->authPermissions = $auth->permissionsOn('User') ;
//$table->searchable = ['id','name'] ;
//$table->sortable = ['id','name'] ;
//
//$table->handle();




