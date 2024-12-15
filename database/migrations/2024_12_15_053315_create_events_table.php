<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration  
{  
    public function up()  
    {  
        Schema::create('event', function (Blueprint $table) {  
            $table->id();  
            $table->string('event_name'); 
            $table->text('event_description');         
            $table->dateTime('event_start_date');      
            $table->dateTime('event_end_date');        
            $table->string('location');                 
            $table->string('banner_photo')->nullable();
            $table->string('layout_photo')->nullable();
            $table->string('status_event');
            $table->timestamps();                       
        });  
    }  

    public function down()  
    {  
        Schema::dropIfExists('events');  
    }  
}