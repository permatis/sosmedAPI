<?php

namespace App\Http\Controllers;

use App\AccessToken;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class AccountController extends Controller
{
	/**
	 * Instance untuk facebook sdk
	 * @var object
	 */
	private $fb;

	/**
	 * Intance untuk tabel access token
	 * @var [type]
	 */
	private $token;

	/**
	 * Konstruktor untuk mendlekarasikan Class yang akan digunakan.
	 * @param LaravelFacebookSdk $fb 
	 * @param AccessToken        $token 
	 */
	public function __construct(
		LaravelFacebookSdk $fb, 
		AccessToken $token
	)
	{
		$this->fb = $fb;
		$this->token = $token;
	}

	/**
	 * Untuk menampilkan tampilan status koneksi facebook.
	 * @return array 
	 */
    public function facebook_setting()
    {
    	$columns = \Schema::getColumnListing('access_token');
    	$tokens = $this->tokenByUserId();

    	return view('settings/social_media')
    		->with([ 'columns' => $columns , 'tokens' => $tokens ]);
    }

    /**
     * Meredirect ke url Koneksi ke facebook
     * @return [type] [description]
     */
    public function facebook_connect() 
    {
    	$permission = ['email'];
    	
    	return redirect(
    				$this->fb->getLoginUrl($permission)
    		);
    }

    /**
     * Menghapus akun facebook dari pengaturan
     * @return redirect
     */
    public function facebook_disconnect() 
    {
    	$this->token->destroy(
    			$this->tokenByUserId()[0]->id
    		);

		return redirect('/setting/accounts');
    }

    /**
     * Mendapatkan hasil callback berupa token dari facebook.
     * Lalu check terlebih dahulu jika masa aktif token pendek maka dibuat menjadi lama.
     * Dan kemudian menyimpan token ke dalam database.
     * @return redirect
     */
    public function facebook_callback()
    {
		$token = $this->fb->getAccessTokenFromRedirect();

	    if (! $token->isLongLived()) {
	    	$oauth_client = $this->fb->getOAuth2Client();
	    	try {
	        	$token = $oauth_client->getLongLivedAccessToken($token);
	   	 	} catch (Facebook\Exceptions\FacebookSDKException $e) {
	        	dd($e->getMessage());
	    	}
		}
		
		$this->fb->setDefaultAccessToken($token);
		$this->createOrUpdate($token, 'facebook');
		
		return redirect('/setting/accounts');
    }

    /**
     * Method untuk mencari token dari tabel acess_token berdasarkan user_id
     * @return Object 
     */
    protected function tokenByUserId()
    {
    	return $this->token->where('user_id', 1)->get();
    }

    /**
     * Method untuk menambah atau memperbarui token berdasarkan user_id
     * Jika token tidak ada atau null maka token akan ditambahkan.
     * Jika token ada maka token akan diperbarui.
     * @param  array $token   data token
     * @param  string $sosmed type sosial media
     * @return object
     */
    protected function createOrUpdate($token, $sosmed)
    {
    	$userId = $this->tokenByUserId();

    	return (count($userId) > 0) ? $userId->update([ 'tk_'.$sosmed => $token ]): 
    		$this->token->create([ 'tk_'.$sosmed => $token , 'user_id' => 1]);
    }
}
