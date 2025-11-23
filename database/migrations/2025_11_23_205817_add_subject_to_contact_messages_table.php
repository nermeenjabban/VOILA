<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectToContactMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('subject')->after('email')->nullable();
        });
    }

    public function down()
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn('subject');
        });
    }
}