<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name')->nullable();
            $table->string('slug')->nullable();
            $table->string('accredition')->nullable();
            $table->text('short_detail')->nullable();
            $table->longText('long_detail')->nullable();
            $table->text('certification')->nullable();
            $table->string('course_duration')->nullable();
            $table->longText('reviews')->nullable();
            $table->string('language')->nullable();
            $table->float('price')->nullable();
            $table->string('featured_img')->nullable();
            $table->string('featured_video')->nullable();
            $table->string('is_featured')->default('no');
            $table->foreignId('cat_id')->constrained('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
