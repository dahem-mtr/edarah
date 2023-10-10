## Roles and permissions

-   no one can access the admin panel unless they have at least one role
-   A user can have one or more roles
    Each role has specific permissions on Models
-   Any user with Manager role can control everything

    > ! first add actios in Model Class
    > example :

```php
class User extends Authenticatable
{
    public $actions = ['red', 'create', 'edit', 'delete','give-roles']; // ...
}
```

### Table Structure

#### users

    id
    name

#### roles

    id
    name

#### permissions

    id
    name
    model

#### permissions_role

    permissions_id
    role_id

#### role_user

    role_id
    user_id

### Instance Methods

| Method                                                  | Description                                                                |
| ------------------------------------------------------- | -------------------------------------------------------------------------- |
| [rolesAdd($roleId)](#roles-add)                         | Add roles to user                                                          |
| [rolesRemove($roleId)](#roles-remove)                   | Remove roles from the user                                                 |
| [permissionsAdd($permissionId)](#permissions-add)       | add permissions to role                                                    |
| [permissionsRemove($permissionId)](#permissions-remove) | remove permissions from the role                                           |
| [isAuthorizedTo($model,$permission)](#is-authorized-to) | Check if has permission on the Model according to the roles it has         |
| [hasRole($role)](#has-role)                             | check if has role                                                          |
| [permissionsOn($model)](#permissions-on)                | Get a list of user permissions on the Model according to the roles it has  |
| [permissionsOnModels($models)](#permissions-on-models)  | Get a list of user permissions on the Models according to the roles it has |

##### rolesAdd()

Add roles to user

```php
$auth = Auth::user();
// you can  pass one role (role Id)
$auth->rolesAdd(1);
// or array of roles ids
$auth->rolesAdd([7,2]);
```

##### rolesRemove()

Remove roles from the user

```php
$auth = Auth::user();
// you can  pass one role (role Id)
$auth->rolesRemove(1);
// or array of roles ids
$auth->rolesRemove([7,2]);
```

##### permissionsAdd()

add permissions to role

```php
$role = Role::find(2);
$role = Role::find(2);
// you can  pass one permission (permission Id)
 $role->permissionsAdd(1);
// or array of permission ids
 $role->permissionsAdd([1,2]);
```

##### permissionsRemove()

remove permissions from the role

```php
$role = Role::find(2);
// you can  pass one permission (permission Id)
$auth->permissionsRemove(1);
// or array of permission ids
$auth->permissionsRemove([7,2]);
```

##### isAuthorizedTo

check if has permission on the Model

```php
$auth = Auth::user();
// pass Model and permission
$auth->isAuthorizedTo('User','red');
// output : true or false
```

if user has role admin output always is : true

##### hasRole()

check if has role

```php
$auth = Auth::user();
// pass role
$auth->hasRole('manager');
// output : true or false
```

##### permissionsOn()

Get a list of user permissions on the Model according to the roles it has

```php
$auth = Auth::user();
// pass Model
$auth->permissionsOn('User');
// example output :
['red', 'delete','give-roles']
// If all user roles do not have permission on this Model
//  output : []
```

if user has role admin output always will be :

```php
// all permissions in Model
['red', 'create', 'edit', 'delete','give-roles', ...]
```

##### permissionsOnModels()

Get a list of user permissions on the Models according to the roles it has

```php
$auth = Auth::user();
// pass Models (array)
$auth->permissionsOnModels(['User','Order','Post']);
// example output :
['User' => ['red','give-roles'],
'Order' => ['red','order-accept','change-order-state'],
'Post' => ['edit']
];

// If all user roles do not have permission on this Models
//  output : []
```

if user has role admin output always will be :

```php
// all permissions in Models
['User' => ['red','give-roles','edit' , ...],
'Order' => ['red','order-accept','change-order-state', ...],
'Post' => ['edit','red','order-accept','change-order-state'. ...]
```
