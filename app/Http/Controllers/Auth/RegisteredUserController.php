<?php

namespace App\Http\Controllers\Auth;

use Laravolt\Avatar\ServiceProvider;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
// use File;
use Intervention\Image\ImageManager;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Render the registration form view
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'user_image' => ['nullable', 'image'],
        
    ]);

    // Check if user provided an image
    if ($request->hasFile('user_image')) {
        // If user provided an image, proceed with image upload and user creation as before
        $request->validate([
            'user_image' => [ 'image'],
        ]);
        
        // Generate a slug from the name for the image filename
        $name_slug = Str::of($request->name)->slug('-');
        
        // Retrieve the uploaded image file
        $image = $request->file('user_image');
        
        // Generate a unique filename for the image
        $input['user_image'] = time().'-'.$name_slug.'.'.$image->getClientOriginalExtension();
        
        // Set the destination path for storing the image
        $destinationPath = public_path('images/users');
        
        // Create an Intervention Image instance from the uploaded image file
        $imgFile = Image::read($image->getRealPath());
        
        // Resize the image to 300x300 pixels and save it
        $imgFile->resize(300, 300)->save($destinationPath.'/'.$input['user_image']);
    } else {
        // If user didn't provide an image, generate an avatar using UI Avatars
        
        // Set UI Avatars API endpoint
        $uiAvatarsEndpoint = 'https://ui-avatars.com/api/';
        
        // Generate URL for UI Avatars API request
        $uiAvatarsUrl = $uiAvatarsEndpoint . '?name=' . urlencode($request->name) . '&size=300';
        
        // Get the avatar image data from UI Avatars API
        $avatarData = file_get_contents($uiAvatarsUrl);
        
        // Generate a unique filename for the avatar
        $input['user_image'] = time() . '-' . Str::random(10) . '.png';
        
        // Set the destination path for storing the avatar
        $destinationPath = public_path('images/users');
        
        // Save the generated avatar image to the destination path
        file_put_contents($destinationPath.'/'.$input['user_image'], $avatarData);
    }

    // Create a new user record in the database
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'user_image' => $input['user_image'],
    ]);

    // Dispatch the Registered event
    event(new Registered($user));

    // Log in the newly registered user
    Auth::login($user);

    // Redirect the user to the home page
    return redirect(RouteServiceProvider::HOME);
}

    
}
