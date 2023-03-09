# Laravel
## SSR+CSR Project
- `php artisan make:migration create_comments_table --create comments`
- ~~~php
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments("id");
            $table->string("email");
            $table->string("content");
            $table->timestamps();
        });
    }
  ~~~
- `php artisan migrate:status`
- `php artisan migrate`
- `php artisan migrate:status`
- `php artisan make:model Comment`
- ~~~php
    class Comment extends Model
    {
        use HasFactory;

        protected $fillable=[
            "email",
            "content"
        ];
    }
  ~~~
- `php artisan make:seeder CommentSeeder`
- ~~~php
    public function run()
    {
        Comment::create(["email" => "admin@hello.world", "content" => "Hello to all"]);
    }
  ~~~
- `php artisan db:seed --class=CommentSeeder`
- `php artisan make:controller CommentController --resource --model=Comment`
- Append `Route::resource("/comments",CommentController::class);` to `web.php`
- ~~~php
    class CommentController extends Controller
    {
        public function index()
        {
            $comments = Comment::all();
            return view("index", compact("comments"));
        }

        public function store(Request $request)
        {
            Comment::create($request->all());
            return redirect()->route("comments.index");
        }

        public function update(Request $request, Comment $comment)
        {
            $comment->update($request->all());
        }

        public function destroy(Comment $comment)
        {
            $id = $comment->id;
            $comment->delete();
            return $id;
        }
    }
  ~~~
- Make `index.blade.php`
- ~~~php
    <h1>Comments</h1>
    @foreach ($comments as $comment)
        <div id="comment-{{$comment->id}}">
            {{$comment->email}}
            <br/>
            <button onclick="_delete('{{$comment->id}}')">X</button>
            <div contenteditable="true" onkeyup="_update(this,'{{$comment->id}}')">{{$comment->content}}</div>
            <hr/>
        </div>
    @endforeach

    <form action="/comments" method="post">
        @csrf
        <input type="text" name="email" placeholder="Email"/>
        <input type="text" name="content" placeholder="Content"/>
        <input type="submit" value="Send"/>
    </form>
  ~~~
- And also ajax js script in `index.blade.php`
- ~~~javascript
    const _delete=(id)=>{
        $.ajax({
            type: "DELETE",
            url: "/comments/" + id,
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            success:()=> {
                $("#comment-" + id).remove();
            }
        });
    }

    const _update=(el,id)=>{
        $.ajax({
            type: "PUT",
            url: "/comments/" + id,
            data:{'content': $(el).text()},
            headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
            success:()=> {}
        });
    }
  ~~~