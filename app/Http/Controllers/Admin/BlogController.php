<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    //
    private $db_blog;
    private $db_blog_category;





    /**
     * Constructor to initialize the database table names for blogs and blog categories.
     *
     * This constructor sets up the table names used in various methods to interact with the database.
     * The `db_blog` property is initialized to "blogs", and the `db_blog_category` property is initialized to "blog_category".
     */
    public function __construct()
    {
        $this->db_blog = "blogs";
        $this->db_blog_category = "blog_category";
    }



    /**
     * Display a listing of blog categories.
     *
     * This method retrieves all records from the blog categories table (`db_blog_category`) using Laravel's query builder. 
     * The retrieved data is passed to the 'view_blog' view to be displayed to the user.
     *
     * @return \Illuminate\View\View The view displaying the blog categories.
     */
    public function Blog_Category()
    {
        $data = DB::table($this->db_blog_category)->get();  // Query builder to retrieve all blog categories
        return view('admin.blog_category.view_blog', compact('data'));
    }





    /**
     * Store a newly created blog category in the database.
     *
     * This method validates the request input, creates a new blog category, 
     * and inserts it into the `db_blog_category` table using Laravel's query builder. 
     * If the operation is successful, a success notification is displayed.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing the form data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
    public function Blog_Store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'category_name' => 'required|max:55',
        ]);

        // Prepare data for insertion
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['created_at'] = Carbon::now();

        // Insert data into the database
        DB::table($this->db_blog_category)->insert($data);

        // Return back with a success notification
        $notification = array('messege' => 'Category Inserted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }




    /**
     * Remove the specified blog category from the database.
     *
     * This method deletes a blog category from the `db_blog_category` table 
     * based on the provided category ID. If the deletion is successful, 
     * a success notification is displayed.
     *
     * @param  int  $id  The ID of the blog category to be deleted.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success notification.
     */
    public function Blog_Destroy($id)
    {
        // Delete the blog category by ID
        DB::table($this->db_blog_category)->where('id', $id)->delete();

        // Return back with a success notification
        $notification = array('messege' => 'Category Deleted!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }



    /**
     * Show the form for editing the specified blog category.
     *
     * This method retrieves a single blog category from the `db_blog_category` table 
     * based on the provided category ID. The retrieved data is passed to the view 
     * for editing.
     *
     * @param  int  $id  The ID of the blog category to be edited.
     * @return \Illuminate\View\View The view for editing the blog category.
     */
    public function Blog_Edit($id)
    {
        // Retrieve the blog category by ID
        $data = DB::table($this->db_blog_category)->where('id', $id)->first();

        // Return the edit view with the retrieved data
        return view('admin.blog_category.edit_blog', compact('data'));
    }




    /**
     * Update the specified blog category in the database.
     *
     * This method handles the update request for a blog category, validating the input,
     * creating a slug, and updating the `db_blog_category` table with the new data.
     * After successfully updating, it redirects back with a success notification.
     *
     * @param  \Illuminate\Http\Request  $request  The request object containing input data.
     * @return \Illuminate\Http\RedirectResponse Redirects back with a success message.
     */
    public function Blog_Update(Request $request)
    {
        // Prepare data for update
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_slug'] = Str::slug($request->category_name, '-');
        $data['updated_at'] = Carbon::now();

        // Update the blog category by ID
        DB::table($this->db_blog_category)->where('id', $request->id)->update($data);

        // Prepare a success notification message
        $notification = array('messege' => 'Category Updated!', 'alert-type' => 'success');

        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }
}
