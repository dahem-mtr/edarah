# tables

#### working with crud table 

## Minimum example

```php
use App\Helpers\TableOptions; // import TableOptions class 

public function index() {

            $auth = Auth::user();
        if (!$auth->isAuthorizedTo('User', 'browse')) {
            return redirect()->route('admin.index');
           }


        $users = User::query();
        // pass query to TableOptions 
        $table = new TableOptions($users);
        
        // start with your table  options
        $table->displayName = "users";
        $table->columns = [
            [
                'name' => 'id', 
                'displayName' =>'user id',
                'component' => 'Text',
                'payload' => fn($row) => $row->id,
            ],
             [
                'name' => 'name', 
                'displayName' => 'user name',
                'component' => 'Text',
                'payload' => fn($row) => $row->name,
            ],
            [
                'name' => 'name', 
                'displayName' => 'user email',
                'component' => 'Text',
                'payload' => fn($row) => $row->email,
            ],
        ];
        
        $table->orderBy = ['id', 'latest']; 
        
        // now pass your column names to ui
        $table->uiStructure => [
                [
                    ['id','name', 'email'],
                ]
            ]
        return $table->handle();
    
    }
```
