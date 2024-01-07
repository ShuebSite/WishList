<?php
 
namespace App\Rules;
 
use App\Cognito\CognitoClient;
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Illuminate\Contracts\Validation\Rule;
 
class CognitoUserUnique implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $config;
    public function __construct()
    {
        $this->config = [
            'region'      => config('cognito.region'),
            'version'     => config('cognito.version')
        ];
    }
 
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
 
        $client = new CognitoClient(
            new CognitoIdentityProviderClient($this->config)
        );
 
        $user = $client->getUserByUsername($value);
        if($user){
            return false;
        }
        return true;
 
    }
 
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'このメールアドレスはCognitoにすでに登録されています。';
    }
}

