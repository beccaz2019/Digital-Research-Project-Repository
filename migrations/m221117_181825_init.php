<?php

use yii\db\Migration;

// yes|/Applications/XAMPP/xamppfiles/bin/php-7.4.29 yii migrate/fresh    # command to load it 

/**
 * Class m221117_181825_init
 */
class m221117_181825_init extends Migration
{
    /*
    public function safeUp()
    {
        $this->createTable("{{%creator}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string(30)->notNull(),
        ]);

        $this->createTable("{{%project}}", [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'creator_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_project_creator_id', "{{%project}}", 'creator_id', "{{%creator}}", 'id', 'CASCADE', "CASCADE"
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('FK_project_creator_id', "{{%project}}");
        $this->dropTable("{{%project}}");
        $this->dropTable("{{%creator}}");
    }
    */
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createDepartment();  //no dependencies
        $this->createDomain();
        $this->createCustomer();    
        $this->createDeveloper();
        $this->createUser();

        $this->createAdvisor();   //dependencies: department (FK)
        $this->createProject();  // advisor
        //$this->createTask();  //
        $this->createProject_advisor();
        $this->createProject_developer();
        
    }

    public function down()
    {
        echo "m221117_181825_init cannot be reverted.\n";

        return false;
    }

    private function createProject() {
        $tableName = "{{%project}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'description' => $this->string(500)->notNull(),
            'advisor_id' => $this->integer(),
            'is_remunerated' => $this->tinyInteger(),
            'domain' => $this->string(200)->notNull(),
            'department_id' => $this->integer(),

            
        ]);

        $this-> addForeignKey ( "FK_project_advisor", $tableName, "advisor_id", "{{%advisor}}", "id" );
        $this-> addForeignKey ( "FK_project_department", $tableName, "department_id", "{{%department}}", "id" );
            //FK

    }
    

    private function createDepartment() {
        $tableName = "{{%department}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'location' => $this->string(50)->notNull(),
            'icon' => $this->string(50),

        ]);
        try {
            // table name, column names, column values
            $db = Yii::$app->getDb();
            $db->createCommand()->batchInsert($tableName,
                ['id', 'name', 'location', 'icon',],
                [
                    
                    [1, "Allied Health", "Hickman Science Center","fa-medkit"],
                    [2, "Applied Technology", "Hickman Science Center","fa-desktop"],
                    [3, "Biology",   "Hickman Science Center","fa-pagelines"],
                    [4, "Business",   "Brock Hall","fa-briefcase"],
                    [5, "Chemistry",  "Hickman Science Center","fa-flask"],
                    [6, "Computer Science",   "Hickman Science Center","fa-laptop "],
                    [7, "Education", "Summerour Hall","fa-graduation-cap"],
                    [8, "English",  "Brock Hall","fa-pencil"],
                    [9, "Health and Kinesiology",   "Hulsey Wellness Center","fa-heartbeat"],
                    [10, "History And Political Studies",  "Brock Hall","fa-globe"],
                    [11, "Interdepartmental Programs",  "Hickman Science Center","fa-building "],
                    [12, "Interdisciplinary",  "Wright Hall","fa-connectdevelop"],
                    [13, "Journalism and Communication",  "Brock Hall","fa-newspaper-o"],
                    [14, "Mathematics",  "Hickman Science Center","fa-bar-chart"],
                    [15, "Modern Languages",  "Miller Hall","fa-language"],
                    [16, "Music",   "Wood Hall","fa-music"],
                    [17, "Non-degree Professional Programs",   "Wright Hall","fa-tasks"],
                    [18, "Nursing",   "Florida Hospital Hall","fa-user-md"],
                    [19, "Physical Therapist Assistant",   "PLZA","fa-wheelchair-alt"],
                    [20, "Physics and Engineering", "Hickman Science Center","fa-magnet"],
                    [21, "Psychology",  "Summerour Hall","fa-user"],
                    [22, "Religion",   "Hackman Hall","fa-book"],
                    [23, "Social Work",   "Daniells Hall","fa-handshake-o"],
                    [24, "Visual Art and Design", "Brock Hall","fa-paint-brush"],
                    

                ]
            )->execute();
            echo "Added default records for {$tableName}";
        } catch (Exception $exc) {
            // Do nothing
            echo "Unable to create default records for {$tableName}" . $exc->getMessage();
        }

    }
    private function createDomain() {
        $tableName = "{{%domain}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),

        ]);
    }

    private function createAdvisor() {
        $tableName = "{{%advisor}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(50)->notNull(),
            'last_name' => $this->string(50)->notNull(),
            'department_id' => $this->integer(), 
        ]);
          $this-> addForeignKey ( "FK_advisor_department", $tableName, "department_id", "{{%department}}", "id" );
   
          try {
            // table name, column names, column values
            $db = Yii::$app->getDb();
            $db->createCommand()->batchInsert($tableName,
                ['id', 'first_name', 'last_name', 'department_id'],
                [
                    [1, "Harvey", "Alferez", 1,],
                    [2, "Robert", "Ordonez",   1,],
                    [3, "Tron", "Wilder",   2,],
                //     [4, "News Feed", 1,],
                //     [5, "Banner",    1,],
                //     [6, "User Notes",1,],
                //     [7, "Carousel",  1,],//
                ]
            )->execute();
            echo "Added default records for {$tableName}";
        } catch (Exception $exc) {
            // Do nothing
            echo "Unable to create default records for {$tableName}" . $exc->getMessage();
        }
        }    

    private function createProject_advisor() {
        $tableName = "{{%project_advisor}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'advisor_id' => $this->integer(),
            'project_id' => $this->integer(),

        ]);
        $this-> addForeignKey ( "FK_project_advisor_advisor", $tableName, "advisor_id", "{{%advisor}}", "id" );
        $this-> addForeignKey ( "FK_project_advisor_project", $tableName, "project_id", "{{%project}}", "id" );
        
    }

    private function createCustomer() 
    {
        $tableName = "{{%customer}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'customer_name' => $this->string(100)->notNull(),

        ]);
    }

    private function createDeveloper() 
    {
        $tableName = "{{%developer}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'developer_name' => $this->string(100)->notNull(),

        ]);     
    }

    private function createProject_developer() 
    {
        $tableName = "{{%project_developer}}";

        $this->createTable($tableName, [
            'developer_id' => $this->integer(),
            'project_id' => $this->integer(),

        ]);
        $this-> addForeignKey ( "FK_project_developer_developer", $tableName, "developer_id", "{{%developer}}", "id" );
        $this-> addForeignKey ( "FK_project_developer_project", $tableName, "project_id", "{{%project}}", "id" );
        $this->addPrimaryKey("PK_project_developer_developer_id", $tableName, ["developer_id", "project_id"]);
    }

    private function createUser() {
        $tableName = "{{%user}}";

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(32),
            'password_reset_token' => $this->string(),
            'avatar' => $this->string(),
            'department_id' => $this->integer()->notNull(),

        ]);
        try {
            // table name, column names, column values
            $db = Yii::$app->getDb();
            $db->createCommand()->batchInsert($tableName,
                ['id', 'first_name', 'last_name', 'username','email', 'password_hash', 'auth_key', 'password_reset_token','avatar', 'department_id',],
                [
                    
                    [1, "System", "Administrator", "admin", "admin@example.com", '$2y$13$mw7.iL8/i.NfwSW2BBU1MOk.GJJDZtX7CPP6PaVYDqaE03QpiO6NC', "test100key", null, null, 6],
                    [2, "System", "Demo", "demo", "demo@example.com", "$2y$13$3mnh6giCIeTyGgL9nNei/uoXcjO5DJfX8rCV1r7fw.symtGnEoEnC", "TPrj9DOUVJYIMl60BvLIJy5OR1h-r6Uh", null, null, 6],
                    [3, "Rebecca", "Zaldivar", "rz2023", "rebeccazaldivar@southern.edu", '$2y$13$DMRB9BS1MAIqokpbvPa6s.OWC/a8IQ5ddM0IjTNFH333P8PAvfeTO', "G66XkGZvSoEcg8pVQKlGSvIhAYeHKRDM", null, null, 6],
    
                    /* 1  "$2y$13$mw7.iL8/i.NfwSW2BBU1MOk.GJJDZtX7CPP6PaVYDqaE03QpiO6NC"*/
                    /* 3  "$2y$13$DMRB9BS1MAIqokpbvPa6s.OWC/a8IQ5ddM0IjTNFH333P8PAvfeTO"*/

                ]
            )->execute();
            echo "Added default records for {$tableName}";
        } catch (Exception $exc) {
            // Do nothing
            echo "Unable to create default records for {$tableName}" . $exc->getMessage();
        }

    }
            
    


}