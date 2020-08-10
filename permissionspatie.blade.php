@php
Route::get('coba', function () {
    $role = Role::with('permissions')->get();
    $permission = Permission::all();
    return view('coba',compact('role','permission'));
});

Route::post('post', function (Request $req) {
   $role = Role::all();
   foreach ($role as  $item) {
     $item->syncPermissions();
   }
   if ($req->data) {
     foreach ($req->data as $key => $value) {
     Role::where('name',$key)->with('permissions')->first()->syncPermissions($value);
   }
   }
  
   return redirect()->back();
})->name('post');    
@endphp

<html>
     <table class='table table-bordered'>
        <thead>
            <tr>
                <th></th>
                @foreach ($role as $item)
                <th>{{$item->name}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <form action="{{ route('post') }}" method="POST">
                @csrf
                 @foreach ($permission as $item)
            <tr>
                <td>{{$item->name}}</td>
                @foreach ($role as $a)
            <td>
            <input type="checkbox" name="data[{{$a->name}}][]" value="{{$item->name}}"  {{in_array($item->name , $a->permissions->pluck('name')->toArray()) ? 'checked' : null }}>
               </td>
                @endforeach
            </tr>
            @endforeach
            <button type="submit">Submit</button>
            </form>
           
        </tbody>
    </table>
</html>