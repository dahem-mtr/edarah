# pages

we have page component as screen  in  ``` resources/vue/Admin/Pages/Page.vue ```

he want 

- page title 
- containers  ( Each container has  own payload) )

```php
        return Inertia::render('Page', [
        'title' => 'users', // title in browser  (Required) 
        'pageTitle' => 'users', // page title (optional)
        'containers' => [] // array Required
        ); 
```

## example



```php

use App\Actions\Admin\UsersInfoPayload; 


  public function index()
    {
        $auth = Auth::user();
        if (!$auth->isAuthorizedTo('User', 'browse')) {
            return redirect()->route('admin.index');
        }

        $usersInfoContainer = [
            'title' => 'users', // container title
            'container' => 'Card', // Card container in resources/vue/Admin/Containers/Shared/Card.vue
            'payload' => UsersInfoPayload::get(),
        ];

        $UsersListContainer = [
            'title' => 'users2',  // container title
            'container' => 'List',  // List container in resources/vue/Admin/Containers/Shared/List.vue
            'payload' => route('admin.users.index'),
        ];
        
        return Inertia::render('Page', [
            'title' => 'users',
            'containers' => [$usersInfoContainer,$UsersListContainer]
        ]);

    }
    
```


### * There are shared containers that help you create your page faster

in ```resources/vue/Admin/Containers/Shared```
- Card.vue 
- List,vue 

#### If you have a page that needs a special container
you can pass that container with key ``` 'asyncContainer' ```

```php 
 $UsersListContainer = [
            'title' => 'container title',
            'asyncContainer' => 'SomeContainer', // or 'SomeFolder/SomeContainer'
            'payload' => [], // your Container payload
        ];
```
 
### * Make sure that container in ``` resources/vue/Admin/Containers ```
read about [vujs defineAsyncComponent](https://vuejs.org/guide/components/async.html)

example :
```vue
<!-- Containers/SomeContainer.vue  -->
<template>
    <!-- contaner  -->
</template>

<script>
    export default {
    props: {
    payload: Array, // payload type
},
}
</script>

```

#### Page with tabs
you can do it like this :

```php
  public function index()
    {
      
        $text1Container = [
            'title' => 'text example',
            'container' => 'Text',
            'payload' =>  'some text 1',
        ];

        $text2Container = [
            'title' => 'text example',
            'container' => 'Text',
            'payload' => 'some text 2',
        ];

        $tabs = [
            [
                'title' => 'tab 1',
                'containers' => [$text1Container]
            ],
            [
                'title' => 'tab 2',
                'containers' => [$text2Container]
            ]
        ];

        return Inertia::render('Page', [
            'title' => __('Page with tabs example'),
            'tabs' => $tabs,
        ]);

    }
```
