<?php

class Create_Scrapeurls_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('scrapeurls', function($table)
        {
            $table->increments('id');
            $table->string('url');
            $table->string('title');
            $table->string('via');
            $table->string('domain');
            $table->string('thumb');
            $table->string('flash');
            $table->timestamps();
        });
    }

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
