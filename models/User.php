<?php
namespace app\models;
use Yii;
// namespace app\models;

// class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
// {
//     public $id;
//     public $username;
//     public $password;
//     public $authKey;
//     public $accessToken;

//     private static $users = [
//         '100' => [
//             'id' => '100',
//             'username' => 'admin',
//             'password' => 'admin',
//             'authKey' => 'test100key',
//             'accessToken' => '100-token',
//         ],
//         '101' => [
//             'id' => '101',
//             'username' => 'demo',
//             'password' => 'demo',
//             'authKey' => 'test101key',
//             'accessToken' => '101-token',
//         ],
//         '102' => [
//             'id' => '102',
//             'username' => 'compadmin',
//             'password' => 'cs12345',
//             'authKey' => 'test102key',
//             'accessToken' => '102-token',
//         ],
//         //see if to create a table in the database to be accessed through PHPMyadmin
//     ];


//     /**
//      * {@inheritdoc}
//      */
//     public static function findIdentity($id)
//     {
//         return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public static function findIdentityByAccessToken($token, $type = null)
//     {
//         foreach (self::$users as $user) {
//             if ($user['accessToken'] === $token) {
//                 return new static($user);
//             }
//         }

//         return null;
//     }


//     /**
//      * Finds user by username
//      *
//      * @param string $username
//      * @return static|null
//      */
//     public static function findByUsername($username)
//     {
//         foreach (self::$users as $user) {
//             if (strcasecmp($user['username'], $username) === 0) {
//                 return new static($user);
//             }
//         }

//         return null;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function getId()
//     {
//         return $this->id;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function getAuthKey()
//     {
//         return $this->authKey;
//     }

//     /**
//      * {@inheritdoc}
//      */
//     public function validateAuthKey($authKey)
//     {
//         return $this->authKey === $authKey;
//     }

//     /**
//      * Validates password
//      *
//      * @param string $password password to validate
//      * @return bool if password provided is valid for current user
//      */
//     public function validatePassword($password)
//     {
//         return $this->password === $password;
//     }
// }

?>

<?php
 
// namespace app\models;

 
use yii\db\ActiveRecord;
 
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    //--------------------------------------
    // Fields
    //--------------------------------------
    public $password = '';  // write-only (only used during record creation or update)
 
    //--------------------------------------
    // Methods
    //--------------------------------------
 
    public static function tableName() 
    { 
        return '{{%user}}';
    }
 
   /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
            [['username','password'], 'required'],
            [['email'], 'email'],
            [['username','email'], 'unique'],
            [['department_id'], 'integer'],
            [['username', 'password', 'password_hash', 'password_reset_token', 'first_name', 'last_name', 'email', 'avatar'], 'string', 'max' => 255],
        ];
    }
 
    public static function findIdentity($id) 
    {
        return static::findOne(['id' => $id]);    
    }
 
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) 
    {
        $user = self::find()->where(["accessToken" => $token])->one();
        if (empty($user)) {
            return null;
        }
        return new static($user);
    }
 
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }
 
    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username) 
    {
        return self::find()->where(["username" => $username])->one();
    }
 
    public static function findByUser($username) 
    {
        return self::find()->where(["username" => $username])->one();
    }
 
    /**
     * @inheritdoc
     */
    public function getId() 
    {
        //return $this->id;
        return $this->getPrimaryKey();
    }
 
    /**
     * @inheritdoc
     */
    public function getAuthKey() 
    {
        return $this->auth_key;
    }
 
    /**
     * @inheritdoc
     */
    public function validateAuthKey($auth_key) 
    {
        return $this->auth_key === $auth_key;
    }
 
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) 
    {
        //return $this->password ===  md5($password);
        return Yii::$app->security->validatePassword($password, $this->password_hash);  // password hash (recommended)
    }
    public function setPassword($password)
    {
        //$this->password_hash = password_hash($password, PASSWORD_DEFAULT);  // hash
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
 
 
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Do some work before saving.
 
            // Encrypt password
            if (!empty($this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
            }
 
            //if (empty($this->uuid)) {
            //    $this->uuid = \common\helpers\ProviderHelper::GUIDv4();
            //}
 
            //if (empty($this->phone)) {
            //    $this->phone = '';
            //}
 
            //if (empty($this->access_token)) {
            //    $this->access_token = '123-token';
            //}
 
            return true;  // validated
        }
        return false;  // not validated
    }
 
}