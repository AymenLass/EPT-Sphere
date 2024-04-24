<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
class ChangeProfilePhotoController extends Controller 
{
    public function store(Request $request)
    {
        // Validate the uploaded image
        $request->validate([
            'user_image' => ['required', 'image', 'max:2048'], // Assuming max file size is 2MB
        ]);

        // Generate a unique filename for the image
        $name_slug = Str::of(Auth::user()->name)->slug('-');
        $image = $request->file('user_image');
        $input['user_image'] = time().'-'.$name_slug.'.'.$image->getClientOriginalExtension();

        // Set the destination path for storing the image
        $destinationPath = public_path('images/users');

        // Create an Intervention Image instance from the uploaded image file
        $imgFile = Image::read($image->getRealPath());

        // Resize the image to 300x300 pixels and save it
        $imgFile->resize(300, 300)->save($destinationPath.'/'.$input['user_image']);

        // Update the user's profile photo path in the database
        $user = Auth::user();
        $user->user_image = $input['user_image'];
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile photo updated successfully.');
    }
}
