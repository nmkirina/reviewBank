<?php

use yii\db\Migration;

class m170504_151703_crate_object_schema_and_tables extends Migration
{
    public function up()
    {
        $this->execute("CREATE SCHEMA object;");
        $this->execute("CREATE TABLE object.author
                        (
                          id serial NOT NULL,
                          name character varying(355),
                          range character varying(355),
                          wikilink character varying(355),
                          CONSTRAINT author_pkey PRIMARY KEY (id)
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        $this->execute("CREATE TABLE object.object
                        (
                          id serial NOT NULL,
                          author_id integer,
                          name character varying(355),
                          origin_name character varying(355),
                          year character varying(50),
                          wikilink character varying(355),
                          CONSTRAINT object_pkey PRIMARY KEY (id),
                          CONSTRAINT object_author_id_fkey FOREIGN KEY (author_id)
                              REFERENCES object.author (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION
                        )
                        WITH (
                          OIDS=FALSE
                        );");
    }

    public function down()
    {
        $this->execute("DROP SCHEMA object CASCADE;");
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
