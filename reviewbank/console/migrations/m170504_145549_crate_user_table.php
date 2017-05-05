<?php

use yii\db\Migration;

class m170504_145549_crate_user_table extends Migration
{
    public function up()
    {
        $this->execute("CREATE SCHEMA \"user\";");
        $this->execute("CREATE TABLE \"user\".user
                        (
                            id serial NOT NULL,
                            nickname character varying(50),
                            email character varying(355) NOT NULL,
                            password character varying NOT NULL,
                            photo character varying(100),
                            created_at timestamp with time zone NOT NULL DEFAULT now(),
                            last_login timestamp without time zone,
                            role character varying,
                            status integer,
                            updated_at timestamp with time zone DEFAULT now(),
                            auth_key character varying,
                            CONSTRAINT user_pkey PRIMARY KEY (id),
                            CONSTRAINT user_email_key UNIQUE (email)
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        
        $this->execute("CREATE TABLE \"user\".comment
                        (
                            id integer NOT NULL,
                            user_id integer,
                            body text,
                            created_at timestamp without time zone DEFAULT now(),
                            CONSTRAINT comment_pkey PRIMARY KEY (id),
                            CONSTRAINT comment_user_id_fkey FOREIGN KEY (user_id)
                              REFERENCES \"user\".user (id) MATCH SIMPLE
                              ON UPDATE NO ACTION ON DELETE NO ACTION
                        )
                        WITH (
                          OIDS=FALSE
                        );");
        
    }

    public function down()
    {
        $this->execute("DROP SCHEMA \"user\" CASCADE;");
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
