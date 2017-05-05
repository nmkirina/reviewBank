<?php

use yii\db\Migration;

class m170504_152100_crate_post_schema_and_tables extends Migration
{
    public function up()
    {
        $this->execute("CREATE SCHEMA post;");
        $this->execute("CREATE TABLE post.theme
                        (
                          id serial NOT NULL,
                          name character varying(100),
                          description text,
                          CONSTRAINT theme_pkey PRIMARY KEY (id)
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        $this->execute("CREATE TABLE post.post
                        (
                          id serial NOT NULL,
                          user_id integer,
                          theme_id integer,
                          object_id integer,
                          title character varying(355),
                          body text,
                          created_on timestamp without time zone,
                          CONSTRAINT post_pkey PRIMARY KEY (id),
                          CONSTRAINT post_object_id_fkey FOREIGN KEY (object_id)
                              REFERENCES object.object (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION,
                          CONSTRAINT post_theme_id_fkey FOREIGN KEY (theme_id)
                              REFERENCES post.theme (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION,
                          CONSTRAINT post_user_id_fkey FOREIGN KEY (user_id)
                              REFERENCES \"user\".user (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        $this->execute("CREATE TABLE post.post_video
                        (
                          id serial NOT NULL,
                          post_id integer,
                          name character varying(200),
                          CONSTRAINT post_video_pkey PRIMARY KEY (id),
                          CONSTRAINT post_video_post_id_fkey FOREIGN KEY (post_id)
                              REFERENCES post.post (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        $this->execute("CREATE TABLE post.post_photo
                        (
                          id serial NOT NULL,
                          post_id integer,
                          name character varying(200),
                          CONSTRAINT post_photo_pkey PRIMARY KEY (id),
                          CONSTRAINT post_photo_post_id_fkey FOREIGN KEY (post_id)
                              REFERENCES post.post (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION
                        )
                        WITH (
                          OIDS=FALSE
                        );");
    }

    public function down()
    {
        $this->execute("DROP SCHEMA post CASCADE;");
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
