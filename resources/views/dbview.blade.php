@php
   $rows = \DB::select('select * from users');
foreach ($rows as $row) {
    var_dump($row->field);
} 
@endphp

