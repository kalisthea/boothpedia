<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothsTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('booths', function (Blueprint $table) {  
            $table->id();  
            $table->string('booth_name');
            $table->foreignId('category_id')->constrained('booth_categories');  
            $table->string('booth_price');
            $table->string('booth_desc');
            $table->char('is_occupied', 1);
            $table->timestamps();  
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('booths');  
    }  
} 
