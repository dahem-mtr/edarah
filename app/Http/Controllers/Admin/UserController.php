<?php

namespace App\Http\Controllers\admin;

use App\Actions\Admin\CardsPayload\UsersInfo;
use App\Actions\Admin\FormsPayload\CreateUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Str;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $user = User::find(1);

        if (!$auth->isAuthorizedTo('User', 'browse')) {
            return redirect()->route('admin.index');
        }

        $usersInfo = [
            'title' => 'users',
            'section' => 'Card',
            'payload' => UsersInfo::payload($user),
        ];
        $addUser = [
            'title' => 'العملاء',
            'asyncSection' => 'Mycontainer',
        ];

        $tabs = [
            [
                'title' => 'المستخدمين',
                'sections' => [$usersInfo],
            ],
            [
                'title' => ' الصلاحيات و الادوار',
                'sections' => [$addUser],
            ],
        ];

        return Inertia::render('Page', [
            'title' => __('admin/main.users'),
            'tabs' => $tabs,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $formContainer = [
            'title' => 'user profile ', // container title
            'section' => 'Form', // container component
            'payload' => CreateUser::payload(), // payload of Card container
        ];

        return Inertia::render('Page', [
            'title' => 'create new user',
            'sections' => [$formContainer],

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $dataValidated = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'avatar' => 'nullable|image|max:2048',

        ]);

        $dataValidated['password'] = Hash::make(Str::random(8));
        $user = User::create($dataValidated);
        $profile = $user->profile()->create([
            'address' => $request->address,
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $fileName = time() . '.' . $file->extension();
            $path = 'users/avatars';
            $file->move(public_path($path),$fileName);
            $profile->avatar()->create([
                'name' => $fileName,
                'path' => $path,
                'type' => $file->getClientMimeType(),
            ]);

        }

        return redirect()->back()->with('success', 'user created ');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usersInfo = [
            'title' => 'user profile ',
            'section' => 'Card',
            'payload' => UsersInfo::payload($user),
        ];

        return Inertia::render('Page', [
            'title' => $user->name,
            'sections' => [$usersInfo],

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
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
        dd($id);

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
