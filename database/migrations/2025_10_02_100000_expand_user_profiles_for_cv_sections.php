<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->text('education')->nullable()->after('cv');
            $table->text('experience')->nullable()->after('education');
            $table->text('skills')->nullable()->after('experience');
            $table->text('references')->nullable()->after('skills');
        });
    }
    public function down()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn(['education', 'experience', 'skills', 'references']);
        });
    }
};
