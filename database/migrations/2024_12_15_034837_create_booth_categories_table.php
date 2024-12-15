<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothCategoriesTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('booth_categories', function (Blueprint $table) {  
            $table->id();  
            $table->string('category_name');
            $table->timestamps();  
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('booth_categories');  
    }  
}
