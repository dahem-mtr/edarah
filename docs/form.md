# Form container

we have form container in  ``` resources/vue/Admin/Containers/Shared/Form.vue```
help you to desplay your from 

## content

- [minimum usage](#minimum-usage) 
- [form structure](#form-structure) 
- [fields](#fields) 
   - [text input](#text-input) 
   - [select](#select) 
   - [radio](#radio) 
   - [checkbox](#checkbox) 
   - [switch](#switch) 
   - [file upload](#file-upload) 


## Minimum usage
first create action in ``` App/Actions/Admin/FormsPayload ``` for example ``` CreateUser.php ``` \
then import CreateUser.php in  controller for example

```php
//UserController.php
 use App\Actions\Admin\FormsPayload\CreateUser; // import CreateUser action 
  
 public function create()
    {
        
        $formContainer = [
            'title' => '', // (optional) container title
            'container' => 'Form', // Form component in resources/vue/Admin/Containers/Shared/Form.vue
            'payload' => CreateUser::payload(),// payload of Form container
        ];
        
        return Inertia::render('Page', [
            'title' => 'create new user', // page title
            'containers' => [$formContainer],

        ]);
    }
     
```

in CreateUser action rutern form payload

``` php 
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
                'component' => 'TextInput' // in resources/vue/Admin/Components/Fields/Shared/TextInput.vue
            ],
            [
                'displayName' => 'user email',
                'name' => 'email',
                'component' => 'TextInput',
                'type' => 'email' //  (optional) default is text
            ],
         
        ];

        $form = [
            'title' =>'new user',
            'headerLayout' => false, // (optional) default is true
            'fields' => $fields,
            'submit'=> [ 
                'title' => 'send', // form button title
                // if you want change button class make it as array example : 
                //  'title' => ['send','btn-danger'] bootstrab btns class (default is btn-primary )
                'type' => 'post', // type  ( post, put, patch , delete)
                'action' => route('admin.users.store'), // form action url
            ],
            'structure' => [ 
            // pass fields name with botstrab col like : col-md-6
                ['name' => '6','email' => '6'], //  first row ( maxium row total cols is 12 )
                
            ],

        ];

        return $form ;

    }
}
 
```

now in controller Validate the data from the input and entered

```php
//UserController.php

    public function store(Request $request)
    {

        $dataValidated = $this->validate($request, [
            'name' => 'required|min:6',
            'email' => 'required|unique:users',            
        ]);

          $dataValidated['password'] = Hash::make(Str::random(8));
           User::create($dataValidated);


           return redirect()->back()->with('success', 'user created ');


    } 
```
When the user enters wrong data automatically, it will be redirected to the form and display error messages under each wrong entry

now see output in ``` http://127.0.0.1:8000/admin/users/create ```

## form structure
You can control how the form structure is
```php
 'structure' => [ 
            // pass ( fields name ) with botstrab col like : col-md-6
                ['name' => '6','email' => '6'], //  first row ( maxium row total cols is 12 )
                ['role' => '6'], //  secend row
                ['phone' => '4','father-name' => '4','your-best-name' => '4'] //  third row
      
            ],
```

## fields
fields 

### text input

```php
           [
                'displayName' => 'user name', 
                'name' => 'name', // (required) 
                'component' => 'TextInput', // (required) in resources/vue/Admin/Components/Fields/Shared/TextInput.vue
                'type' => '', //  (optional) default is text
                'value' => '', // (optional) : default value 
                'placeholder' => 'your name', //  (optional)
                'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                'note' => '' // (optional) : Write a specific note under the field
            ] 
```
### select

```php
           [
                'displayName' => "user role", 
                'name' => 'role', // (required)
                'component' => 'Select', // (required) in  ... /Components/Fields/Shared/Select.vue
                'options' => [  // (required) : select options
                    ['displayName' => 'normal user', 'value' => 'user'],
                    ['displayName' => 'assistant manager', 'value' => 'assistant-manager'],
                    ['displayName' => 'manager', 'value' => 'manager'],
                ],
                // 'value' => 'user', // (optional) : default value selected of this field options
               // 'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
               // 'note' => '' // (optional) : Write a specific note under the field
            ]  
```
If the user does not choose any of the options 
```php
         $request->role
        // null
```
### radio

```php
           [
                'displayName' => "user status",
                'name' => 'user_status', // (required)
                'component' => 'Radio', // (required) in  ... /Components/Fields/Shared/Radio.vue
                'isInline'=> true, // (optional) : horizontaly radios button , default is vertically
                'options' => [  // (required) : radio options
                    ['displayName' => 'married', 'value' => 'married'],
                    ['displayName' => 'single', 'value' => 'single'],
                ],
                // 'value' => 'single', // (optional) : default value checked of this field options
                // 'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                // 'note' => '' // (optional) : Write a specific note under the field
            ],
```
also If the user does not choose any of the options 
```php
         $request->user_status
        // null
```

### checkbox

```php
       [
                'displayName' => "user skills", 
                'name' => 'skills', // (required)
                'component' => 'Checkbox', // (required) in  ... /Components/Fields/Shared/Checkbox.vue
                'isInline'=> true, // (optional) : horizontaly checkboxs , default is vertically
                'options' => [  // (required) : checkbox options
                    ['displayName' => 'php', 'value' => 'php'],
                    ['displayName' => 'react', 'value' => 'react'],
                    ['displayName' => 'vuejs', 'value' => 'vuejs'],
                ],
                'value' => ['vuejs','php'], // array (optional) : default values checked of this field options
                'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                // 'note' => '' // (optional) : Write a specific note under the field
            ]        
```
also If the user does not choose any of the options 
```php
         $request->skills
        // null
```
### switch
It's like a [checkbox](#checkbox) , it doesn't differ from it in the way it works, just change its component ``` Checkbox ``` with ```Switch```
```php
     'component' => 'Switch'
```

### file upload

### image

```php
    [
                'displayName' => 'user avatar',
                'name' => 'avatar', // (required)
                'component' => 'FileUpload', // (required) in  ... /Components/Fields/Shared/FileUpload.vue
                'fileType' => 'image', // (required) 
                'oldImage' => $user->profile->avatar ?? //  (optional) :  If you want to display the old image and 
                replace it when the user chooses another image
                [
                    'name' => $user->profile->avatar->name, // file name example : car.png
                    'type' => $user->profile->avatar->type, // file type example : image/png
                    'path' => $user->profile->avatar->path, // users/avatar
                ],
                'imageDisplaySize'=> [200,200], // (optional) first is height secend is width ( default is height 100% width is auto )
                'placeholder' => '', //  (optional)
                'withRequiredMark' => true, //  (optional) :  display required mark (*) after field displayName
                'note' => '', // (optional) : Write a specific note under the field
            ],
```

example use in request :
```php
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
```

