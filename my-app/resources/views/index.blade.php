<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script>
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
    </script>
</head>
<body>
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
</body>
</html>